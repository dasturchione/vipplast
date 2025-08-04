<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
    {{ end($breadcrumbs)['name'] }}
  </h2>

  <nav>
    <ol class="flex items-center gap-1.5">
      @foreach ($breadcrumbs as $index => $item)
        <li class="flex items-center gap-1.5">
          @if ($item['href'] && $index !== count($breadcrumbs) - 1)
            <a
              href="{{ $item['href'] }}"
              class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-primary-600 transition"
            >
              {{ $item['name'] }}
              <svg
                class="stroke-current text-gray-400 dark:text-gray-500"
                width="17"
                height="16"
                viewBox="0 0 17 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                  stroke-width="1.2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>
          @else
            <span class="text-sm text-gray-800 dark:text-white/90">
              {{ $item['name'] }}
            </span>
          @endif
        </li>
      @endforeach
    </ol>
  </nav>
</div>
