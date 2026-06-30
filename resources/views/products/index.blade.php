@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Premium Header -->
    <div class="relative overflow-hidden bg-gradient-to-r from-purple-900 via-indigo-900 to-[#1e1b4b] text-white rounded-[2rem] shadow-2xl p-8 md:p-12 mb-8 border border-white/10 group">
        <!-- Abstract Decorative Elements -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-fuchsia-500/20 blur-3xl group-hover:bg-fuchsia-500/30 transition-all duration-700"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 rounded-full bg-cyan-500/20 blur-3xl group-hover:bg-cyan-500/30 transition-all duration-700"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
                <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold mb-4 tracking-widest uppercase text-purple-200">
                    ✨ Discover Excellence
                </span>
                <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">
                    Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-300 to-cyan-300">Premium Collection</span>
                </h1>
                <p class="text-lg text-white/80 max-w-2xl font-medium leading-relaxed">
                    Explore our handpicked selection of top-tier products designed to elevate your lifestyle. Guaranteed quality and best prices.
                </p>
            </div>
            
            @if(auth()->check() && auth()->user()->isAdmin())
            <div class="flex-shrink-0">
                <a href="{{ route('products.create') }}" class="group relative inline-flex items-center gap-2 bg-white text-indigo-900 px-8 py-4 rounded-xl font-black shadow-[0_0_40px_rgba(255,255,255,0.2)] hover:shadow-[0_0_60px_rgba(255,255,255,0.4)] hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-fuchsia-100 to-cyan-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <span class="relative z-10 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add Product
                    </span>
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Category Navigation -->
    <x-category-nav />

    @if(request('search'))
        <div class="mb-6 flex items-center justify-between bg-white p-4 rounded-xl shadow-md border-l-4 border-indigo-500">
            <div>
                <span class="text-gray-600">Search results for:</span>
                <span class="font-bold text-xl ml-2 text-indigo-700">"{{ request('search') }}"</span>
                <span class="ml-2 text-sm text-gray-500">({{ $products->count() }} found)</span>
            </div>
            <a href="{{ route('products.index') }}" class="text-red-500 hover:text-red-700 font-bold flex items-center gap-2 px-4 py-2 hover:bg-red-50 rounded-lg transition">
                <span>✕</span> Clear Search
            </a>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="bg-green-400 text-black px-6 py-4 rounded-xl mb-6 shadow-lg font-bold animate-pulse">
            ✨ {{ $message }}
        </div>
    @endif

    @if ($products->isEmpty())
        <div class="text-center py-16 bg-primary rounded-2xl shadow-2xl border-2 border-blue-600">
            <p class="text-black text-xl mb-4 font-bold">No products found.</p>
            @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('products.create') }}" class="bg-blue-600 text-black px-8 py-3 rounded-full hover:bg-blue-700 inline-block font-bold">Create one now!</a>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                    <a href="{{ route('products.show', $product) }}" class="block w-full h-56 relative group">
                        @if ($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @elseif($product->images->count() > 0)
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
                                {{ $product->stock }} In Stock
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
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-1">{{ Str::limit(strip_tags($product->description), 60) }}</p>
                        @else
                            <div class="flex-1 mb-4"></div>
                        @endif
                        
                        <div class="flex justify-between items-end mb-5 pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Price</p>
                                <div class="flex items-end gap-2">
                                    <span class="text-2xl font-black text-[#8b5cf6]">₹{{ number_format($product->price, 0) }}</span>
                                    @if($product->original_price && $product->original_price > $product->price)
                                        @php
                                            $discountPercentage = round((($product->original_price - $product->price) / $product->original_price) * 100);
                                        @endphp
                                        <span class="text-sm text-gray-400 line-through mb-1">₹{{ number_format($product->original_price, 0) }}</span>
                                        <span class="text-xs text-green-600 font-bold mb-1">{{ $discountPercentage }}% off</span>
                                    @endif
                                </div>
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
                        
                        @unless(auth()->check() && auth()->user()->isAdmin())
                        <div class="mt-auto">
                            @auth
                                <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-[#10b981] hover:bg-[#059669] text-white py-2.5 rounded-lg text-sm font-semibold transition flex items-center justify-center gap-2" 
                                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        {{ $product->stock == 0 ? 'Out of Stock' : 'Add to Cart' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="w-full bg-[#10b981] hover:bg-[#059669] text-white py-2.5 rounded-lg text-sm font-semibold transition flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Add to Cart
                                </a>
                            @endauth
                        </div>
                        @endunless
                        
                        @if(auth()->check() && auth()->user()->isAdmin())
                        <div class="flex gap-2 mt-auto pt-2 border-t border-gray-100">
                            <a href="{{ route('products.edit', $product) }}" class="flex-1 bg-yellow-100 text-yellow-700 px-3 py-2 rounded-lg text-center hover:bg-yellow-200 text-sm font-bold transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-100 text-red-700 px-3 py-2 rounded-lg hover:bg-red-200 text-sm font-bold transition"
                                    onclick="return confirm('Are you sure?')">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
