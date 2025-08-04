@livewireScripts
<footer class="bg-gray-900 text-white py-10">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 px-4">
        <div>
            <h3 class="text-xl font-semibold mb-4">VIP Plast</h3>
            <p class="text-sm text-gray-300">Yetakchi plastik mahsulot yetkazib beruvchi kompaniya.</p>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-4">{{ __('lang.sitemap') }}</h4>
            <ul class="space-y-2 text-sm text-gray-300 list-[circle]">
                <li><a href="#" class="hover:text-white">{{ __('lang.catalog') }}</a></li>
                <li><a href="#" class="hover:text-white">Hamkorlik</a></li>
                <li><a href="#" class="hover:text-white">{{ __('lang.contact') }}</a></li>
                <li><a href="#" class="hover:text-white">{{ __('lang.faq') }}</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-4">{{ __('lang.contact') }}</h4>
            <div class="space-y-2">
                <p class="text-sm text-gray-300"><a href="tel:{{ $company['phone'] }}">📞
                        {{ phone_format($company['phone']) }}</a></p>
                <p class="text-sm text-gray-300"><a href="mailto:{{ $company['email'] }}"><i class="fa fa-email"></i>
                        {{ $company['email'] }}</p>
            </div>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-4">Joylashuv</h4>
            <div class="rounded-lg overflow-hidden shadow-lg border border-gray-700">
                <iframe
                    src="{{ $company['map']['link'] }}"
                    width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
    <div class="text-center text-sm text-gray-500 mt-6">
        &copy; {{ now()->year }} VIP Plast. Barcha huquqlar himoyalangan.
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.7/countUp.min.js"></script>

<script>
    window.appLocale = "{{ $lang }}";
</script>

@stack('scripts')
