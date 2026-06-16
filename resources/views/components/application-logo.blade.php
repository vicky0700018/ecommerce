@props(['showText' => false, 'textSize' => 'text-3xl', 'textColor' => 'text-transparent bg-clip-text bg-gradient-to-r from-purple-700 to-indigo-600'])

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <svg class="w-auto h-full drop-shadow-xl" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="sphereGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#c026d3" />
                <stop offset="50%" stop-color="#7c3aed" />
                <stop offset="100%" stop-color="#4f46e5" />
            </linearGradient>
            <linearGradient id="bagGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#facc15" />
                <stop offset="100%" stop-color="#f59e0b" />
            </linearGradient>
        </defs>
        <!-- Sphere background -->
        <circle cx="50" cy="50" r="45" fill="url(#sphereGrad)" />
        <!-- Shopping Bag outline/shape inside sphere -->
        <path d="M35 40h30v30c0 5.5-4.5 10-10 10H45c-5.5 0-10-4.5-10-10V40z" fill="white" opacity="0.95" />
        <path d="M40 40v-8c0-5.5 4.5-10 10-10s10 4.5 10 10v8" stroke="white" stroke-width="6" stroke-linecap="round" />
        <!-- Sparkles -->
        <circle cx="70" cy="30" r="5" fill="url(#bagGrad)" />
        <circle cx="25" cy="65" r="3" fill="url(#bagGrad)" />
    </svg>
    @if($showText)
        <span class="{{ $textSize }} font-black tracking-tight {{ $textColor }} drop-shadow-sm">ShopSphere</span>
    @endif
</div>
