<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang) }}">
  <head>
    @include('client.partials.head')
  </head>
  <body class="bg-white text-gray-800 font-sans">

    @include('client.partials.header')

    <main class="min-h-[80vh]">
      @yield('content')
    </main>

    @include('client.partials.footer')
  </body>
</html>
