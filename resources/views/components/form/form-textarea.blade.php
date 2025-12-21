@props([
    'label',
    'name',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'rows' => 3,
    'helper' => '',
    'error' => null,
    'showCounter' => false,
    'minLength' => null,
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-grayscale-text-subtitle mb-2">
        {{ $label }} @if($required)
            <span class="text-primary-text-link-light">*</span>
        @endif
        @if($minLength)
            <span class="text-neutral-500 text-xs">(min. {{ $minLength }} caractères)</span>
        @endif
    </label>

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @if($required) required @endif
        @if($minLength) minlength="{{ $minLength }}" @endif
        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-border-default focus:border-transparent resize-none
                {{ $error ? 'border-error-text-link-light! focus:border-transparent!' : 'border-neutral-300 focus:ring-primary-border-default' }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    >{{ $value }}</textarea>

    <div class="flex justify-between items-center mt-1">
        <div>
            @if($helper)
                <p class="text-xs text-grayscale-text-subtitle">{{ $helper }}</p>
            @endif
            @if($error)
                <p class="text-error-text-link-light text-sm error-message" data-error="{{ $name }}">
                    {{ $error }}
                </p>
            @endif
        </div>

        @if($showCounter)
            <span class="text-xs text-neutral-500 ml-auto"
                  wire:poll.visible>
        {{ strlen($value ?? '') }} caractères
    </span>
        @endif
    </div>
</div>
