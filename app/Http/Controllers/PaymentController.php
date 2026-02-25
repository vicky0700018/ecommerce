<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

                return redirect()->route('payment.success', $order->id)
                    ->with('success', 'Payment successful!');
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
