<!DOCTYPE html>
<html>

<head>
    <title>Admin - Vipplast</title>
    @livewireStyles
    @vite(['resources/css/admin.css'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/plugins/nestable/nestable.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body x-data="{
    page: 'dashboard',
    loaded: true,
    darkMode: false,
    stickyMenu: false,
    sidebarToggle: false,
    scrollTop: false
}" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">

    @include('admin.partials.preloader')
    @include('sweetalert2::index')
    <div class="flex h-screen overflow-hidden">
        @include('admin.partials.sidebar')
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                class="fixed w-full h-screen z-9 bg-gray-900/50"></div>

            @include('admin.partials.header')
            <main>
                <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
                    @isset($breadcrumbs)
                        @include('admin.partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
                    @endisset
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/plugins/nestable/nestable.min.js"></script>

    @include('admin.partials.footer')
</body>

</html>
