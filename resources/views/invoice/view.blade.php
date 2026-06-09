@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Invoice Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-8 rounded-t-lg">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold">🛍️ ShopSphere</h1>
                    <p class="text-blue-100 mt-2">Invoice</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-semibold">{{ $invoice->invoice_number }}</p>
                    <p class="text-blue-100">Issued: {{ $invoice->issued_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Invoice Content -->
        <div class="bg-white p-8 border border-gray-200">
            <!-- Invoice Info -->
            <div class="grid grid-cols-2 gap-8 mb-8 pb-8 border-b border-gray-200">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase mb-2">Bill To</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->user->name }}</p>
                    <p class="text-gray-600">{{ $order->user->email }}</p>
                </div>
                <div class="text-right">
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Order ID</p>
                        <p class="text-2xl font-bold text-blue-600">#{{ $order->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold mt-1">
                            ✓ {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <table class="w-full mb-8">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="text-left py-3 font-semibold text-gray-700">Product</th>
                        <th class="text-center py-3 font-semibold text-gray-700">Qty</th>
                        <th class="text-right py-3 font-semibold text-gray-700">Unit Price</th>
                        <th class="text-right py-3 font-semibold text-gray-700">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 text-gray-900">
                            <div>
                                <p class="font-medium">{{ $item->product->name }}</p>
                            </div>
                        </td>
                        <td class="py-4 text-center text-gray-600">{{ $item->quantity }}</td>
                        <td class="py-4 text-right text-gray-600">Rs. {{ number_format($item->price, 2) }}</td>
                        <td class="py-4 text-right font-semibold text-gray-900">
                            Rs. {{ number_format($item->price * $item->quantity, 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total Section -->
            <div class="flex justify-end mb-8">
                <div class="w-64">
                    <div class="flex justify-between py-3 border-b border-gray-200">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="text-gray-900">Rs. {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between py-4 text-2xl font-bold">
                        <span class="text-gray-900">Total:</span>
                        <span class="text-blue-600">Rs. {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Payment Method</p>
                        <p class="text-lg font-semibold text-gray-900">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Payment Status</p>
                        <p class="text-lg font-semibold text-green-600">✓ Completed</p>
                    </div>
                </div>
            </div>

            <!-- Footer Message -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                <p class="text-gray-900 font-semibold">Thank you for your purchase! 🎉</p>
                <p class="text-gray-600 text-sm mt-2">
                    We appreciate your business. If you have any questions, please contact our support team.
                </p>
            </div>
        </div>

        <!-- Invoice Footer -->
        <div class="bg-gray-50 p-6 rounded-b-lg border border-gray-200 border-t-0 text-center text-sm text-gray-600">
            <p>ShopSphere © {{ date('Y') }} | All Rights Reserved</p>
            <p class="text-xs text-gray-500 mt-1">This is an automated invoice</p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex gap-4 justify-center">
            <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                ← Back to Dashboard
            </a>
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                🖨️ Print Invoice
            </button>
            <a href="{{ route('invoice.download', $invoice) }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                📥 Download
            </a>
        </div>
    </div>
</div>

<style>
    @media print {
        .action-buttons {
            display: none;
        }
        body {
            background: white;
        }
    }
</style>
@endsection
