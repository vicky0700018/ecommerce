<div class="bg-white shadow-sm border-b border-gray-200 sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-4 overflow-x-auto no-scrollbar gap-8">
            <!-- All -->
            <a href="{{ route('products.index') }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">All</span>
            </a>

            <!-- Fashion -->
            <a href="{{ route('products.index', ['category' => 'fashion']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Fashion</span>
            </a>

            <!-- Mobile -->
             <a href="{{ route('products.index', ['category' => 'mobile']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Mobile</span>
            </a>

            <!-- Beauty -->
            <a href="{{ route('products.index', ['category' => 'beauty']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Beauty</span>
            </a>

            <!-- Electronics -->
            <a href="{{ route('products.index', ['category' => 'electronics']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Electronics</span>
            </a>

            <!-- Home -->
            <a href="{{ route('products.index', ['category' => 'home']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Home</span>
            </a>

            <!-- Appliances -->
             <a href="{{ route('products.index', ['category' => 'appliances']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Appliances</span>
            </a>

            <!-- Toys -->
            <a href="{{ route('products.index', ['category' => 'toys']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H4.5a1.5 1.5 0 01-1.5-1.5v-8.25M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3-6a7.5 7.5 0 00-7.5 7.5h15A7.5 7.5 0 0012 6z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Toys</span>
            </a>

            <!-- Baby -->
            <a href="{{ route('products.index', ['category' => 'baby']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Baby</span>
            </a>

            <!-- Furniture -->
             <a href="{{ route('products.index', ['category' => 'furniture']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Furniture</span>
            </a>

            <!-- Sports -->
            <a href="{{ route('products.index', ['category' => 'sports']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 01-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 01-1.458-1.137l1.411-2.353a2.25 2.25 0 00.286-.76m11.928 9.869A9 9 0 008.965 3.525m11.928 9.869A9 9 0 018.965 3.525" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Sports</span>
            </a>

            <!-- Books -->
            <a href="{{ route('products.index', ['category' => 'books']) }}" class="flex flex-col items-center gap-2 min-w-[64px] group cursor-pointer hover:text-indigo-600 transition">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-indigo-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">Books</span>
            </a>
        </div>
    </div>
</div>

<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
