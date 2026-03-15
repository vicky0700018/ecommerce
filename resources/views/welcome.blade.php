<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopHub - E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">ShopHub</h1>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-lg mx-8 hidden md:block">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Search for products..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" value="{{ request('search') }}">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center gap-4">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-800">Logout</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Login</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Register</a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl font-bold mb-6">Welcome to ShopHub</h2>
            <p class="text-xl mb-8 text-indigo-100">Your one-stop destination for amazing products and deals</p>
            @guest
            <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition">Get Started</a>
            @endguest
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-900">Why Choose ShopHub?</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <div class="text-4xl mb-4">🎯</div>
                    <h4 class="text-xl font-bold mb-2 text-gray-900">Best Prices</h4>
                    <p class="text-gray-600">Guaranteed lowest prices on all products</p>
                </div>
                <div class="text-center p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <div class="text-4xl mb-4">🚚</div>
                    <h4 class="text-xl font-bold mb-2 text-gray-900">Fast Shipping</h4>
                    <p class="text-gray-600">Quick and reliable delivery to your doorstep</p>
                </div>
                <div class="text-center p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <div class="text-4xl mb-4">🔒</div>
                    <h4 class="text-xl font-bold mb-2 text-gray-900">Secure Checkout</h4>
                    <p class="text-gray-600">100% secure payment processing</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-16" style="background-color: #f3e8ff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-900">Featured Products</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products->take(8) as $product)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden flex flex-col hover:shadow-xl transition-shadow duration-300">
                        @if ($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">
                        @else
                            <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500 font-medium">No Image</span>
                            </div>
                        @endif
                        
                        <div class="p-5 flex-1 flex flex-col">
                            <h3 class="text-lg font-bold mb-2 text-gray-900 leading-tight">{{ $product->name }}</h3>
                            @if ($product->category)
                                <div class="mb-3">
                                    <span class="inline-block bg-purple-100 text-purple-700 text-[10px] px-2 py-1 rounded-full uppercase font-bold tracking-wider">{{ $product->category }}</span>
                                </div>
                            @endif
                            @if ($product->description)
                                <p class="text-gray-600 text-[13px] mb-4 flex-1">{{ Str::limit($product->description, 80) }}</p>
                            @endif
                            <div class="flex justify-between items-center mb-5 mt-auto">
                                <span class="text-3xl font-bold text-blue-600">₹{{ number_format($product->price, 0) }}</span>
                                <span class="text-xs bg-blue-600 text-white px-3 py-1 rounded-full flex items-center gap-1 font-semibold shadow-sm tracking-wide">
                                    📦 {{ $product->stock }}
                                </span>
                            </div>
                            
                            <div class="mt-auto">
                                @auth
                                    <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-[#22c55e] hover:bg-[#16a34a] text-white px-4 py-3 rounded-lg text-sm font-bold transition flex justify-center items-center gap-2 shadow-sm" 
                                            {{ $product->stock == 0 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                            {{ $product->stock == 0 ? 'Out of Stock' : 'Add to Cart' }}
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" onclick="alert('Please login first to add items to your cart!');" class="w-full bg-[#22c55e] hover:bg-[#16a34a] text-white px-4 py-3 rounded-lg text-sm font-bold transition flex justify-center items-center gap-2 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>
                                        Add to Cart
                                    </a>
                                @endauth
                            </div>
                            
                            @if(auth()->check() && auth()->user()->isAdmin())
                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('products.edit', $product) }}" class="flex-1 bg-[#fbbf24] text-white px-3 py-2 rounded-lg text-center hover:bg-[#f59e0b] text-sm font-bold shadow-sm transition flex justify-center items-center gap-1">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1 flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-[#ef4444] text-white px-3 py-2 rounded-lg hover:bg-[#dc2626] text-sm font-bold shadow-sm transition flex justify-center items-center gap-1"
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
            @if($products->count() > 8)
                <div class="text-center mt-12">
                    <a href="{{ route('products.index') }}" class="inline-block bg-white text-indigo-600 font-bold border-2 border-indigo-600 px-8 py-3 rounded-lg hover:bg-indigo-50 transition">
                        View All Products
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="bg-indigo-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-bold mb-4">Subscribe to Our Newsletter</h3>
            <p class="mb-8 text-indigo-100">Get the latest deals and updates delivered to your inbox</p>
            <form class="flex gap-2 max-w-md mx-auto">
                <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none" required>
                <button type="submit" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-bold hover:bg-gray-100 transition">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h5 class="text-white font-bold mb-4">ShopHub</h5>
                    <p>Your trusted e-commerce destination</p>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">Quick Links</h5>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">Products</a></li>
                        <li><a href="#" class="hover:text-white">About</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">Customer Service</h5>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">Help Center</a></li>
                        <li><a href="#" class="hover:text-white">Returns</a></li>
                        <li><a href="#" class="hover:text-white">Shipping</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">Legal</h5>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">Privacy</a></li>
                        <li><a href="#" class="hover:text-white">Terms</a></li>
                        <li><a href="#" class="hover:text-white">Cookies</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p>&copy; 2026 ShopHub. All rights reserved.</p>
                <p>Made with ❤️ by Vicky</p> 
            </div>
        </div>
    </footer>

</body>

</html>