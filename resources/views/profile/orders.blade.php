@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-black text-purple-900 mb-8">📦 My Orders</h1>

        @if ($orders->isEmpty())
            <div class="bg-purple-100 rounded-2xl shadow-2xl p-12 text-center border-2 border-purple-300">
                <p class="text-purple-900 font-bold text-xl mb-4">No orders yet! 🛍️</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-xl hover:bg-purple-700 font-bold">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-2xl shadow-2xl p-6 border-l-4 border-purple-600">
                        <div class="grid grid-cols-4 gap-4 mb-4">
                            <div>
                                <p class="text-gray-700 text-sm font-bold">Order ID</p>
                                <p class="text-purple-900 font-black text-lg">#{{ $order->id }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700 text-sm font-bold">Date</p>
                                <p class="text-purple-900 font-bold">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700 text-sm font-bold">Total</p>
                                <p class="text-purple-900 font-black text-lg">₹{{ number_format($order->total_amount * 83, 0) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700 text-sm font-bold">Status</p>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-black
                                    @if($order->status == 'completed') bg-green-400 text-purple-900
                                    @elseif($order->status == 'pending') bg-yellow-400 text-purple-900
                                    @elseif($order->status == 'failed') bg-red-400 text-white
                                    @else bg-gray-400 text-white
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="border-t-2 border-purple-200 pt-4 mt-4">
                            <p class="text-purple-900 font-bold mb-3">Items:</p>
                            <div class="space-y-2 ml-4">
                                @foreach ($order->items as $item)
                                    <div class="flex justify-between text-sm bg-purple-50 p-3 rounded-lg">
                                        <span class="text-purple-900 font-bold">
                                            {{ $item->product->name }} 
                                            <span class="text-gray-600">x{{ $item->quantity }}</span>
                                        </span>
                                        <span class="text-purple-900 font-black">₹{{ number_format($item->price * $item->quantity * 83, 0) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t-2 border-purple-200">
                            <p class="text-gray-700 text-sm">
                                💳 Payment: <span class="font-bold text-purple-900">{{ ucfirst($order->payment_method) }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
