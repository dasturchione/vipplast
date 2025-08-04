<nav class="text-sm py-4 px-3 flex items-center space-x-1 text-gray-600">
  <a href="/" class="text-primary hover:underline flex items-center space-x-1">
    <i class="fa fa-home"></i>
    <span>{{ __('lang.home') }}</span>
  </a>
  @foreach ($items as $item)
    <span class="text-gray-400">›</span>
    @if (isset($item['href']))
      <a href="{{ $item['href'] }}" class=" hover:underline">{{ $item['label'] }}</a>
    @else
      <span class="text-gray-800 font-medium">{{ $item['label'] }}</span>
    @endif
  @endforeach
</nav>
