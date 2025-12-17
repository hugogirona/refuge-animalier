@props([
    'label',
    'name',
    'value' => 1,
    'required' => false,
    'checked' => false,
    'error' => null,
])

<div>
    @php
        $uniqueId = $name . '_' . $value . '_' . uniqid();
    @endphp

    <label for="{{ $uniqueId }}"
           class="flex items-center p-4 border rounded-lg cursor-pointer transition-colors
           {{ $error ? 'border-error-text-link-light' : ($checked ? 'border-primary-border-default bg-primary-surface-default-subtle' : 'border-neutral-300 hover:border-primary-border-default') }}">

        {{-- ATTENTION : J'ai retiré les [] du name ici --}}
        <input
            type="checkbox"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            value="{{ $value }}"
            @if($required) required @endif
            @checked($checked)
            class="w-5 h-5 text-primary-500 border-neutral-300 rounded active:ring-primary-border-default"
        >
        <span class="ml-2 text-grayscale-text-subtitle">{{ $label }}</span>
    </label>

    @if($error)
        <p class="text-error-text-link-light text-sm mt-2">
            {{ $error }}
        </p>
    @endif
</div>
