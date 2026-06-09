<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopSphere - E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-in-right {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
            }
            50% {
                box-shadow: 0 0 40px rgba(99, 102, 241, 0.8);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes blob {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-out;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.8s ease-out;
        }

        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        video {
            filter: brightness(0.7);
        }

        .hero-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">ShopSphere</h1>
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

    <!-- Hero Section with Animated Background -->
    <section class="relative h-screen overflow-hidden">
        <!-- Animated Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 animate-pulse"></div>
        
        <!-- Video/Background Media -->
        <div class="absolute inset-0 opacity-50">
            <video autoplay muted loop playsinline class="w-full h-full object-cover">
                <source src="https://cdn.pixabay.com/vimeo/753/753-sd_640_360_25fps.mp4" type="video/mp4">
                <source src="https://media.w3.org/2016/12/sample_1280x720_surfing_with_audio.mp4" type="video/mp4">
            </video>
        </div>

        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/70"></div>

        <!-- Animated Background Shapes -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative h-full flex items-center justify-center z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center w-full">
                <div class="animate-fade-in">
                    <h2 class="text-6xl lg:text-7xl font-black mb-6 leading-tight drop-shadow-lg">
                        Welcome to <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">ShopSphere</span>
                    </h2>
                    <p class="text-2xl lg:text-3xl mb-8 text-gray-200 font-light drop-shadow-md">
                        Discover Amazing Products & Exclusive Deals
                    </p>
                    <div class="flex gap-4 justify-center mb-12 flex-wrap">
                        <div class="text-center">
                            <p class="text-4xl font-bold text-indigo-300">10K+</p>
                            <p class="text-gray-300">Products</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold text-purple-300">50%</p>
                            <p class="text-gray-300">Off Sale</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold text-pink-300">24/7</p>
                            <p class="text-gray-300">Support</p>
                        </div>
                    </div>
                    @guest
                    <div class="flex gap-4 justify-center flex-wrap">
                        <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg">
                            🚀 Get Started Now
                        </a>
                        <a href="{{ route('login') }}" class="inline-block bg-white/20 backdrop-blur-md text-white px-8 py-4 rounded-lg font-bold hover:bg-white/30 transition-all duration-300 text-lg border border-white/30">
                            👤 Sign In
                        </a>
                    </div>
                    @else
                    <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg">
                        🛍️ Shop Now
                    </a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Flash Sale / Limited Offers Section -->
    <section class="bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 py-12 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Offer 1 -->
                <div class="bg-black/30 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:scale-105 transition-transform duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-semibold opacity-90">⚡ FLASH SALE</p>
                            <h3 class="text-2xl font-bold mt-2">Mega Clearance</h3>
                        </div>
                        <span class="bg-white text-red-600 px-3 py-1 rounded-full font-bold text-sm">-50%</span>
                    </div>
                    <p class="mb-4 opacity-90">On selected items</p>
                    <div class="bg-black/50 rounded-lg p-3 text-center">
                        <p class="text-xs opacity-75">Ends in</p>
                        <p class="text-2xl font-bold">03:45:22</p>
                    </div>
                </div>

                <!-- Offer 2 -->
                <div class="bg-black/30 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:scale-105 transition-transform duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-semibold opacity-90">🎁 BUNDLE DEAL</p>
                            <h3 class="text-2xl font-bold mt-2">Buy More Save More</h3>
                        </div>
                        <span class="bg-white text-orange-600 px-3 py-1 rounded-full font-bold text-sm">-35%</span>
                    </div>
                    <p class="mb-4 opacity-90">On combo packs</p>
                    <div class="bg-black/50 rounded-lg p-3 text-center">
                        <p class="text-xs opacity-75">Ends in</p>
                        <p class="text-2xl font-bold">05:22:15</p>
                    </div>
                </div>

                <!-- Offer 3 -->
                <div class="bg-black/30 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:scale-105 transition-transform duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-semibold opacity-90">💳 MEMBER EXCLUSIVE</p>
                            <h3 class="text-2xl font-bold mt-2">Extra Discount</h3>
                        </div>
                        <span class="bg-white text-yellow-600 px-3 py-1 rounded-full font-bold text-sm">-25%</span>
                    </div>
                    <p class="mb-4 opacity-90">For registered members</p>
                    <div class="bg-black/50 rounded-lg p-3 text-center">
                        <p class="text-xs opacity-75">Ends in</p>
                        <p class="text-2xl font-bold">08:10:45</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-4xl lg:text-5xl font-black text-gray-900 mb-4">Why ShopSphere is Your Best Choice</h3>
                <div class="h-1 w-24 bg-gradient-to-r from-indigo-600 to-purple-600 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-4 gap-6">
                <div class="group p-8 rounded-2xl border-2 border-gray-200 hover:border-indigo-600 hover:shadow-2xl transition-all duration-300 bg-white hover:bg-gradient-to-br hover:from-indigo-50 hover:to-purple-50">
                    <div class="text-5xl mb-4 transform group-hover:scale-125 transition-transform duration-300">💰</div>
                    <h4 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-indigo-600">Best Prices</h4>
                    <p class="text-gray-600 group-hover:text-gray-700">Guaranteed lowest prices on all products with frequent discounts</p>
                </div>
                
                <div class="group p-8 rounded-2xl border-2 border-gray-200 hover:border-purple-600 hover:shadow-2xl transition-all duration-300 bg-white hover:bg-gradient-to-br hover:from-purple-50 hover:to-pink-50">
                    <div class="text-5xl mb-4 transform group-hover:scale-125 transition-transform duration-300">🚀</div>
                    <h4 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-purple-600">Fast Shipping</h4>
                    <p class="text-gray-600 group-hover:text-gray-700">Quick and reliable delivery to your doorstep within 2-3 days</p>
                </div>
                
                <div class="group p-8 rounded-2xl border-2 border-gray-200 hover:border-pink-600 hover:shadow-2xl transition-all duration-300 bg-white hover:bg-gradient-to-br hover:from-pink-50 hover:to-rose-50">
                    <div class="text-5xl mb-4 transform group-hover:scale-125 transition-transform duration-300">🔒</div>
                    <h4 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-pink-600">Secure Payment</h4>
                    <p class="text-gray-600 group-hover:text-gray-700">100% secure checkout with encrypted payment processing</p>
                </div>

                <div class="group p-8 rounded-2xl border-2 border-gray-200 hover:border-blue-600 hover:shadow-2xl transition-all duration-300 bg-white hover:bg-gradient-to-br hover:from-blue-50 hover:to-cyan-50">
                    <div class="text-5xl mb-4 transform group-hover:scale-125 transition-transform duration-300">👥</div>
                    <h4 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-blue-600">24/7 Support</h4>
                    <p class="text-gray-600 group-hover:text-gray-700">Round-the-clock customer support for all your queries</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-20 bg-gradient-to-b from-purple-50 via-indigo-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-4xl lg:text-5xl font-black text-gray-900 mb-4">⭐ Featured Products</h3>
                <p class="text-xl text-gray-600">Handpicked selections just for you</p>
                <div class="h-1 w-24 bg-gradient-to-r from-indigo-600 to-purple-600 mx-auto rounded-full mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($products->take(8) as $product)
                    <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:scale-105 transition-all duration-300 flex flex-col">
                        <!-- Product Image -->
                        <a href="{{ route('products.show', $product) }}" class="block w-full h-56 relative group/image overflow-hidden bg-gray-200">
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @elseif($product->images->count() > 0)
                                @php
                                    $imagePath = $product->images->first()->image_path;
                                    $imageSrc = (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) ? $imagePath : url($imagePath);
                                @endphp
                                <img src="{{ $imageSrc }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                    <span class="text-gray-600 font-medium text-lg">📦 No Image</span>
                                </div>
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="text-white font-bold text-lg">👁️ View</span>
                            </div>

                            <!-- Stock Badge -->
                            <div class="absolute top-3 right-3">
                                @if($product->stock > 0)
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">{{ $product->stock }} In Stock</span>
                                @else
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">Out of Stock</span>
                                @endif
                            </div>
                        </a>
                        
                        <!-- Product Info -->
                        <div class="p-6 flex-1 flex flex-col">
                            @if ($product->category)
                                <span class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-[10px] px-3 py-1 rounded-full uppercase font-bold tracking-wider mb-3 w-fit">{{ $product->category }}</span>
                            @endif

                            <a href="{{ route('products.show', $product) }}" class="hover:text-indigo-600 transition-colors">
                                <h3 class="text-lg font-bold mb-2 text-gray-900 leading-tight line-clamp-2">{{ $product->name }}</h3>
                            </a>

                            @if ($product->description)
                                <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-2">{{ $product->description }}</p>
                            @endif

                            <!-- Price and Rating -->
                            <div class="flex justify-between items-center mb-5 pt-4 border-t border-gray-200">
                                <div>
                                    <p class="text-xs text-gray-500">Price</p>
                                    <span class="text-3xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">₹{{ number_format($product->price, 0) }}</span>
                                </div>
                                <div class="text-right">
                                    <p class="text-yellow-500 text-lg">⭐⭐⭐⭐⭐</p>
                                    <p class="text-xs text-gray-500">(125 reviews)</p>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            @unless(auth()->check() && auth()->user()->isAdmin())
                            <div class="mt-auto space-y-2">
                                @auth
                                    <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-4 py-3 rounded-xl text-sm font-bold transition-all duration-300 flex justify-center items-center gap-2 shadow-lg hover:shadow-xl" 
                                            {{ $product->stock == 0 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                            {{ $product->stock == 0 ? 'Out of Stock' : '🛒 Add to Cart' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('products.show', $product) }}" class="w-full bg-white border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 text-center">
                                        ❤️ View Details
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" onclick="alert('Please login first to add items to your cart!');" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-4 py-3 rounded-xl text-sm font-bold transition-all duration-300 flex justify-center items-center gap-2 shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>
                                        🛒 Add to Cart
                                    </a>
                                @endauth
                            </div>
                            @endunless
                            
                            @if(auth()->check() && auth()->user()->isAdmin())
                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('products.edit', $product) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-center hover:shadow-lg text-sm font-bold shadow transition-all duration-300 flex justify-center items-center gap-1">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1 flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg hover:shadow-lg text-sm font-bold shadow transition-all duration-300 flex justify-center items-center gap-1"
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
                <div class="text-center mt-16">
                    <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold px-10 py-4 rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg">
                        🔍 Browse All Products
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-4xl lg:text-5xl font-black mb-4">📧 Subscribe to Our Newsletter</h3>
            <p class="text-xl mb-8 text-white/90">Get exclusive deals, early access to new products, and special offers!</p>
            <form class="flex gap-3 max-w-2xl mx-auto flex-col md:flex-row">
                <input type="email" placeholder="Enter your email address..." class="flex-1 px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-4 focus:ring-white/30 font-medium" required>
                <button type="submit" class="bg-white text-purple-600 px-8 py-4 rounded-xl font-bold hover:shadow-2xl hover:scale-105 transition-all duration-300 whitespace-nowrap shadow-lg">
                    🚀 Subscribe
                </button>
            </form>
            <p class="text-sm text-white/70 mt-4">No spam, unsubscribe anytime • Join 50,000+ subscribers</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-gray-900 via-gray-800 to-black text-gray-300 py-16 border-t-4 border-gradient-to-r from-indigo-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-5 gap-12 mb-12">
                <div>
                    <h5 class="text-white font-bold mb-4 text-lg">🛒 ShopSphere</h5>
                    <p class="text-sm leading-relaxed">Your trusted e-commerce destination for quality products at unbeatable prices.</p>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">🔗 Quick Links</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">All Products</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">💬 Support</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Returns</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Track Order</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">⚖️ Legal</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cookie Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">📱 Follow Us</h5>
                    <div class="flex gap-4">
                        <a href="#" class="text-2xl hover:text-indigo-400 transition-colors">f</a>
                        <a href="#" class="text-2xl hover:text-indigo-400 transition-colors">𝕏</a>
                        <a href="#" class="text-2xl hover:text-indigo-400 transition-colors">📷</a>
                        <a href="#" class="text-2xl hover:text-indigo-400 transition-colors">▶️</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-center md:text-left text-sm">&copy; 2026 ShopSphere. All rights reserved. | Built with ❤️</p>
                <div class="flex gap-6 mt-6 md:mt-0 text-sm">
                    <span class="flex items-center gap-2">🔒 Secure Checkout</span>
                    <span class="flex items-center gap-2">📦 Free Shipping on Orders</span>
                    <span class="flex items-center gap-2">💳 Multiple Payment Options</span>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
