@extends('client.layouts.app')

@section('content')
    <div class="max-w-[1300px] mx-auto p-4">
        @if ($type === 'category')
            <section class="py-10 bg-white">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold">{{ __('lang.categories') }}</h2>
                        <div class="flex gap-2">
                            <button
                                class="categories-prev hover:cursor-pointer bg-gray-200 hover:bg-gray-300 p-2 rounded-full">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button
                                class="categories-next hover:cursor-pointer bg-gray-200 hover:bg-gray-300 p-2 rounded-full">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="swiper swiper-categories">
                        <div class="swiper-wrapper">
                            @foreach ($subcategories as $category)
                                <x-category-card :category="$category" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section>
            <div>
                @if ($products->count())
                    <div x-data="{
                        page: 2,
                        loading: false,
                        finished: false,

                        async loadMore() {
                            if (this.loading || this.finished) return;
                            this.loading = true;

                            try {
                                const res = await fetch(`{{ request()->url() }}?page=${this.page}`, {
                                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                                });
                                const html = await res.text();

                                if (html.trim() === '') {
                                    this.finished = true;
                                    return;
                                }

                                document.querySelector('#product-list').insertAdjacentHTML('beforeend', html);
                                this.page++;
                            } finally {
                                this.loading = false;
                            }
                        }
                    }" x-init="window.addEventListener('scroll', () => {
                        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
                            loadMore();
                        }
                    })">
                        <div id="product-list">
                            @include('client.partials.product-grid', ['products' => $products])
                        </div>


                        <div x-show="loading" x-transition.opacity class="flex justify-center items-center mt-8 space-x-3">
                            <svg class="animate-spin h-6 w-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4" />
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                            </svg>

                            <span
                                class="text-sm font-medium text-gray-600 animate-pulse bg-gradient-to-r from-indigo-500 to-pink-500 bg-clip-text text-transparent">
                                {{ __('lang.loading') }}
                            </span>
                        </div>

                    </div>
                @else
                    <div
                        class="py-20 flex flex-col md:flex-row items-center justify-center gap-x-8 bg-gradient-to-br from-white via-gray-50 to-white rounded-3xl shadow-inner px-4 text-center md:text-left">
                        <div class="w-60 h-60 flex justify-center items-center">
                            <dotlottie-wc src="https://lottie.host/39d99f96-3f27-4721-9d80-8e317a0686b9/Q8kYy3Plch.lottie"
                                style="width: 250px; height: 250px;" speed="1" autoplay loop>
                            </dotlottie-wc>
                        </div>
                        <div class="max-w-md">
                            <h2 class="text-5xl font-bold text-gray-800 mb-2">404</h2>
                            <p class="text-lg text-gray-600 font-medium">
                                Afsuski, bu yerda hozircha hech narsa topilmadi.
                            </p>
                            <p class="mt-2 text-sm text-gray-400">
                                Balki boshqa sahifalarda siz izlayotgan narsa bor bo‘lishi mumkin 🤍
                            </p>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    </section>
@endsection
@push('structured-data')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ItemList",
  "name": "{{ __('lang.products') }}",
  "itemListElement": [
    @foreach($products as $product)
      {
        "@@type": "Product",
        "position": {{ $loop->index + 1 }},
        "url": "{{ route('products', $product->id) }}",
        "name": "{{ $product->{'name_'.$lang} }}",
        "image": "{{ asset('storage/' . $product->image) }}",
        "description": "{{ Str::limit(strip_tags($product->{'description_'.$lang}), 150) }}"
      }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endpush
@push('scripts')
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.6.2/dist/dotlottie-wc.js" type="module"></script>

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
    </script>
@endpush
