@props([
    'label',
    'name',
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'error' => '',
    'helper' => '',
    'pattern' => null,
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-grayscale-text-subtitle mb-2">
        {{ $label }} @if($required)<span class="text-primary-text-link-light">*</span>@endif
    </label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if($required) required @endif
        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-border-default focus:border-transparent"
        @if($type === 'email') autocomplete="email" @endif
        @if($type === 'tel') autocomplete="tel" @endif
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    >
    @if($helper)
        <p class="text-xs text-neutral-500 mt-1">{{ $helper }}</p>
    @endif
    @if($error)
        <p class="text-error-text-link-light text-sm mt-1 hidden error-message" data-error="{{ $name }}">{{ $error }}</p>
    @endif
</div>
