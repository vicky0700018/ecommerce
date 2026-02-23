@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Add New Product</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Product Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price (₹) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                        required>
                    @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock *</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('stock') border-red-500 @enderror"
                        required>
                    @error('stock')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-semibold mb-2">Category</label>
                <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('category') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    <option value="fashion" {{ old('category') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                    <option value="mobile" {{ old('category') == 'mobile' ? 'selected' : '' }}>Mobile</option>
                    <option value="beauty" {{ old('category') == 'beauty' ? 'selected' : '' }}>Beauty</option>
                    <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                    <option value="home" {{ old('category') == 'home' ? 'selected' : '' }}>Home</option>
                    <option value="appliances" {{ old('category') == 'appliances' ? 'selected' : '' }}>Appliances</option>
                    <option value="toys" {{ old('category') == 'toys' ? 'selected' : '' }}>Toys</option>
                    <option value="baby" {{ old('category') == 'baby' ? 'selected' : '' }}>Baby</option>
                    <option value="furniture" {{ old('category') == 'furniture' ? 'selected' : '' }}>Furniture</option>
                    <option value="sports" {{ old('category') == 'sports' ? 'selected' : '' }}>Sports</option>
                    <option value="books" {{ old('category') == 'books' ? 'selected' : '' }}>Books</option>
                </select>
                @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image_url" class="block text-gray-700 font-semibold mb-2">Image URL</label>
                <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('image_url') border-red-500 @enderror"
                    placeholder="https://example.com/image.jpg">
                @error('image_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                    Add Product
                </button>
                <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
