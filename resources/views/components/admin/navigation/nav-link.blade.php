@props([
    'href',
    'icon',
    'label',
    'badge' => null,
    'badgeColor' => 'bg-primary-500',
    'active' => false,
])

@php
    use App\Enums\IconType;

    $iconEnum = IconType::tryFrom($icon);
    $svgContent = $iconEnum?->svg() ?? '';

    $baseClasses = 'sidebar-link flex items-center gap-3 px-4 py-2 rounded-lg transition-colors';
    $activeClasses = 'bg-primary-surface-default-subtle text-primary-text-link-light font-semibold';
    $inactiveClasses = 'text-grayscale-text-title hover:bg-neutral-50';
@endphp

<a
    href="{{ $href }}"
    class="{{ $baseClasses }} {{ $active ? $activeClasses : $inactiveClasses }}"
>
    {{-- Icon --}}
    <div class="w-8 h-8 flex justify-center items-center">
        {!! $svgContent !!}
    </div>

    {{-- Label --}}
    <span class="flex-1">{{ $label }}</span>

    {{-- Badge (optionnel) --}}
    @if($badge)
        <span class="ml-auto px-2 py-0.5 {{ $badgeColor }} text-white text-xs font-semibold rounded-full">
            {{ $badge }}
        </span>
    @endif
</a>
