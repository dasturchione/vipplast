<header x-data="{ openMenu: false, scrollY: 0 }" x-init="window.addEventListener('scroll', () => scrollY = window.scrollY)" class="w-full z-50">
    <!-- Header Top -->
    <div class="bg-[#444444] text-[14px] py-2 hidden lg:block">
        <div class="container max-w-[1300px] mx-auto flex justify-between text-white px-4">
            <div>
                <ul class="flex space-x-6 py-2 text-xs lg:text-sm">
                    <li class="hidden xl:block">Turning big ideas into great products</li>
                    <li class="flex items-center space-x-2">
                        <i class="fa-solid fa-earth-americas" style="color: #ffaa00"></i>
                        <p class="truncate max-w-[200px]">{{ $company['address'][$lang] }}</p>
                    </li>
                    <li>
                        <a href="tel:{{ $company['phone'] }}" class="flex items-center space-x-2">
                            <i class="fa-solid fa-phone-volume" style="color: #ffaa00"></i>
                            <span>{{ phone_format($company['phone']) }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Language Switcher -->
                <div x-data="{ langOpen: false }" class="relative hidden lg:block">
                    <button @click="langOpen = !langOpen"
                        class="flex items-center space-x-2 text-sm text-white-700 hover:text-[#ffaa00] transition">
                        <i class="fa-solid fa-globe"></i>
                        <span class="uppercase">{{ $lang }}</span>
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="langOpen" @click.away="langOpen = false"
                        class="absolute right-0 mt-2 bg-white border border-gray-200 rounded shadow-lg z-50 w-28">
                        <a href="{{ url('lang/uz') }}"
                            class="block px-4 py-2 text-sm text-black hover:bg-[#ffaa00] hover:text-black {{ $lang == 'uz' ? 'bg-[#ffaa00] text-black' : '' }}">
                            O‘zbekcha
                        </a>
                        <a href="{{ url('lang/ru') }}"
                            class="block px-4 py-2 text-sm text-black hover:bg-[#ffaa00] hover:text-black {{ $lang == 'ru' ? 'bg-[#ffaa00] text-black' : '' }}">
                            Русский
                        </a>
                        <a href="{{ url('lang/en') }}"
                            class="block px-4 py-2 text-sm text-black hover:bg-[#ffaa00] hover:text-black {{ $lang == 'en' ? 'bg-[#ffaa00] text-black' : '' }}">
                            English
                        </a>
                    </div>
                </div>

                <div class="space-x-3 py-2">
                    <a href="{{ $company['social']['facebook'] }}"
                        class="text-white hover:scale-115 hover:text-[#ffaa00] transition duration-300 inline-block">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="{{ $company['social']['telegram'] }}"
                        class="text-white hover:scale-115 hover:text-[#ffaa00] transition duration-300 inline-block">
                        <i class="fa-solid fa-paper-plane"></i>
                    </a>
                    <a href="{{ $company['social']['instagram'] }}"
                        class="text-white hover:scale-115 hover:text-[#ffaa00] transition duration-300 inline-block">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    @if ($company['social']['twitter'])
                        <a href="{{ $company['social']['twitter'] }}"
                            class="text-white hover:scale-115 hover:text-[#ffaa00] transition duration-300 inline-block">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Header Upper -->
    <div class="bg-white py-4 shadow">
        <div class="container max-w-[1300px] mx-auto flex justify-between items-center">
            <div class="p-3">
                <a href="/" class="h-10 overflow-hidden flex items-center">
                    <img class=" w-auto h-20 lg:h-30" src="{{ $company['logo'] }}"
                        alt="VIP Plast Logo">
                </a>
            </div>

            <!-- Desktop Features -->
            <div class="hidden lg:flex space-x-8">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-stamp" style="font-size: 32px; color: #ffaa00;"></i>
                    <div>
                        <p class="font-semibold text-sm">Certified Company</p>
                        <p class="text-xs text-gray-600">{{ $company['cert_number'] }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-trophy" style="font-size: 32px; color: #ffaa00;"></i>
                    <div>
                        <p class="font-semibold text-sm">Industrial Solutions</p>
                        <p class="text-xs text-gray-600">Fast & Reliable</p>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button @click="openMenu = !openMenu" class="text-gray-700 hover:text-[#ffaa00] focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!openMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="openMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Header Lower + Sticky -->
    <div class="">
        <!-- Desktop Navigation -->
        <div class="hidden lg:block relative z-40 bg-[#333333] py-4 shadow-sm text-white">
            <div class="container max-w-[1300px] mx-auto items-center uppercase px-4">
                <nav class="flex space-x-6">
                    <ul class="flex space-x-10 text-[16px] uppercase font-semibold">
                        @php $active = request()->segment(1); @endphp

                        <li class="relative pl-4 group">
                            <span
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-3 w-[2px] transition-all
                                {{ $active == '' ? 'bg-[#ffaa00]' : 'bg-gray-500 group-hover:bg-[#ffaa00]' }}">
                            </span>
                            <a href="{{ url('/') }}"
                                class="group-hover:text-[#ffaa00] transition-colors
                                {{ $active == '' ? 'text-[#ffaa00]' : 'text-white' }}"
                                wire:navigate>
                                {{ __('lang.home') }}
                            </a>
                        </li>

                        <li class="relative pl-4 group">
                            <span
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-3 w-[2px] transition-all
                                {{ $active == 'products' ? 'bg-[#ffaa00]' : 'bg-gray-500 group-hover:bg-[#ffaa00]' }}">
                            </span>
                            <a href="{{ url('/products') }}"
                                class="group-hover:text-[#ffaa00] transition-colors
                                {{ $active == 'products' ? 'text-[#ffaa00]' : 'text-white' }}"
                                wire:navigate>
                                {{ __('lang.products') }}
                            </a>
                        </li>

                        <li class="relative pl-4 group">
                            <span
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-3 w-[2px] transition-all
                                {{ $active == 'about' ? 'bg-[#ffaa00]' : 'bg-gray-500 group-hover:bg-[#ffaa00]' }}">
                            </span>
                            <a href="{{ url('/about') }}"
                                class="group-hover:text-[#ffaa00] transition-colors
                                {{ $active == 'about' ? 'text-[#ffaa00]' : 'text-white' }}">
                                {{ __('lang.about') }}
                            </a>
                        </li>

                        <li class="relative pl-4 group">
                            <span
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-3 w-[2px] transition-all
                                {{ $active == 'catalog' ? 'bg-[#ffaa00]' : 'bg-gray-500 group-hover:bg-[#ffaa00]' }}">
                            </span>
                            <a href="{{ url('/catalog') }}"
                                class="group-hover:text-[#ffaa00] transition-colors
                                {{ $active == 'catalog' ? 'text-[#ffaa00]' : 'text-white' }}">
                                {{ __('lang.catalog') }}
                            </a>
                        </li>

                        <li class="relative pl-4 group">
                            <span
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-3 w-[2px] transition-all
                                {{ $active == 'contact' ? 'bg-[#ffaa00]' : 'bg-gray-500 group-hover:bg-[#ffaa00]' }}">
                            </span>
                            <a href="{{ url('/contact') }}"
                                class="group-hover:text-[#ffaa00] transition-colors
                                {{ $active == 'contact' ? 'text-[#ffaa00]' : 'text-white' }}">
                                {{ __('lang.contact') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="openMenu" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="lg:hidden bg-[#333333] shadow-lg">
            <div class="px-4 py-6 space-y-4">
                @php $active = request()->segment(1); @endphp

                <a href="{{ url('/') }}"
                    class="block py-3 px-4 text-white hover:bg-[#ffaa00] hover:text-white transition-colors rounded
                   {{ $active == '' ? 'bg-[#ffaa00]' : '' }}"
                    wire:navigate>
                    {{ __('lang.home') }}
                </a>

                <a href="{{ url('/products') }}"
                    class="block py-3 px-4 text-white hover:bg-[#ffaa00] hover:text-white transition-colors rounded
                   {{ $active == 'products' ? 'bg-[#ffaa00]' : '' }}">
                    {{ __('lang.products') }}
                </a>

                <a href="{{ url('/catalog') }}"
                    class="block py-3 px-4 text-white hover:bg-[#ffaa00] hover:text-white transition-colors rounded
                   {{ $active == 'catalog' ? 'bg-[#ffaa00]' : '' }}">
                    {{ __('lang.catalog') }}
                </a>

                <a href="{{ url('/about') }}"
                    class="block py-3 px-4 text-white hover:bg-[#ffaa00] hover:text-white transition-colors rounded
                   {{ $active == 'about' ? 'bg-[#ffaa00]' : '' }}">
                    {{ __('lang.about') }}
                </a>

                <a href="{{ url('/contact') }}"
                    class="block py-3 px-4 text-white hover:bg-[#ffaa00] hover:text-white transition-colors rounded
                   {{ $active == 'contact' ? 'bg-[#ffaa00]' : '' }}">
                    {{ __('lang.contact') }}
                </a>

                <!-- Mobile Social Links -->
                <div class="pt-4 border-t border-gray-600">
                    <div class="flex justify-center space-x-6">
                        <a href="{{ $company['social']['facebook'] }}"
                            class="text-white hover:text-[#ffaa00] transition-colors">
                            <i class="fa-brands fa-facebook-f text-xl"></i>
                        </a>
                        <a href="{{ $company['social']['telegram'] }}"
                            class="text-white hover:text-[#ffaa00] transition-colors">
                            <i class="fa-solid fa-paper-plane text-xl"></i>
                        </a>
                        <a href="{{ $company['social']['instagram'] }}"
                            class="text-white hover:text-[#ffaa00] transition-colors">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        @if ($company['social']['twitter'])
                            <a href="{{ $company['social']['twitter'] }}"
                                class="text-white hover:text-[#ffaa00] transition-colors">
                                <i class="fa-brands fa-twitter text-xl"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Mobile Contact Info -->
                <div class="pt-4 border-t border-gray-600 text-center">
                    <a href="tel:{{ $company['phone'] }}"
                        class="flex items-center justify-center space-x-2 text-white hover:text-[#ffaa00] transition-colors">
                        <i class="fa-solid fa-phone-volume"></i>
                        <span>{{ phone_format($company['phone']) }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sticky Header (Desktop Only) -->
        <div x-show="scrollY >= 300" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 -translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0"
            class="hidden lg:block fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
            <div class="container max-w-[1300px] mx-auto flex justify-between items-center px-4">
                <div class="text-lg font-semibold">
                    <a href="/" class="h-10 overflow-hidden flex items-center">
                        <img class="w-auto h-20 lg:h-30" src="{{ $company['logo'] }}"
                            alt="VIP Plast Logo">
                    </a>
                </div>
                <nav class="flex space-x-6">
                    <ul class="flex text-[16px] uppercase font-semibold">
                        @php $active = request()->segment(1); @endphp

                        <li
                            class="p-5 group hover:bg-[#ffaa00] transition-colors
                            {{ $active == '' ? 'bg-[#ffaa00]' : '' }}">
                            <a href="{{ url('/') }}"
                                class="group-hover:text-white transition-colors
                                {{ $active == '' ? 'text-white' : 'text-black' }}"
                                wire:navigate>
                                {{ __('lang.home') }}
                            </a>
                        </li>

                        <li
                            class="p-5 group hover:bg-[#ffaa00] transition-colors
                            {{ $active == 'products' ? 'bg-[#ffaa00]' : '' }}">
                            <a href="{{ url('/products') }}"
                                class="group-hover:text-white transition-colors
                                {{ $active == 'products' ? 'text-white' : 'text-black' }}">
                                {{ __('lang.products') }}
                            </a>
                        </li>

                        <li
                            class="p-5 group hover:bg-[#ffaa00] transition-colors
                            {{ $active == 'catalog' ? 'bg-[#ffaa00]' : '' }}">
                            <a href="{{ url('/catalog') }}"
                                class="group-hover:text-white transition-colors
                                {{ $active == 'catalog' ? 'text-white' : 'text-black' }}">
                                {{ __('lang.catalog') }}
                            </a>
                        </li>

                        <li
                            class="p-5 group hover:bg-[#ffaa00] transition-colors
                            {{ $active == 'about' ? 'bg-[#ffaa00]' : '' }}">
                            <a href="{{ url('/about') }}"
                                class="group-hover:text-white transition-colors
                                {{ $active == 'about' ? 'text-white' : 'text-black' }}">
                                {{ __('lang.about') }}
                            </a>
                        </li>

                        <li
                            class="p-5 group hover:bg-[#ffaa00] transition-colors
                            {{ $active == 'contact' ? 'bg-[#ffaa00]' : '' }}">
                            <a href="{{ url('/contact') }}"
                                class="group-hover:text-white transition-colors
                                {{ $active == 'contact' ? 'text-white' : 'text-black' }}">
                                {{ __('lang.contact') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="shadow">
            <div class="max-w-[1300px] mx-auto">
                @isset($breadcrumb)
                    @include('client.partials.breadcrumb', ['items' => $breadcrumb])
                @endisset
            </div>
        </div>
    </div>
</header>
