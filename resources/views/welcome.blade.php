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
                <a href="#" class="flex items-center hover:scale-105 transition-transform duration-300">
                    <x-application-logo class="h-10 w-auto" :showText="true" />
                </a>

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

    <!-- Flash Sale / Limited Offers Section (Auto Slider) -->
    <section class="bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 py-12 text-white overflow-hidden relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            
            <div class="overflow-hidden rounded-xl">
                <div class="flex transition-transform duration-700 ease-in-out" id="offer-slider">
                    <!-- Offer 1 -->
                    <div class="w-full flex-shrink-0 px-2">
                        <div class="bg-black/30 backdrop-blur-md rounded-xl p-8 border border-white/20 hover:scale-105 transition-transform duration-300 shadow-2xl">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-sm font-semibold opacity-90 tracking-wider">⚡ FLASH SALE</p>
                                    <h3 class="text-3xl font-bold mt-2">Mega Clearance</h3>
                                </div>
                                <span class="bg-white text-red-600 px-4 py-2 rounded-full font-black text-lg shadow-lg">-50%</span>
                            </div>
                            <p class="mb-6 opacity-90 text-lg">On selected items across the store</p>
                            <div class="bg-black/50 rounded-lg p-4 text-center">
                                <p class="text-sm opacity-75 mb-1 tracking-widest uppercase">Ends in</p>
                                <p class="text-4xl font-mono font-bold tracking-wider">03:45:22</p>
                            </div>
                        </div>
                    </div>

                    <!-- Offer 2 -->
                    <div class="w-full flex-shrink-0 px-2">
                        <div class="bg-black/30 backdrop-blur-md rounded-xl p-8 border border-white/20 hover:scale-105 transition-transform duration-300 shadow-2xl">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-sm font-semibold opacity-90 tracking-wider">🎁 BUNDLE DEAL</p>
                                    <h3 class="text-3xl font-bold mt-2">Buy More Save More</h3>
                                </div>
                                <span class="bg-white text-orange-600 px-4 py-2 rounded-full font-black text-lg shadow-lg">-35%</span>
                            </div>
                            <p class="mb-6 opacity-90 text-lg">On all combo packs and bulk purchases</p>
                            <div class="bg-black/50 rounded-lg p-4 text-center">
                                <p class="text-sm opacity-75 mb-1 tracking-widest uppercase">Ends in</p>
                                <p class="text-4xl font-mono font-bold tracking-wider">05:22:15</p>
                            </div>
                        </div>
                    </div>

                    <!-- Offer 3 -->
                    <div class="w-full flex-shrink-0 px-2">
                        <div class="bg-black/30 backdrop-blur-md rounded-xl p-8 border border-white/20 hover:scale-105 transition-transform duration-300 shadow-2xl">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-sm font-semibold opacity-90 tracking-wider">💳 MEMBER EXCLUSIVE</p>
                                    <h3 class="text-3xl font-bold mt-2">Extra Discount</h3>
                                </div>
                                <span class="bg-white text-yellow-600 px-4 py-2 rounded-full font-black text-lg shadow-lg">-25%</span>
                            </div>
                            <p class="mb-6 opacity-90 text-lg">For registered members only</p>
                            <div class="bg-black/50 rounded-lg p-4 text-center">
                                <p class="text-sm opacity-75 mb-1 tracking-widest uppercase">Ends in</p>
                                <p class="text-4xl font-mono font-bold tracking-wider">08:10:45</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Indicators -->
            <div class="flex justify-center mt-8 gap-3" id="offer-indicators">
                <button class="w-4 h-4 rounded-full bg-white shadow-lg transition-all duration-300 hover:scale-125" data-slide="0"></button>
                <button class="w-4 h-4 rounded-full bg-white/40 shadow-lg transition-all duration-300 hover:scale-125" data-slide="1"></button>
                <button class="w-4 h-4 rounded-full bg-white/40 shadow-lg transition-all duration-300 hover:scale-125" data-slide="2"></button>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const slider = document.getElementById('offer-slider');
                const indicators = document.querySelectorAll('#offer-indicators button');
                let currentSlide = 0;
                const totalSlides = 3;

                function goToSlide(index) {
                    currentSlide = index;
                    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
                    indicators.forEach((ind, i) => {
                        if (i === currentSlide) {
                            ind.classList.remove('bg-white/40');
                            ind.classList.add('bg-white');
                            ind.classList.add('scale-110');
                        } else {
                            ind.classList.remove('bg-white');
                            ind.classList.remove('scale-110');
                            ind.classList.add('bg-white/40');
                        }
                    });
                }

                let slideInterval = setInterval(() => {
                    goToSlide((currentSlide + 1) % totalSlides);
                }, 3500); // 3.5 seconds interval

                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        clearInterval(slideInterval);
                        goToSlide(index);
                        slideInterval = setInterval(() => {
                            goToSlide((currentSlide + 1) % totalSlides);
                        }, 3500);
                    });
                });
            });
        </script>
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
                            
                            @unless(auth()->check() && auth()->user()->isAdmin())
                            <div class="mt-auto">
                                @auth
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
                    <x-application-logo class="h-8 w-auto mb-4" :showText="true" textColor="text-white" textSize="text-xl" />
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
                <p class="text-center md:text-left text-sm">&copy; 2026 ShopSphere. All rights reserved. | Made by Vicky ❤️</p>
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
