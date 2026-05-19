<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Initialize Stripe API key
        if (env('STRIPE_SECRET_KEY')) {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        }
    }

    /**
     * Show checkout page
     */
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }

        return view('payment.checkout', compact('cartItems', 'total'));
    }

    /**
     * Process payment with Stripe
     */
    public function processPayment(Request $request)
    {
        try {
            $validated = $request->validate([
                'stripeToken' => 'required',
            ]);

            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
            $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Cart is empty!');
            }

            // Check if we have valid Stripe API key
            if (!env('STRIPE_SECRET_KEY') || strpos(env('STRIPE_SECRET_KEY'), 'sk_') !== 0) {
                // Demo mode - simulate successful payment
                $paymentIntentId = 'demo_' . uniqid();
                $paymentStatus = 'succeeded';
            } else {
                // Real Stripe payment
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
                
                // Convert USD to INR for payment
                $amountInRupees = Currency::convert($total, 'INR');
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => (int)($amountInRupees * 100),
                    'currency' => 'inr',
                    'payment_method' => $validated['stripeToken'],
                    'confirm' => true,
                    'automatic_payment_methods' => [
                        'enabled' => true,
                        'allow_redirects' => 'never'
                    ]
                ]);
                
                $paymentIntentId = $paymentIntent->id;
                $paymentStatus = $paymentIntent->status;
            }

            if ($paymentStatus == 'succeeded') {
                // Create order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_amount' => $total,
                    'status' => 'completed',
                    'payment_method' => 'stripe',
                    'stripe_payment_id' => $paymentIntentId,
                    'payment_details' => json_encode(['status' => $paymentStatus]),
                ]);

                // Create order items
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);

                    // Update product stock
                    $item->product->decrement('stock', $item->quantity);
                }

                // Clear cart
                Cart::where('user_id', Auth::id())->delete();

                $confirmationEmailSent = $this->sendOrderConfirmationEmail($order);
                
                // Generate and send invoice
                $invoice = $this->generateInvoice($order);
                $invoiceEmailSent = $this->sendInvoiceEmail($order, $invoice);

                return redirect()->route('payment.success', $order->id)
                    ->with('success', 'Payment successful!')
                    ->with('confirmation_email_sent', $confirmationEmailSent)
                    ->with('invoice_email_sent', $invoiceEmailSent);
            } else {
                return back()->with('error', 'Payment failed!');
            }
        } catch (\Throwable $e) {
            // \Log::error('Payment Error: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Payment error: ' . $e->getMessage());
        }
    }

    /**
     * Payment success page
     */
    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('payment.success', compact('order'));
    }

    private function sendOrderConfirmationEmail(Order $order): bool
    {
        try {
            $order->loadMissing('items.product', 'user');

            $items = $order->items
                ->map(fn ($item) => "{$item->product->name} x{$item->quantity} - Rs. " . number_format($item->price * $item->quantity, 0))
                ->implode("\n");

            Mail::raw(
                "Thank you for your purchase!\n\n"
                . "Order ID: #{$order->id}\n"
                . "Status: {$order->status}\n"
                . "Items:\n{$items}\n\n"
                . "Total Paid: Rs. " . number_format($order->total_amount, 0),
                function ($message) use ($order) {
                    $message->to($order->user->email)
                        ->subject("Order Confirmation #{$order->id}");
                }
            );

            return true;
        } catch (\Throwable $e) {
            Log::warning('Order confirmation email failed.', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Generate invoice for order
     */
    private function generateInvoice(Order $order): Invoice
    {
        $invoiceNumber = 'INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '-' . date('Ym');

        $invoice = Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => $invoiceNumber,
            'total_amount' => $order->total_amount,
            'status' => 'issued',
            'issued_at' => now(),
        ]);

        return $invoice;
    }

    /**
     * Send invoice email
     */
    private function sendInvoiceEmail(Order $order, Invoice $invoice): bool
    {
        try {
            $order->loadMissing('items.product', 'user');

            Mail::to($order->user->email)->send(new InvoiceMail($order, $invoice));

            return true;
        } catch (\Throwable $e) {
            Log::warning('Invoice email failed.', [
                'order_id' => $order->id,
                'invoice_id' => $invoice->id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * View invoice
     */
    public function viewInvoice(Invoice $invoice)
    {
        // Check authorization
        if ($invoice->order->user_id !== Auth::id()) {
            abort(403);
        }

        $invoice->loadMissing('order.items.product', 'order.user');
        $order = $invoice->order;

        return view('invoice.view', compact('invoice', 'order'));
    }

    /**
     * Download invoice as PDF
     */
    public function downloadInvoice(Invoice $invoice)
    {
        // Check authorization
        if ($invoice->order->user_id !== Auth::id()) {
            abort(403);
        }

        $invoice->loadMissing('order.items.product', 'order.user');
        $order = $invoice->order;

        // For now, return HTML view (can integrate with DomPDF for actual PDF download)
        return view('invoice.view', compact('invoice', 'order'));
    }

    /**
     * Get Stripe public key
     */
    public function getStripeKey()
    {
        return response()->json([
            'publicKey' => env('STRIPE_PUBLIC_KEY'),
        ]);
    }
}
