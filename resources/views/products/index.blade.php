@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-5xl font-black text-purple-900">🎁 Our Premium Collection</h1>
        <a href="{{ route('products.create') }}" class="bg-primary text-black px-8 py-3 rounded-full hover:bg-blue-700 shadow-xl font-bold transform hover:scale-110 transition duration-300">
           <button class="bg-primary"> Add Product</button>
        </a>
    </div>

    <div class="mb-6">
        <x-category-nav />
    </div>

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
            <a href="{{ route('products.create') }}" class="bg-blue-600 text-black px-8 py-3 rounded-full hover:bg-blue-700 inline-block font-bold">Create one now!</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-blue-500/50 transition-all transform hover:-translate-y-3 duration-300 border-2 border-blue-300">
                    @if ($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-blue-400 flex items-center justify-center">
                            <span class="text-black font-bold text-lg">📦 No Image</span>
                        </div>
                    @endif
                    
                    <div class="p-5">
                        <h3 class="text-xl font-black mb-2 text-black">{{ $product->name }}</h3>
                        @if ($product->category)
                            <span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full uppercase font-bold mb-2">{{ $product->category }}</span>
                        @endif
                        @if ($product->description)
                            <p class="text-black text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                        @endif
                        <div class="flex justify-between items-center mb-5">
                            <span class="text-4xl font-black text-blue-600">₹{{ number_format($product->price, 0) }}</span>
                            <span class="text-sm bg-blue-600 text-black px-3 py-1 rounded-full font-bold">📦 {{ $product->stock }}</span>
                        </div>
                        
                        <div class="flex gap-2 mb-3">
                            @auth
                                <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-green-500 text-black px-3 py-3 rounded-xl hover:bg-green-600 text-sm font-bold shadow-lg transition transform hover:scale-105" 
                                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                                        {{ $product->stock == 0 ? '❌ Out of Stock' : '🛒 Add to Cart' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="flex-1 bg-blue-600 text-black px-3 py-3 rounded-xl text-center hover:bg-blue-700 text-sm font-bold shadow-lg">
                                    🛒 Add to Cart
                                </a>
                            @endauth
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('products.edit', $product) }}" class="flex-1 bg-yellow-500 text-black px-3 py-2 rounded-lg text-center hover:bg-yellow-600 text-sm font-bold shadow-md transition transform hover:scale-105">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 text-black px-3 py-2 rounded-lg hover:bg-red-600 text-sm font-bold shadow-md transition transform hover:scale-105"
                                    onclick="return confirm('Are you sure?')">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
