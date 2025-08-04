<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="Vip Plast">
<title>{{ trim($__env->yieldContent('title', $company['meta_title'][$lang])) }}</title>
<meta name="description" content="{{ trim($__env->yieldContent('description', $company['meta_description'][$lang])) }}">
<meta name="keywords" content="{{ trim($__env->yieldContent('keywords', $company['meta_keywords'][$lang])) }}">
<meta name="language" content="{{ $lang }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}">

<!-- Favicons -->
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
<!--Livewire Styles -->
@livewireStyles
<!-- Tailwind CSS -->
<link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:locale" content="{{ $lang }}">
<meta property="og:title" content="{{ trim($__env->yieldContent('title', $company['meta_title'][$lang])) }}" >
<meta property="og:description" content="{{ trim($__env->yieldContent('description', $company['meta_description'][$lang])) }}" />
<meta property="og:image" content="{{ trim($__env->yieldContent('image', asset('storage/meta/og-image.jpg'))) }}">
<meta property="og:url" content="{{ url()->current() }}" />

@stack('structured-data')
