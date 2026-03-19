@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Product Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price (₹) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                        required>
                    @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock *</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
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
                    <option value="fashion" {{ old('category', $product->category) == 'fashion' ? 'selected' : '' }}>Fashion</option>
                    <option value="mobile" {{ old('category', $product->category) == 'mobile' ? 'selected' : '' }}>Mobile</option>
                    <option value="beauty" {{ old('category', $product->category) == 'beauty' ? 'selected' : '' }}>Beauty</option>
                    <option value="electronics" {{ old('category', $product->category) == 'electronics' ? 'selected' : '' }}>Electronics</option>
                    <option value="home" {{ old('category', $product->category) == 'home' ? 'selected' : '' }}>Home</option>
                    <option value="appliances" {{ old('category', $product->category) == 'appliances' ? 'selected' : '' }}>Appliances</option>
                    <option value="toys" {{ old('category', $product->category) == 'toys' ? 'selected' : '' }}>Toys</option>
                    <option value="baby" {{ old('category', $product->category) == 'baby' ? 'selected' : '' }}>Baby</option>
                    <option value="furniture" {{ old('category', $product->category) == 'furniture' ? 'selected' : '' }}>Furniture</option>
                    <option value="sports" {{ old('category', $product->category) == 'sports' ? 'selected' : '' }}>Sports</option>
                    <option value="books" {{ old('category', $product->category) == 'books' ? 'selected' : '' }}>Books</option>
                </select>
                @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image_url" class="block text-gray-700 font-semibold mb-2">Image URL (Primary)</label>
                <input type="url" id="image_url" name="image_url" value="{{ old('image_url', $product->image_url) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('image_url') border-red-500 @enderror"
                    placeholder="https://example.com/image.jpg">
                @error('image_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Gallery Image URLs</label>
                
                <div id="gallery-urls-container" class="space-y-3">
                    @foreach($product->images as $image)
                        <div class="flex gap-2">
                            <input type="url" name="existing_images[{{ $image->id }}]" value="{{ $image->image_path }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="https://example.com/image.jpg">
                            <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 shadow-sm">Remove</button>
                        </div>
                    @endforeach
                    <div class="flex gap-2">
                        <input type="url" name="new_image_urls[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="https://example.com/new-gallery.jpg">
                        <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 shadow-sm">Remove</button>
                    </div>
                </div>
                
                <button type="button" onclick="addUrlField()" class="mt-3 bg-blue-50 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-100 text-sm font-semibold border border-blue-200">+ Add Another URL</button>
                <p class="text-sm text-gray-500 mt-2">Paste external image links (like Unsplash) to add them to your gallery. To remove an image, just click Remove or clear the input.</p>
            </div>

            <div class="flex justify-between items-center mt-8 pt-4 border-t border-gray-200">
                <div class="flex gap-4">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold shadow-sm">
                        Update Product
                    </button>
                    <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 font-semibold shadow-sm">
                        Cancel
                    </a>
                </div>
                
                <button type="button" onclick="if(confirm('Are you sure you want to completely delete this product? This action cannot be undone.')) { document.getElementById('delete-product-form').submit(); }" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 font-semibold text-sm shadow-sm flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                    Delete Product
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Form to delete the entire product -->
<form id="delete-product-form" action="{{ route('products.destroy', $product) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
function addUrlField() {
    const container = document.getElementById('gallery-urls-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2';
    div.innerHTML = `
        <input type="url" name="new_image_urls[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="https://example.com/gallery.jpg">
        <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 shadow-sm">Remove</button>
    `;
    container.appendChild(div);
}
</script>

@endsection
