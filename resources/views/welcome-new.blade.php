<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopHub - Your Premier E-Commerce Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <h1 class="text-3xl font-bold gradient-bg bg-clip-text text-transparent">ShopHub</h1>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="px-6 py-2 text-gray-700 hover:text-indigo-600 font-semibold">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2 text-gray-700 hover:text-indigo-600 font-semibold">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section 
    <section class="gradient-bg text-white py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl md:text-6xl font-bold mb-6">Welcome to ShopHub</h2>
            <p class="text-xl md:text-2xl mb-8 text-indigo-100 max-w-2xl mx-auto">Discover amazing products at unbeatable prices. Shop smarter, save more!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#products" class="px-8 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50">Shop Now</a>
                <a href="#features" class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-indigo-600">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Features Section -
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-4xl font-bold text-center text-gray-900 mb-12">Why Choose ShopHub?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card-hover bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 text-center border border-indigo-100">
                    <div class="text-5xl mb-4">💰</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Best Prices</h4>
                    <p class="text-gray-600">We offer the most competitive prices in the market.</p>
                </div>
                <div class="card-hover bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-8 text-center border border-green-100">
                    <div class="text-5xl mb-4">🚚</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Fast Shipping</h4>
                    <p class="text-gray-600">Quick delivery with free shipping on orders over $50.</p>
                </div>
                <div class="card-hover bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-8 text-center border border-purple-100">
                    <div class="text-5xl mb-4">🔒</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Secure Checkout</h4>
                    <p class="text-gray-600">Industry-leading encryption protects your information.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Preview -
    <section id="products" class="py-24 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-4xl font-bold text-center text-gray-900 mb-12">Featured Products</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl">
                        <div class="bg-gradient-to-br from-indigo-400 to-purple-500 h-48 flex items-center justify-center text-6xl">
                            {{ $i === 1 ? '🎧' : ($i === 2 ? '👜' : ($i === 3 ? '⌚' : '📱')) }}
                        </div>
                        <div class="p-6">
                            <h5 class="text-xl font-bold text-gray-900 mb-2">{{ $i === 1 ? 'Premium Headphones' : ($i === 2 ? 'Designer Handbag' : ($i === 3 ? 'Smart Watch' : 'Latest Smartphone')) }}</h5>
                            <p class="text-gray-600 mb-4">High-quality product</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-indigo-600">${{ 99 + ($i * 100) }}</span>
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">Add Cart</button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Newsletter -
    <section class="py-24 gradient-bg text-white">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-4xl font-bold mb-4">Subscribe to Our Newsletter</h3>
            <p class="text-lg text-indigo-100 mb-8">Get exclusive deals delivered to your inbox</p>
            <form class="flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="Enter your email" class="flex-1 px-6 py-3 rounded-lg text-gray-900" required>
                <button type="submit" class="px-8 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Footer 
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; 2026 ShopHub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>-->
