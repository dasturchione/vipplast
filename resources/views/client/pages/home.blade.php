@extends('client.layouts.app')
@php
    $interval = 5000;
@endphp

@section('content')
    @isset($banners)
        <section class="bg-gray-100 text-center">
            <div x-data="heroSlider({{ json_encode($banners) }}, {{ $interval }})" x-init="init()"
                class="relative w-full h-[400px] sm:h-[500px] md:h-[600px] lg:h-[700px] xl:h-[900px] overflow-hidden">

                <!-- Slider image -->
                <template x-if="slides[currentSlide]">
                    <div class="absolute inset-0 transition-opacity duration-1000" :key="currentSlide">
                        <div class="w-full h-full bg-cover bg-center bg-no-repeat scale-110"
                            :class="slides[currentSlide].animation"
                            :style="`background-image: url(${slides[currentSlide].image_url})`">
                        </div>
                    </div>
                </template>

                <!-- Overlay text -->
                <div class="absolute inset-0 flex items-center bg-black/30 px-4 sm:px-6 md:px-8 lg:px-12 xl:px-30"
                    :class="`pos-${slides[currentSlide].position}`">
                    <div
                        class="text-white w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl space-y-3 sm:space-y-4 md:space-y-5 relative">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="currentSlide === index" class="w-full text-start">
                                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-[60px] font-bold leading-tight"
                                    :class="slide.titleAnimation" x-text="slide.title[locale]"></h1>
                                <p class="text-sm sm:text-base md:text-lg lg:text-xl xl:text-[18px] mt-2 leading-relaxed"
                                    :class="slide.subtitleAnimation" x-text="slide.subtitle[locale]"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Nuqtachalar -->
                <div class="absolute bottom-4 sm:bottom-6 md:bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="goToSlide(index)" class="w-2 h-2 sm:w-3 sm:h-3 rounded-full transition-all duration-300"
                            :class="currentSlide === index ? 'bg-[#ffaa00]' : 'bg-white/50 hover:bg-white/75'">
                        </button>
                    </template>
                </div>

                <!-- Chap o‘q -->
                <button @click="previousSlide()"
                    class="hidden md:flex absolute left-4 lg:left-8 top-1/2 transform -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-2 lg:p-3 rounded-full transition-all duration-300 items-center justify-center">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- O‘ng o‘q -->
                <button @click="nextSlide()"
                    class="hidden md:flex absolute right-4 lg:right-8 top-1/2 transform -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-2 lg:p-3 rounded-full transition-all duration-300 items-center justify-center">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </section>
    @endisset
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">{{ __('lang.categories') }}</h2>
                <div class="flex gap-2">
                    <button class="categories-prev hover:cursor-pointer bg-gray-200 hover:bg-gray-300 p-2 rounded-full">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="categories-next hover:cursor-pointer bg-gray-200 hover:bg-gray-300 p-2 rounded-full">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="swiper swiper-categories">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <x-category-card :category="$category" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Video blog</h2>
                <div class="flex gap-2">
                    <button class="shorts-prev hover:cursor-pointer bg-gray-200 hover:bg-gray-300 p-2 rounded-full">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="shorts-next hover:cursor-pointer bg-gray-200 hover:bg-gray-300 p-2 rounded-full">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="swiper swiper-shorts">
                <div class="swiper-wrapper">
                    @foreach ($shorts as $short)
                        <div class="swiper-slide">
                            <div class="aspect-[9/16] rounded-xl overflow-hidden shadow-md">
                                <div class="youtube-placeholder relative w-full h-full cursor-pointer"
                                    data-id="{{ $short->youtube_id }}">
                                    <img class="absolute inset-0 w-full h-full object-cover"
                                        src="https://img.youtube.com/vi/{{ $short->youtube_id }}/hqdefault.jpg"
                                        alt="{{ $short->title }}" />
                                    <div class="absolute inset-0 bg-black/30 z-10"></div>
                                    <div class="absolute inset-0 z-20 flex items-center justify-center">
                                        <button class="text-white text-4xl hover:scale-110 transition">▶</button>
                                    </div>

                                    <template class="youtube-thumbnail-template">
                                        <img class="absolute inset-0 w-full h-full object-cover"
                                            src="https://img.youtube.com/vi/{{ $short->youtube_id }}/hqdefault.jpg"
                                            alt="{{ $short->title }}" />
                                        <div class="absolute inset-0 bg-black/30 z-10"></div>
                                        <div class="absolute inset-0 z-20 flex items-center justify-center">
                                            <button class="text-white text-4xl hover:scale-110 transition">▶</button>
                                        </div>
                                    </template>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </section>
    <x-experience-section />
@endsection
@push('scripts')
    <script src="{{ asset('/assets/js/swiper-bundle.min.js') }}"></script>
    <script>
        let page = 1;
        let isLoading = false;

        const swiper = new Swiper(".swiper-categories", {
            slidesPerView: 2,
            spaceBetween: 20,
            navigation: {
                nextEl: ".categories-next",
                prevEl: ".categories-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
                1280: {
                    slidesPerView: 6,
                }
            },
            on: {
                reachEnd: function() {
                    if (isLoading) return;
                    isLoading = true;
                    page++;

                    fetch(`?page=${page}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            const temp = document.createElement('div');
                            temp.innerHTML = html;

                            temp.querySelectorAll('.swiper-slide').forEach(slide => {
                                swiper.appendSlide(slide.outerHTML);
                            });

                            isLoading = false;
                        })
                        .catch(err => {
                            console.error(err);
                            isLoading = false;
                        });
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.swiper-shorts', {
                slidesPerView: 1,
                spaceBetween: 16,
                navigation: {
                    nextEl: '.shorts-next',
                    prevEl: '.shorts-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2.2
                    },
                    768: {
                        slidesPerView: 3.2
                    },
                    1024: {
                        slidesPerView: 4.2
                    },
                },
                loop: false,
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.youtube-placeholder').forEach(el => {
                el.addEventListener('click', () => loadYoutubeIframe(el));
            });
        });;

        function stopAllVideos() {
            document.querySelectorAll('.youtube-placeholder.playing').forEach(el => {
                const template = el.querySelector('.youtube-thumbnail-template');
                if (template) {
                    el.innerHTML = template.innerHTML;
                    el.classList.remove('playing');
                }
            });
        }

        function loadYoutubeIframe(container) {
            // Avval boshqa videolarni to‘xtatamiz
            stopAllVideos();

            // Endi hozirgi video uchun iframe yaratamiz
            const videoId = container.dataset.id;

            const iframe = document.createElement('iframe');
            iframe.setAttribute('src', `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=0&modestbranding=1&rel=0`);
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allowfullscreen', '');
            iframe.setAttribute('allow',
                'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.className = 'w-full h-full rounded-xl';

            container.innerHTML = '';
            container.appendChild(iframe);
            container.classList.add('playing');
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.youtube-placeholder').forEach(el => {
                el.addEventListener('click', () => loadYoutubeIframe(el));
            });
        });
    </script>
@endpush
@push('structured-data')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org/",
            "@@type": "Organization",
            "address": {
                "@@type": "PostalAddress",
                "addressLocality": "Tashkent, Uzbekistan",
                "postalCode": "F-75002",
                "streetAddress": {{ $company['address'][$lang] }},
            },
            "email": "{{ $company['email'] }}",
            "name" : "{{ $company['meta_title'][$lang] }}",
            "telephone": "{{ $company['phone'] }}",
            "url" : "{{ url()->current() }}",
            "logo" : "{{ $company['logo'] }}",
        }
    </script>
@endpush
