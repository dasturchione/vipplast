@props(['category'])

@php
    $imageUrl = asset('storage/' . $category->image);
    $fallbackUrl = "https://i.ebayimg.com/images/g/GgcAAOSwaT5nYweA/s-l1600.jpg"; // zaxira rasm (public/images ichida bo‘lishi kerak)
@endphp

<div class="swiper-slide w-[240px] sm:w-[280px] md:w-[300px] lg:w-[320px]">
    <a href="{{ route('products', isset($category->parent) ? [$category->parent->slug, $category->slug] : [$category->slug]) }}"
        class="block rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group relative">

        {{-- IMAGE --}}
        <div
            x-data="{
                loaded: false,
                failed: false
            }"
            x-init="
                const img = $el.querySelector('img');
                if (img.complete && img.naturalWidth > 0) {
                    loaded = true;
                } else {
                    img.addEventListener('load', () => loaded = true);
                    img.addEventListener('error', () => { failed = true; loaded = true });
                }
            "
            class="relative w-full h-64 bg-gray-200 overflow-hidden"
        >
            <!-- Spinner -->
            <div
                x-show="!loaded"
                x-transition.opacity
                class="absolute inset-0 flex items-center justify-center bg-white/70 z-10"
            >
                <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 000 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z" />
                </svg>
            </div>

            <!-- Image yoki Fallback -->
            <img
                x-bind:src="failed ? '{{ $fallbackUrl }}' : '{{ $imageUrl }}'"
                alt="{{ $category->{'name_' . $lang} }}"
                loading="lazy"
                x-bind:class="{
                    'opacity-0': !loaded,
                    'opacity-100': loaded
                }"
                class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105 group-hover:rotate-[3deg] transition-opacity duration-700 ease-in-out"
            />
        </div>

        {{-- TITLE --}}
        <div
            class="m-2 absolute bottom-0 left-0 right-0 p-4 bg-white/60 backdrop-blur-sm text-gray-800 rounded-3xl flex justify-center items-center">
            <h3 class="text-sm font-semibold leading-snug z-10">
                {{ $category->{'name_' . $lang} }}
            </h3>
        </div>
    </a>
</div>
