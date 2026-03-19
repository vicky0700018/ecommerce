@props(['product', 'heightClass' => 'h-56'])

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
@endphp

@if(count($images) > 1)
    <div class="relative w-full {{ $heightClass }} overflow-hidden group" x-data="productSlider({{ count($images) }})">
        <!-- Images -->
        <div class="flex transition-transform duration-500 ease-in-out h-full w-full" 
             :style="`transform: translateX(-${currentIndex * 100}%)`">
            @foreach($images as $img)
                <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full h-full object-cover flex-shrink-0">
            @endforeach
        </div>

        <!-- Buttons (visible on hover) -->
        <button @click.prevent="prev()" class="absolute top-1/2 left-2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-1.5 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition focus:outline-none z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
        </button>
        <button @click.prevent="next()" class="absolute top-1/2 right-2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-1.5 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition focus:outline-none z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        </button>
        
        <!-- Dots -->
        <div class="absolute bottom-2 left-0 right-0 flex justify-center gap-1.5 z-10">
            @foreach($images as $index => $img)
                <div class="w-2 h-2 rounded-full transition-colors duration-300" 
                     :class="currentIndex === {{ $index }} ? 'bg-indigo-600 scale-110' : 'bg-white/60 hover:bg-white/80'"
                     @click.prevent="goTo({{ $index }})"></div>
            @endforeach
        </div>
    </div>
@elseif(count($images) == 1)
    <img src="{{ $images[0] }}" alt="{{ $product->name }}" class="w-full {{ $heightClass }} object-cover">
@else
    <div class="w-full {{ $heightClass }} bg-gray-200 flex flex-col items-center justify-center">
        <span class="text-4xl mb-2 text-gray-400">📦</span>
        <span class="text-gray-500 font-medium font-sm">No Image</span>
    </div>
@endif

@once
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productSlider', (totalSlides) => ({
            currentIndex: 0,
            interval: null,
            total: totalSlides,
            init() {
                this.startAutoSlide();
                // Pause on hover
                this.$el.addEventListener('mouseenter', () => this.stopAutoSlide());
                this.$el.addEventListener('mouseleave', () => this.startAutoSlide());
            },
            startAutoSlide() {
                this.stopAutoSlide();
                this.interval = setInterval(() => {
                    this.next();
                }, 3000);
            },
            stopAutoSlide() {
                if(this.interval) clearInterval(this.interval);
            },
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.total;
            },
            prev() {
                this.currentIndex = this.currentIndex === 0 ? this.total - 1 : this.currentIndex - 1;
            },
            goTo(index) {
                this.currentIndex = index;
            }
        }));
    });
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
@endonce
