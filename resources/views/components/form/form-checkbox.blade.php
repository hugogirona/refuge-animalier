@props([
    'label',
    'name',
    'value',
    'required' => false,
])

<div class="">

    @php
        $uniqueId = $name . '_' . $value . '_' . uniqid();
    @endphp

    <label for="{{ $uniqueId }}"
           class="flex items-center p-4 border-2 border-neutral-300 rounded-lg cursor-pointer hover:border-primary-border-default transition-colors">
        <input
            type="checkbox"
            id="{{ $uniqueId }}"
            name="{{ $name }}[]"
            value="{{ $value }}"
            @if($required) required @endif
            class="w-5 h-5 text-primary-500 border-neutral-300 rounded active:ring-primary-border-default"
        >
        <span class="ml-2 text-grayscale-text-subtitle">{{ $label }}</span>
    </label>


    @if($required)
        <p class="text-error-text-link-light text-sm mt-2 hidden error-message" data-error="{{ $name }}">
            Veuillez sélectionner au moins une option
        </p>
    @endif
</div>
