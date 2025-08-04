@extends('client.layouts.app')

@section('title', $product->{'name_' . $lang})
@section('description', $product->{'description_' . $lang})
@section('keywords', $product->{'name_' . $lang} . ', ' . $product->{'keywords_' . $lang})
@section('image', asset('storage/' . $product->image))

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid md:grid-cols-2 gap-10 items-start">
            <div class="relative overflow-hidden rounded-2xl shadow-lg">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->{'name_' . $lang} }}"
                    class="w-full object-cover transition hover:scale-105 duration-300 ease-in-out">
            </div>


            {{-- Product Info --}}
            <div class="space-y-6">
                <h1 class="text-3xl font-bold text-gray-900">{{ $product->{'name_' . $lang} }}</h1>

                <p class="text-xl text-indigo-600 font-semibold">
                    {{ number_format($product->price, 0, '.', ' ') }} so‘m
                </p>

                <div class="prose max-w-none text-gray-700">
                    {!! $product->{'description_' . $lang} !!}
                </div>

                <form method="POST" action="{{ route('products', $product->id) }}">
                    @csrf
                    <button type="submit"
                        class="mt-6 bg-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:bg-indigo-700 transition">
                        🛒 Savatga qo‘shish
                    </button>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-10">
            <div x-data="{ tab: 'description' }" class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex space-x-4 border-b border-gray-200 pb-2">
                    <button @click="tab = 'description'"
                        :class="tab === 'description' ? 'text-primary border-b-2 border-primary' : 'text-gray-600'"
                        class="pb-2 font-semibold text-lg">Izoh</button>
                    <button @click="tab = 'specs'"
                        :class="tab === 'specs' ? 'text-primary border-b-2 border-primary' : 'text-gray-600'"
                        class="pb-2 font-semibold text-lg">Texnik xususiyatlar</button>
                    {{-- <button @click="tab = 'options'"
                        :class="tab === 'options' ? 'text-primary border-b-2 border-primary' : 'text-gray-600'"
                        class="pb-2 font-semibold text-lg">Variantlar</button> --}}
                </div>

                <div class="mt-6">
                    {{-- Description --}}
                    <div x-show="tab === 'description'" x-transition>
                        <h3 class="text-xl font-bold mb-2">Mahsulot tavsifi</h3>
                        <p class="text-gray-700 leading-relaxed">{!! nl2br(e($product->{'description_' . $lang})) !!}</p>
                    </div>

                    {{-- Specifications --}}
                    <div x-show="tab === 'specs'" x-transition class="space-y-2">
                        <h3 class="text-xl font-bold mb-2">Texnik xususiyatlar</h3>
                        <span>{!! nl2br(e($product->{'options_' . $lang})) !!}</span>
                    </div>

                    {{-- Options --}}
                    <div x-show="tab === 'options'" x-transition class="space-y-2">
                        <h3 class="text-xl font-bold mb-2">Mavjud variantlar</h3>
                        <ul class="text-gray-700 list-disc list-inside">
                            @forelse ($product->options ?? [] as $option)
                                <li>{{ $option->name }} - {{ $option->value }}</li>
                            @empty
                                <li>Variantlar mavjud emas</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('structured-data')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Product",
        "name": "{{ $product->{'name_'.$lang} }}",
        "image": "{{ asset('storage/'.$product->image) }}",
        "description": "{{ $product->{'description_'.$lang} }}",
        "brand": {
            "@@type": "Brand",
            "name": "{{ $company['meta_title'][$lang] }}"
        }
    }
</script>
@endpush
