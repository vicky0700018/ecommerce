@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-5xl font-black text-purple-900 mb-8">💳 Secure Checkout</h1>

        @if ($errors->any())
            <div class="bg-red-500 border-l-4 border-red-700 text-black px-6 py-4 rounded-xl mb-6 shadow-lg">
                <ul class="space-y-2">
                    @foreach ($errors->all() as $error)
                        <li class="font-bold">❌ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-6">
            <!-- Order Summary -->
            <div class="bg-white rounded-2xl shadow-2xl p-6 border-t-4 border-blue-600">
                <h2 class="text-3xl font-black text-black mb-6">📦 Items</h2>
                
                <div class="space-y-4 mb-6 pb-6 border-b-2 border-blue-300">
                    @foreach ($cartItems as $item)
                        <div class="flex justify-between text-sm bg-primary p-3 rounded-lg">
                            <span class="text-black font-bold">{{ $item->product->name }} <span class="text-gray-600">x{{ $item->quantity }}</span></span>
                            <span class="font-black text-blue-600">₹{{ number_format($item->product->price * $item->quantity, 0) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between text-2xl font-black text-black">
                    <span>Total:</span>
                    <span class="text-blue-600">₹{{ number_format($total, 0) }}</span>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-white rounded-2xl shadow-2xl p-6 border-t-4 border-blue-600">
                <h2 class="text-3xl font-black text-black mb-6">💰 Payment</h2>

                <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-black font-black mb-3">Full Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-4 py-3 border-2 border-blue-600 rounded-lg bg-white text-black font-semibold focus:outline-none focus:border-blue-800">
                    </div>

                    <div class="mb-6">
                        <label class="block text-black font-black mb-3">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-3 border-2 border-blue-600 rounded-lg bg-gray-100 text-black font-semibold focus:outline-none focus:border-blue-800" readonly>
                    </div>

                    <div class="mb-6">
                        <label class="block text-black font-black mb-3">Demo Token</label>
                        <input type="text" name="stripeToken" value="tok_visa" class="w-full px-4 py-3 border-2 border-blue-600 rounded-lg bg-gray-100 text-black font-semibold focus:outline-none focus:border-blue-800" readonly>
                        <p class="text-blue-600 text-xs mt-2 font-bold">🔒 Using demo payment token</p>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-black px-6 py-4 rounded-xl hover:bg-blue-700 font-black text-xl shadow-xl transition transform hover:scale-105">
                        ✓ Pay ₹{{ number_format($total, 0) }}
                    </button>
                </form>

                <p class="text-black text-xs mt-6 p-4 bg-blue-100 rounded-lg border-l-4 border-blue-600 font-bold">
                    🔒 <span class="text-blue-600">DEMO MODE:</span><br>
                    This is a test payment. Click pay to process order.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
