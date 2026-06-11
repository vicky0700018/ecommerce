@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Welcome Section (Premium Design) -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#4f46e5] via-[#7c3aed] to-[#c026d3] text-white rounded-[2rem] shadow-2xl p-10 mb-10 border border-white/10 group">
        <!-- Abstract Decorative Elements -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-white/10 blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 rounded-full bg-[#facc15]/20 blur-3xl group-hover:bg-[#facc15]/30 transition-all duration-700"></div>
        <div class="absolute top-1/2 right-1/4 w-32 h-32 rounded-full bg-pink-500/30 blur-2xl animate-pulse"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-sm font-medium mb-6 shadow-inner">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span> Dashboard Overview
                </span>
                <h1 class="text-4xl md:text-5xl font-black mb-3 tracking-tight">
                    Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-amber-400">{{ Auth::user()->name }}</span>! 👋
                </h1>
                <p class="text-lg md:text-xl text-white/80 font-light max-w-2xl">
                    Track your orders, manage your profile, and discover new products curated just for you.
                </p>
            </div>
            
            <div class="hidden md:flex items-center justify-center p-6 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                <div class="text-center">
                    <p class="text-sm text-white/70 font-semibold uppercase tracking-wider mb-1">Member Since</p>
                    <p class="text-2xl font-bold">{{ Auth::user()->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section (Sleek Glass/White Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Total Orders -->
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 11V7a2 2 0 114 0v4h1a1 1 0 110 2H7a1 1 0 110-2h1z"></path></svg>
            </div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-500 font-bold text-xs mb-1 uppercase tracking-wider">Total Orders</p>
                    <h3 class="text-4xl font-black text-gray-900 group-hover:text-[#4f46e5] transition-colors">{{ $totalOrders }}</h3>
                </div>
                <div class="w-14 h-14 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-colors duration-300 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-50 relative z-10">
                <p class="text-xs text-gray-400 flex items-center gap-1 font-medium">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Lifetime shopping
                </p>
            </div>
        </div>

        <!-- Total Spent -->
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-500 font-bold text-xs mb-1 uppercase tracking-wider">Total Spent</p>
                    <h3 class="text-4xl font-black text-gray-900 group-hover:text-[#10b981] transition-colors">₹{{ number_format($totalSpent, 0) }}</h3>
                </div>
                <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-green-500 group-hover:bg-green-500 group-hover:text-white transition-colors duration-300 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-50 relative z-10">
                <p class="text-xs text-gray-400 flex items-center gap-1 font-medium">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Updated recently
                </p>
            </div>
        </div>

        <!-- Saved Addresses -->
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-pink-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-500 font-bold text-xs mb-1 uppercase tracking-wider">Addresses</p>
                    <h3 class="text-4xl font-black text-gray-900 group-hover:text-[#ec4899] transition-colors">{{ $savedAddresses }}</h3>
                </div>
                <div class="w-14 h-14 rounded-full bg-pink-50 flex items-center justify-center text-pink-500 group-hover:bg-pink-500 group-hover:text-white transition-colors duration-300 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-50 relative z-10">
                <p class="text-xs text-gray-400 flex items-center gap-1 font-medium">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Saved locations
                </p>
            </div>
        </div>
    </div>

    <!-- Quick Actions (Dynamic Interactive Tiles) -->
    <div class="mb-12">
        <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#7c3aed]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Quick Actions
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Shop Now -->
            <a href="{{ route('products.index') }}" class="group relative overflow-hidden bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1 text-lg">Shop Now</h3>
                    <p class="text-sm text-gray-500">Discover new arrivals</p>
                </div>
            </a>

            <!-- View Orders -->
            <a href="{{ route('profile.orders') }}" class="group relative overflow-hidden bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1 text-lg">Order History</h3>
                    <p class="text-sm text-gray-500">Track your packages</p>
                </div>
            </a>

            <!-- Addresses -->
            <a href="{{ route('profile.addresses') }}" class="group relative overflow-hidden bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1 text-lg">Saved Addresses</h3>
                    <p class="text-sm text-gray-500">Manage delivery spots</p>
                </div>
            </a>

            <!-- Settings -->
            <a href="{{ route('profile.edit') }}" class="group relative overflow-hidden bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-red-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1 text-lg">Account Settings</h3>
                    <p class="text-sm text-gray-500">Update your details</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Orders -->
    @if ($recentOrders->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-black text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Recent Activity
                </h2>
                <a href="{{ route('profile.orders') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors flex items-center gap-1">View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></a>
            </div>
            
            <div class="space-y-4">
                @foreach ($recentOrders as $order)
                    <div class="group bg-white rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 group-hover:scale-110 group-hover:border-indigo-200 group-hover:bg-indigo-50 transition-all duration-300">
                                <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <div>
                                <p class="text-gray-900 font-bold mb-1 text-lg">Order #{{ $order->id }}</p>
                                <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                                    <span>{{ $order->created_at->format('M d, Y • h:i A') }}</span>
                                    <span>•</span>
                                    <span class="text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full text-xs font-bold">{{ $order->items->count() }} item(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between md:justify-end gap-6 md:w-1/3">
                            <div class="text-left md:text-right">
                                <p class="text-gray-900 font-black text-xl mb-1">₹{{ number_format($order->total_amount, 0) }}</p>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider
                                    @if($order->status == 'completed') bg-green-100 text-green-800
                                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'failed') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    <svg class="w-2 h-2 mr-1.5 
                                        @if($order->status == 'completed') text-green-500
                                        @elseif($order->status == 'pending') text-yellow-500
                                        @elseif($order->status == 'failed') text-red-500
                                        @else text-gray-500
                                        @endif" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"></circle></svg>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <a href="{{ route('profile.orders') }}" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Recommended Products -->
    <div class="mb-8">
        <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            Recommended for You
        </h2>
        @if ($recommendedProducts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach ($recommendedProducts as $product)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                        <a href="{{ route('products.show', $product) }}" class="block w-full h-56 relative group">
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @elseif($product->images && $product->images->count() > 0)
                                @php
                                    $imagePath = $product->images->first()->image_path;
                                    $imageSrc = (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) ? $imagePath : url($imagePath);
                                @endphp
                                <img src="{{ $imageSrc }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400 font-medium">No Image</span>
                                </div>
                            @endif
                            
                            <div class="absolute top-3 right-3">
                                <span class="bg-[#10b981] text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                    {{ $product->stock ?? 0 }} In Stock
                                </span>
                            </div>
                        </a>
                        
                        <div class="p-5 flex-1 flex flex-col">
                            @if ($product->category)
                                <div class="mb-3">
                                    <span class="inline-block bg-[#a855f7] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                        {{ $product->category }}
                                    </span>
                                </div>
                            @endif
                            
                            <a href="{{ route('products.show', $product) }}" class="hover:text-purple-600 transition-colors">
                                <h3 class="text-lg font-bold text-gray-900 leading-tight mb-2">{{ $product->name }}</h3>
                            </a>
                            
                            @if ($product->description)
                                <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-1">{{ Str::limit($product->description, 60) }}</p>
                            @else
                                <div class="flex-1 mb-4"></div>
                            @endif
                            
                            <div class="flex justify-between items-end mb-5 pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400 mb-1">Price</p>
                                    <span class="text-2xl font-black text-[#8b5cf6]">₹{{ number_format($product->price, 0) }}</span>
                                </div>
                                <div class="text-right">
                                    <div class="flex text-yellow-400 text-sm">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    </div>
                                    <p class="text-[11px] text-gray-400 mt-1">(125 reviews)</p>
                                </div>
                            </div>
                            
                            @unless(auth()->user()->isAdmin())
                            <div class="mt-auto">
                                <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-[#10b981] hover:bg-[#059669] text-white py-2.5 rounded-lg text-sm font-semibold transition flex items-center justify-center gap-2" 
                                        {{ (isset($product->stock) && $product->stock == 0) ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        {{ (isset($product->stock) && $product->stock == 0) ? 'Out of Stock' : 'Add to Cart' }}
                                    </button>
                                </form>
                            </div>
                            @endunless
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
