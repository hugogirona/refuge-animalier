@props([
    'label',
    'name',
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'error' => '',
    'helper' => '',
    'icon' => NULL,
    'autocomplete' => null,
    'showPasswordToggle' => false,
    'wireModel' => null,
])
@php
    use App\Enums\IconType;

if($icon != NULL || $showPasswordToggle)

        $iconEnum = IconType::tryFrom($icon);
        $svgContent = $iconEnum?->svg() ?? '';

@endphp

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-grayscale-text-subtitle mb-2">
        {{ $label }} @if($required)
            <span class="text-primary-text-link-light">*</span>
        @endif
    </label>
    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
                {!! $svgContent !!}
            </div>
        @endif
        <input
            @if($showPasswordToggle)
                :type="showPassword ? 'text' : 'password'"
            @else
                type="{{ $type }}"
            @endif
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            @if($wireModel) wire:model="{{$wireModel}}" @endif
            @if($required) required @endif
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            class="w-full {{$icon ? 'pr-4 pl-10' :'px-4'}} py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-border-default focus:border-transparent"
            {{ $attributes }}
        >
            @if($showPasswordToggle)
                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-grayscale-text-caption hover:text-grayscale-text-subtitle  transition-colors"
                >
                    {!! IconType::tryFrom('eye-open')->svg() !!}
                    {!! IconType::tryFrom('eye-close')->svg() !!}
                </button>
            @endif

    </div>
    @if($helper)
        <p class="text-xs text-grayscale-text-subtitle mt-1">{{ $helper }}</p>
    @endif
    @if($error)
        <p class="text-error-text-link-light text-sm mt-1 hidden error-message"
           data-error="{{ $name }}">{{ $error }}</p>
    @endif
</div>
