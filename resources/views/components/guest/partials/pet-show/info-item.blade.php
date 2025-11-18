@props([
    'icon',
    'label',
    'value'
])

@php
    use App\Enums\IconType;


    $iconEnum = IconType::tryFrom($icon) ?? IconType::PAW;
    $config = $iconEnum->config();
@endphp

<div class="flex items-center gap-3">

    <div class="w-12 h-12 {{ $config['bg'] }} {{ $config['text'] }} rounded-lg flex items-center justify-center flex-shrink-0">
        {!! $config['svg'] !!}
    </div>

    <div>
        <p class="text-sm text-grayscale-text-subtitle">{{ $label }}</p>
        <p class="font-medium text-grayscale-text-body">{{ $value }}</p>
    </div>
</div>
