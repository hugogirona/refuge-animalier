@props([
    'icon',
    'value',
    'label',
    'trend' => null,
    'trendLabel' => null,
])

@php
    use App\Enums\IconType;

    $iconEnum = IconType::tryFrom($icon);
    $bgClass = $iconEnum?->bg() ?? 'bg-gray-50';
    $textClass = $iconEnum?->text() ?? 'text-gray-500';
    $svgContent = $iconEnum?->svg() ?? '';

    $trendColor = null;
    if ($trend) {
        $trendColor = str_starts_with($trend, '+') ? 'text-success-text-link-light' : 'text-error-text-link-light';
    }
@endphp

<div class="bg-white rounded-lg border border-neutral-200 p-6 hover:shadow transition-shadow">
    {{-- Icon --}}
    <div class="w-12 h-12 {{ $bgClass }} rounded flex items-center justify-center mb-4">
        <div class="{{ $textClass }}">
            {!! $svgContent !!}
        </div>
    </div>

    {{-- Value --}}
    <p class="text-3xl font-bold text-grayscale-text-title mb-1">
        {{ $value }}
    </p>

    {{-- Label --}}
    <p class="text-sm text-grayscale-text-subtitle mb-2">
        {{ $label }}
    </p>

    {{-- Trend (optionnel) --}}
    @if($trend)
        <p class="{{ $trendColor }} text-xs font-medium">
            {{ $trend }} {{ $trendLabel }}
        </p>
    @endif
</div>

