@extends('client.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="bg-white rounded-2xl shadow-xl p-8 contact-card">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('lang.get_in_touch') }}</h2>
                    <p class="text-gray-600">{{ __('lang.contact_description') }}</p>
                </div>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-3"></i>
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="text-red-800">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <input type="text" name="username" value="{{ old('username') }}"
                                placeholder="{{ __('lang.name') }}" required
                                class="form-input w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-gray-50" />
                        </div>

                        <div>
                            <input type="phone" name="phone" value="{{ old('phone') }}"
                                placeholder="{{ __('lang.phone') }} (+998123456789)" required
                                pattern="^\+998\d{9}$"
                                class="form-input w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-gray-50" />
                        </div>
                    </div>

                    <div>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                            placeholder="{{ __('lang.subject') }}" required max="255"
                            class="form-input w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-gray-50" />
                    </div>

                    <div>
                        <textarea name="message" placeholder="{{ __('lang.message') }}" required rows="6"
                        maxlength="1000"
                            class="form-input w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 resize-none bg-gray-50">{{ old('message') }}</textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                            class="btn-primary text-white py-4 px-8 rounded-lg font-semibold hover:shadow-lg transform transition-all duration-300">
                            {{ __('lang.send_now') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-xl p-8 contact-card">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('lang.contact_info') }}</h2>
                    <p class="text-gray-600 mb-8">{{ __('lang.contact_description') }}</p>

                    <div class="space-y-8">
                        <!-- Phone -->
                        <div class="flex items-start">
                            <div class="bg-orange-100 p-4 rounded-full mr-6 flex-shrink-0">
                                <i class="fas fa-phone text-orange-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ phone_format($company['phone']) }}</h3>
                                <p class="text-gray-600">{{ __('lang.working_time') }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start">
                            <div class="bg-orange-100 p-4 rounded-full mr-6 flex-shrink-0">
                                <i class="fas fa-envelope text-orange-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $company['email'] }}</h3>
                                <p class="text-gray-600">{{ __('lang.reply_within') }}</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start">
                            <div class="bg-orange-100 p-4 rounded-full mr-6 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-orange-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">
                                    {{ trim($company['address'][$lang]) }}</h3>
                                <p class="text-gray-600">O'zbekiston</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex space-x-4">
                            <a href="{{ $company['social']['facebook'] }}"
                                class="bg-gray-100 hover:bg-blue-500 hover:text-white p-3 rounded-full transition-all duration-300">
                                <i class="fab fa-facebook-f text-lg"></i>
                            </a>
                            <a href="{{ $company['social']['telegram'] }}"
                                class="bg-gray-100 hover:bg-blue-400 hover:text-white p-3 rounded-full transition-all duration-300">
                                <i class="fab fa-telegram text-lg"></i>
                            </a>
                            <a href="{{ $company['social']['instagram'] }}"
                                class="bg-gray-100 hover:bg-blue-600 hover:text-white p-3 rounded-full transition-all duration-300">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                            <a href="#"
                                class="bg-gray-100 hover:bg-red-500 hover:text-white p-3 rounded-full transition-all duration-300">
                                <i class="fab fa-pinterest text-lg"></i>
                            </a>
                            <a href="#"
                                class="bg-gray-100 hover:bg-purple-500 hover:text-white p-3 rounded-full transition-all duration-300">
                                <i class="fab fa-dribbble text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('structured-data')
        <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Organization",
  "name": "Vipplast",
  "url": "{{ url('/contact') }}",
  "logo": "{{ asset('images/logo.png') }}",
  "contactPoint": [{
    "@@type": "ContactPoint",
    "telephone": "{{ phone_format($company['phone']) }}",
    "contactType": "customer service",
    "areaServed": "UZ",
    "availableLanguage": ["Uzbek", "Russian"]
  }],
  "sameAs": [
    "{{ $company['social']['facebook'] }}",
    "{{ $company['social']['instagram'] }}",
    "{{ $company['social']['telegram'] }}"
  ]
}
</script>
    @endpush
