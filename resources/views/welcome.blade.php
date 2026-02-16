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
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-900">Featured Products</h3>
            <div class="grid md:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="aspect-square bg-gray-200 flex items-center justify-center text-6xl">📦</div>
                    <div class="p-4">
                        <h5 class="font-bold text-lg mb-2 text-gray-900">Product {{ $i }}</h5>
                        <p class="text-gray-600 text-sm mb-4">High quality product at great price</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-indigo-600">${{ 49.99 + ($i * 10) }}</span>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Add to Cart</button>
                        </div>
                    </div>
            </div>
            @endfor
        </div>
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
            </div>
        </div>
    </footer>

</body>

</html>