@props([
    'label',
    'name',
    'required' => false,
    'options' => [],
    'placeholder' => 'Sélectionnez une option',
    'value' => '',
    'error' => '',
    'helper' => '',
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-grayscale-text-subtitle mb-2">
        {{ $label }} @if($required)<span class="text-primary-text-link-light">*</span>@endif
    </label>
    <div class="relative">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            @if($required) required @endif
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-border-default focus:border-transparent appearance-none bg-white
                {{ $error ? 'border-error-text-link-light! focus:border-transparent!' : 'border-neutral-300 focus:ring-primary-border-default' }}"
            {{ $attributes }}
        >
            <option value="">{{ $placeholder }}</option>
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" {{ $value == $optionValue ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-grayscale-text-caption pointer-events-none fill-none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
    @if($helper)
        <p class="text-xs text-grayscale-text-subtitle mt-1">{{ $helper }}</p>
    @endif
    @if($error)
        <p class="text-error-text-link-light text-sm mt-1 error-message" data-error="{{ $name }}">{{ $error }}</p>
    @endif
</div>
