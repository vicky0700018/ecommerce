@extends('layouts.app')

@section('content')
@php
    $images = [];
    if ($product->image_url) {
        $images[] = $product->image_url;
    }
    if ($product->images && $product->images->count() > 0) {
        foreach ($product->images as $img) {
            $images[] = url($img->image_path);
        }
    }
    if (empty($images)) {
        // Mock image if none exists
        $images[] = 'https://via.placeholder.com/600x600.png?text=No+Image';
    }
@endphp

<div class="bg-gray-100 min-h-screen py-4">
    <div class="max-w-[1200px] mx-auto bg-white shadow-sm" x-data="productGallery()">
        
        <!-- Breadcrumbs (Simplified) -->
        <div class="text-xs text-gray-500 p-4 border-b border-gray-200">
            <a href="{{ url('/') }}" class="hover:text-blue-600">Home</a> &gt; 
            <a href="{{ route('products.index') }}" class="hover:text-blue-600">Products</a> &gt; 
            @if($product->category)
                <a href="#" class="hover:text-blue-600 capitalize">{{ $product->category }}</a> &gt; 
            @endif
            <span class="text-gray-800">{{ $product->name }}</span>
        </div>

        <div class="flex flex-col md:flex-row">
            
            <!-- Left Column: Images & Buttons -->
            <div class="md:w-[41.66%] p-4 border-r border-gray-200">
                
                <div class="flex gap-4 mb-4">
                    <!-- Thumbnails Sidebar -->
                    <div class="flex flex-col gap-2 w-16 items-center flex-shrink-0">
                        @foreach($images as $index => $img)
                            <div class="w-16 h-16 border-2 rounded overflow-hidden cursor-pointer hover:border-blue-500"
                                 :class="activeIndex === {{ $index }} ? 'border-blue-500' : 'border-gray-200'"
                                 @mouseover="setActive({{ $index }})"
                                 @click="setActive({{ $index }})">
                                <img src="{{ $img }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>

                    <!-- Main Image Preview -->
                    <div class="flex-1 border border-gray-200 rounded relative group flex items-center justify-center p-4 h-[450px]">
                        <!-- Magnifier Icon mock -->
                        <div class="absolute top-2 right-2 text-gray-400 p-1 border border-gray-200 rounded-full cursor-pointer hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9" /></svg>
                        </div>
                        
                        <!-- Alpine will swap src based on activeIndex -->
                        @foreach($images as $index => $img)
                            <img src="{{ $img }}" class="max-h-[400px] object-contain transition-opacity duration-300"
                                 x-show="activeIndex === {{ $index }}"
                                 x-transition.opacity />
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons: Add to Cart & Buy Now -->
                <div class="flex gap-4">
                    <!-- Add to Cart -->
                    @auth
                        <form action="{{ route('cart.store') }}" method="POST" class="w-1/2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full h-14 bg-[#ff9f00] hover:shadow-lg text-white text-lg font-bold rounded shadow-sm flex items-center justify-center gap-2" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" /></svg>
                                {{ $product->stock == 0 ? 'OUT OF STOCK' : 'ADD TO CART' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="w-1/2 h-14 bg-[#ff9f00] hover:shadow-lg text-white text-lg font-bold rounded shadow-sm flex items-center justify-center gap-2" onclick="alert('Please login first');">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" /></svg>
                            ADD TO CART
                        </a>
                    @endauth

                    <!-- Buy Now -->
                    <a href="#" class="w-1/2 h-14 bg-[#fb641b] hover:shadow-lg text-white text-lg font-bold rounded shadow-sm flex items-center justify-center gap-2" onclick="alert('Proceeding to checkout');">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd" /></svg>
                        BUY NOW
                    </a>
                </div>

            </div>

            <!-- Right Column: Product Info -->
            <div class="md:w-[58.33%] p-6">
                
                <h1 class="text-lg md:text-xl font-medium text-gray-900 leading-tight mb-2">{{ $product->name }}</h1>
                
                @if(auth()->check() && auth()->user()->isAdmin())
                    <div class="flex gap-2 mb-4">
                        <a href="{{ route('products.edit', $product) }}" class="bg-blue-50 text-blue-600 border border-blue-200 px-3 py-1 rounded text-xs font-semibold hover:bg-blue-100 flex items-center gap-1">
                            ✏️ Edit Product
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this product permanently?')" class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded text-xs font-semibold hover:bg-red-100 flex items-center gap-1">
                                🗑️ Delete Product
                            </button>
                        </form>
                    </div>
                @endif
                
                <!-- Ratings Mockup -->
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-green-600 text-white text-xs font-bold px-1.5 py-0.5 rounded flex items-center gap-0.5">
                        4.4 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" /></svg>
                    </span>
                    <span class="text-sm text-gray-500 font-medium hover:text-blue-600 cursor-pointer">36,115 Ratings & 2,345 Reviews</span>
                    
                    <!-- ShopHub Assured Badge -->
                    <span class="ml-2 inline-flex items-center gap-1 bg-gradient-to-r from-blue-600 to-indigo-600 px-2 py-0.5 rounded-sm text-white text-[11px] font-black italic shadow-sm tracking-wide">
                        ShopHub
                        <span class="text-blue-100 font-semibold not-italic tracking-normal text-[10px]">Assured</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 ml-0.5"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 11.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>
                    </span>
                </div>

                <div class="text-sm text-green-600 font-medium mb-1">Special price</div>
                
                <div class="flex items-end gap-3 mb-4">
                    <span class="text-3xl font-bold text-gray-900">₹{{ number_format($product->price, 0) }}</span>
                    <!-- Fake discount -->
                    <span class="text-base text-gray-500 line-through mb-1">₹{{ number_format($product->price * 1.5, 0) }}</span>
                    <span class="text-base text-green-600 font-bold mb-1">33% off</span>
                </div>

                <!-- Offers styling -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-800 mb-2">Available offers</h3>
                    <ul class="text-sm space-y-2">
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 bg-green-100 rounded-full p-0.5 px-1 font-bold text-[10px] mt-0.5">🏷️</span>
                            <span><strong>Bank Offer</strong> 5% Cashback on Flipkart Axis Bank Card <a href="#" class="text-blue-600 font-medium">T&C</a></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600 bg-green-100 rounded-full p-0.5 px-1 font-bold text-[10px] mt-0.5">🏷️</span>
                            <span><strong>Special Price</strong> Get extra 10% off (price inclusive of cashback/coupon) <a href="#" class="text-blue-600 font-medium">T&C</a></span>
                        </li>
                    </ul>
                </div>

                <!-- Product Details -->
                <div class="border-t border-gray-200 pt-6 my-6">
                    <div class="grid grid-cols-3 md:grid-cols-4 gap-y-4 text-sm">
                        <div class="text-gray-500">Delivery</div>
                        <div class="col-span-2 md:col-span-3 font-medium">
                            <span class="text-gray-900 border-b border-dashed border-gray-400 cursor-pointer">Delivery in 2 Days</span> | 
                            <span class="text-green-600">Free</span> <span class="text-gray-500 line-through">₹40</span>
                        </div>

                        <div class="text-gray-500">Highlights</div>
                        <div class="col-span-2 md:col-span-3">
                            <ul class="list-disc pl-4 space-y-1 text-gray-800">
                                <li>Category: <span class="capitalize">{{ $product->category ?? 'General' }}</span></li>
                                <li>In Stock: {{ $product->stock }} items</li>
                                <li>100% Original Products</li>
                                <li>7 Days Replacement Policy</li>
                            </ul>
                        </div>
                        
                        <div class="text-gray-500">Seller</div>
                        <div class="col-span-2 md:col-span-3 font-medium text-blue-600 cursor-pointer flex gap-1 items-center">
                            ShopHub Retail <span class="bg-blue-600 text-white rounded-full text-[10px] px-1.5 ml-1">4.8</span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="border border-gray-200 rounded-lg p-5">
                    <h2 class="text-xl font-medium mb-4">Product Description</h2>
                    <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $product->description ?? 'No description available for this product.' }}</p>
                </div>

            </div>
        </div>
    </div>
</div>

@once
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productGallery', () => ({
            activeIndex: 0,
            setActive(index) {
                this.activeIndex = index;
            }
        }));
    });
</script>
@endonce
@endsection
