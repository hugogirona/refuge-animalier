
@props([
    'label',
    'name',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'rows' => 3,
    'helper' => '',
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-grayscale-text-subtitle mb-2">
        {{ $label }} @if($required)<span class="text-primary-text-link-light">*</span>@endif
    </label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @if($required) required @endif
        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-border-default focus:border-transparent resize-none"
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    >{{ $value }}</textarea>
    @if($helper)
        <p class="text-xs text-neutral-500 mt-1">{{ $helper }}</p>
    @endif
</div>
