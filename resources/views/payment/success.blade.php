@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 border-4 border-emerald-500 rounded-3xl p-12 mb-8 shadow-2xl">
            <div class="text-8xl mb-6 animate-bounce">✨</div>
            <h1 class="text-6xl font-black text-emerald-700 mb-3">Payment Successful!</h1>
            <p class="text-gray-700 text-xl font-bold mb-2">Thank you for your purchase!</p>
            <p class="text-emerald-600 font-bold text-lg">Your order is being processed...</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8 text-left border-l-4 border-emerald-500">
            <h2 class="text-3xl font-black text-emerald-700 mb-6">📦 Order Details</h2>
            <div class="space-y-4 pb-6 border-b-2 border-gray-200">
                <div class="flex justify-between bg-blue-50 p-3 rounded-lg">
                    <span class="font-bold text-gray-800">Order ID:</span>
                    <span class="font-mono bg-blue-100 px-3 py-1 rounded font-black text-blue-700">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between bg-gray-50 p-3 rounded-lg">
                    <span class="font-bold text-gray-800">Date:</span>
                    <span class="text-gray-700 font-bold">{{ $order->created_at->format('M d, Y • h:i A') }}</span>
                </div>
                <div class="flex justify-between bg-purple-50 p-3 rounded-lg">
                    <span class="font-bold text-gray-800">Payment:</span>
                    <span class="text-purple-700 font-bold">💳 {{ ucfirst($order->payment_method) }}</span>
                </div>
                <div class="flex justify-between bg-emerald-50 p-3 rounded-lg">
                    <span class="font-bold text-gray-800">Status:</span>
                    <span class="bg-emerald-500 text-white px-4 py-1 rounded-full font-black">✓ {{ ucfirst($order->status) }}</span>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="font-black text-xl mb-4 text-emerald-700">📋 Your Items:</h3>
                <div class="space-y-3 mb-4">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between text-sm bg-orange-50 p-4 rounded-lg border-l-4 border-orange-500">
                            <span class="text-gray-800 font-bold">{{ $item->product->name }} <span class="text-gray-600">x{{ $item->quantity }}</span></span>
                            <span class="text-orange-700 font-black">₹{{ number_format($item->price * $item->quantity, 0) }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between font-black text-2xl mt-6 pt-4 border-t-2 border-gray-200 text-gray-800">
                    <span>Total Paid:</span>
                    <span class="text-orange-600">₹{{ number_format($order->total_amount, 0) }}</span>
                </div>
            </div>
        </div>

        <div class="space-y-3 mb-8">
            <a href="{{ route('products.index') }}" class="block w-full bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-500 text-white px-6 py-4 rounded-xl hover:from-cyan-600 hover:via-blue-600 hover:to-purple-600 font-black text-lg shadow-lg transition transform hover:scale-105">
                🛍️ Continue Shopping
            </a>
            <a href="{{ route('dashboard') }}" class="block w-full bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 py-4 rounded-xl hover:from-gray-700 hover:to-gray-800 font-bold text-lg shadow-lg transition">
                📊 Go to Dashboard
            </a>
        </div>

        <p class="text-gray-700 text-sm bg-blue-50 border-2 border-blue-200 px-6 py-4 rounded-xl font-bold">
            📧 Confirmation email sent to <span class="text-blue-700">{{ Auth::user()->email }}</span><br>
            Check your inbox & spam folder
        </p>
    </div>
</div>
@endsection
