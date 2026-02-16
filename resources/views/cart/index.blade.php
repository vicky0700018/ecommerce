@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-5xl font-black text-purple-900 mb-8">🛒 Your Shopping Cart</h1>

    @if ($message = Session::get('success'))
        <div class="bg-green-400 text-black px-6 py-4 rounded-xl mb-6 shadow-lg font-bold animate-pulse">
            ✨ {{ $message }}
        </div>
    @endif

    @if ($cartItems->isEmpty())
        <div class="text-center py-16 bg-primary rounded-2xl shadow-2xl border-2 border-blue-600">
            <p class="text-black text-xl mb-4 font-bold">Your cart is empty</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 text-black px-8 py-3 rounded-full hover:bg-blue-700 font-bold shadow-lg transform hover:scale-110 transition duration-300">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-2 border-blue-600">
                    <table class="w-full">
                        <thead class="bg-blue-600 text-black">
                            <tr>
                                <th class="px-6 py-4 text-left font-black">Product</th>
                                <th class="px-6 py-4 text-left font-black">Price</th>
                                <th class="px-6 py-4 text-left font-black">Quantity</th>
                                <th class="px-6 py-4 text-left font-black">Total</th>
                                <th class="px-6 py-4 text-center font-black">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if ($item->product->image_url)
                                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg mr-4 shadow-lg border-2 border-blue-600">
                                            @else
                                                <div class="w-16 h-16 bg-blue-400 rounded-lg mr-4 flex items-center justify-center">
                                                    <span class="text-black text-xs font-bold">No Img</span>
                                                </div>
                                            @endif
                                            <span class="font-bold text-black">{{ $item->product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-blue-600 font-black text-lg">₹{{ number_format($item->product->price, 0) }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 px-2 py-1 border-2 border-blue-600 rounded-lg focus:outline-none focus:border-blue-700 bg-white text-black font-bold">
                                            <button type="submit" class="bg-blue-600 text-black px-3 py-1 rounded-lg text-sm hover:bg-blue-700 font-bold shadow-lg transition">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 font-black text-black text-lg">
                                        ₹{{ number_format($item->product->price * $item->quantity, 0) }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-black px-4 py-1 rounded-lg text-sm hover:bg-red-600 font-bold shadow-lg transition"
                                                onclick="return confirm('Remove from cart?')">
                                                🗑️ Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-span-1">
                <div class="bg-white rounded-2xl shadow-2xl p-6 sticky top-8 border-t-4 border-blue-600">
                    <h2 class="text-3xl font-black text-black mb-6">📋 Order Summary</h2>
                    
                    <div class="space-y-4 mb-6 pb-6 border-b-2 border-blue-300">
                        <div class="flex justify-between text-black">
                            <span class="font-bold">Subtotal:</span>
                            <span class="text-blue-600 font-black text-lg">₹{{ number_format($total, 0) }}</span>
                        </div>
                        <div class="flex justify-between text-black">
                            <span class="font-bold">Shipping:</span>
                            <span class="text-green-600 font-black">FREE</span>
                        </div>
                    </div>

                    <div class="flex justify-between text-2xl font-black mb-6 text-black">
                        <span>Total:</span>
                        <span class="text-blue-600">₹{{ number_format($total, 0) }}</span>
                    </div>

                    <a href="{{ route('payment.checkout') }}" class="w-full bg-blue-600 text-black px-6 py-4 rounded-xl hover:bg-blue-700 text-center font-black block mb-3 shadow-xl transition transform hover:scale-105 text-lg">
                        💳 Proceed to Checkout
                    </a>

                    <a href="{{ route('products.index') }}" class="w-full bg-gray-400 text-black px-6 py-3 rounded-xl hover:bg-gray-500 text-center font-bold shadow-lg transition">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
