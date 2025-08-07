@extends('client.layouts.app')

@section('content')
    <section class="relative py-16 bg-gradient-to-b from-white to-gray-100">
        <div class="max-w-7xl mx-auto pt-4">

            <div id="flipbook" class="relative w-full mx-auto rounded-lg shadow-xl overflow-hidden border border-gray-200"></div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>
    <style>
        #flipbook {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }
    </style>
    <script>
        const images = [
            @foreach ($catalog as $item)
                "{{ asset('storage/' . $item->image) }}",
            @endforeach
        ];

        const flipbook = new St.PageFlip(document.getElementById("flipbook"), {
            width: 827,
            height: 1170,
            size: "stretch",
            minWidth: 320,
            maxWidth: 1655,
            minHeight: 400,
            maxHeight: 2340,
            maxShadowOpacity: 0.5,
            showCover: true,
            mobileScrollSupport: true
        });

        flipbook.loadFromImages(images);

        window.addEventListener("resize", () => {
            flipbook.update();
        });
    </script>
@endpush
