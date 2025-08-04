@props(['product'])
@php
    $imageUrl = asset('storage/' . $product->image);
    $fallbackUrl = 'https://i.ebayimg.com/images/g/GgcAAOSwaT5nYweA/s-l1600.jpg'; // zaxira rasm (public/images ichida bo‘lishi kerak)

    $options = explode("\n", $product->options_uz); // qatorlarga bo‘linadi
@endphp
<div
    class="w-72 bg-white rounded-2xl shadow-md p-4 relative group border border-transparent hover:border-primary/30 hover:shadow-lg transition overflow-hidden">
    <!-- Hot Badge -->
    <div class="absolute top-0 left-0 bg-pink-500 text-white text-xs px-3 py-1 rounded-br-lg font-semibold z-10">
        Hot
    </div>

    <!-- Image + Hover Icons -->
    <div class="relative w-full h-56 flex items-center justify-center">
        <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full">
            <div x-data="{
                loaded: false,
                failed: false
            }" x-init="const img = $el.querySelector('img');
            if (img.complete && img.naturalWidth > 0) {
                loaded = true;
            } else {
                img.addEventListener('load', () => loaded = true);
                img.addEventListener('error', () => {
                    failed = true;
                    loaded = true
                });
            }"
                class="w-full h-full flex items-center justify-center relative">
                <!-- Spinner -->
                <div x-show="!loaded" class="absolute inset-0 flex items-center justify-center bg-white/70 z-10">
                    <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 000 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z" />
                    </svg>
                </div>

                <!-- Image -->
                <img x-bind:src="failed ? '{{ $fallbackUrl }}' : '{{ $imageUrl }}'"
                    x-bind:class="{
                        'opacity-0': !loaded,
                        'opacity-100': loaded
                    }"
                    alt="{{ $product->{'name_' . $lang} }}"
                    class="transition-all group-hover:scale-105 group-hover:rotate-[3deg] duration-700 ease-in-out max-h-full object-contain w-full h-full"
                    loading="lazy" />
            </div>
        </a>

    </div>



    <!-- Product Info -->
    <div class="mt-4">
        <p class="text-xs text-gray-500">{{ optional($product->category)->{'name_' . $lang} }}</p>

        <a href="{{ route('product.show', $product->slug) }}">
            <h3 class="text-base font-semibold text-gray-800">{{ $product->{'name_' . $lang} }}</h3>
        </a>

        <p class="text-sm text-gray-500 mt-1 line-clamp-3">{{ $product->{'description_' . $lang} }}</p>

        <div class="mt-3 flex items-center justify-between">
            <div x-data="{
                messages: @js($options),
                currentIndex: 0,
                transitioning: false,
                get currentMessage() {
                    return this.messages[this.currentIndex];
                },
                init() {
                    this.loop();
                },
                loop() {
                    setInterval(() => {
                        this.transitioning = true;
                        setTimeout(() => {
                            this.currentIndex = (this.currentIndex + 1) % this.messages.length;
                            this.transitioning = false;
                        }, 1000); // 500ms = animatsiya davomiyligi
                    }, 3000);
                }
            }"
                class="mt-4 relative h-7 w-47 overflow-hidden text-sm text-gray-800 font-medium">

                <div :key="currentMessage" >
                    <div  x-text="currentMessage"
                    x-bind:class="transitioning
                        ?
                        'a-slide-up-out' :
                        'a-slide-up-in'"
                    class="absolute w-auto shadow-sm px-2 bg-green-50 rounded-md">
                </div>
                </div>

            </div>
            <a href="#"
                class="flex items-center justify-center h-10 w-10 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition duration-200">
                <i class="fa-solid fa-cart-shopping text-base"></i>
            </a>

        </div>

    </div>
</div>
