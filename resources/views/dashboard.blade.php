@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-2xl shadow-2xl p-8 mb-8">
        <h1 class="text-5xl font-black mb-2">👋 Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="text-lg opacity-90">Happy shopping! Here's your account summary.</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 border-l-4 border-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-700 font-bold text-sm">📦 Total Orders</p>
                    <p class="text-4xl font-black text-purple-900">{{ $totalOrders }}</p>
                </div>
                <div class="text-5xl opacity-30">📦</div>
            </div>
        </div>

        <!-- Total Spent -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 border-l-4 border-green-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-700 font-bold text-sm">💰 Total Spent</p>
                    <p class="text-4xl font-black text-green-600">₹{{ number_format($totalSpent, 0) }}</p>
                </div>
                <div class="text-5xl opacity-30">💰</div>
            </div>
        </div>

        <!-- Saved Addresses -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 border-l-4 border-blue-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-700 font-bold text-sm">📍 Saved Addresses</p>
                    <p class="text-4xl font-black text-blue-600">{{ $savedAddresses }}</p>
                </div>
                <div class="text-5xl opacity-30">📍</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8 border-2 border-purple-300">
        <h2 class="text-2xl font-black text-purple-900 mb-6">⚡ Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('products.index') }}" class="bg-purple-600 text-white px-6 py-4 rounded-xl hover:bg-purple-700 font-bold text-center transition transform hover:scale-105">
                🛍️ Shop Now
            </a>
            <a href="{{ route('profile.orders') }}" class="bg-blue-600 text-white px-6 py-4 rounded-xl hover:bg-blue-700 font-bold text-center transition transform hover:scale-105">
                📋 View Orders
            </a>
            <a href="{{ route('profile.addresses') }}" class="bg-green-600 text-white px-6 py-4 rounded-xl hover:bg-green-700 font-bold text-center transition transform hover:scale-105">
                📍 Addresses
            </a>
            <a href="{{ route('profile.edit') }}" class="bg-orange-600 text-white px-6 py-4 rounded-xl hover:bg-orange-700 font-bold text-center transition transform hover:scale-105">
                ⚙️ Settings
            </a>
        </div>
    </div>

    <!-- Recent Orders -->
    @if ($recentOrders->count() > 0)
        <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8 border-2 border-purple-300">
            <h2 class="text-2xl font-black text-purple-900 mb-6">📦 Recent Orders</h2>
            <div class="space-y-4">
                @foreach ($recentOrders as $order)
                    <div class="bg-purple-50 rounded-xl p-4 border-l-4 border-purple-600">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-purple-900 font-black">Order #{{ $order->id }}</p>
                                <p class="text-gray-600 text-sm">{{ $order->created_at->format('M d, Y • h:i A') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-purple-900 font-black text-lg">₹{{ number_format($order->total_amount, 0) }}</p>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                    @if($order->status == 'completed') bg-green-400 text-purple-900
                                    @elseif($order->status == 'pending') bg-yellow-400 text-purple-900
                                    @elseif($order->status == 'failed') bg-red-400 text-white
                                    @else bg-gray-400 text-white
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-700">
                            {{ $order->items->count() }} item(s)
                            @if ($order->items->count() > 0)
                                - 
                                @foreach ($order->items->take(2) as $item)
                                    {{ $item->product->name }}@if(!$loop->last), @endif
                                @endforeach
                                @if ($order->items->count() > 2)
                                    ...
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('profile.orders') }}" class="block text-center text-purple-600 font-bold hover:text-purple-700 mt-4">
                    View All Orders →
                </a>
            </div>
        </div>
    @endif

    <!-- Recommended Products -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 border-2 border-purple-300">
        <h2 class="text-2xl font-black text-purple-900 mb-6">⭐ Recommended for You</h2>
        @if ($recommendedProducts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach ($recommendedProducts as $product)
                    <div class="bg-purple-50 rounded-xl overflow-hidden border-2 border-purple-300 hover:shadow-lg transition transform hover:-translate-y-2">
                        @if ($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-purple-400 flex items-center justify-center">
                                <span class="text-white font-bold">📦</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-purple-900 font-bold mb-2 line-clamp-2">{{ $product->name }}</h3>
                            <p class="text-purple-600 font-black text-xl mb-4">₹{{ number_format($product->price, 0) }}</p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 font-bold transition">
                                    🛒 Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-700 text-center py-8">No products available right now.</p>
        @endif
    </div>
</div>
@endsection
