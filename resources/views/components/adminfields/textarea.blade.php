@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => 'Enter a description...',
    'rows' => 6,
])

@php
    $inputId = $attributes->get('id', $name);
    $hasError = $errors->has($name);
@endphp

<div>
    @if($label)
        <label for="{{ $inputId }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $inputId }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' =>
                'dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border ' .
                ($hasError ? 'border-red-500' : 'border-gray-300') .
                ' bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden
                dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30'
        ]) }}
    >{{ $value }}</textarea>

    @error($name)
        <p class="mt-1 text-sm text-error-500 dark:text-red-400">
            {{ $message }}
        </p>
    @enderror
</div>
