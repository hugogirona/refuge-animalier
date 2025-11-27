@props([
    'href' => '#',
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'icon_position' => 'right',
    'external' => false,
    'role' => 'cta'
])

@php
    // Variants
    $variants = [
        'primary' => 'text-white bg-primary-surface-default-light hover:bg-primary-surface-default shadow',
        'secondary' => 'text-primary-text-link-light bg-white hover:bg-primary-surface-default-subtle shadow border-1 border-primary-border-default',
        'outline' => 'text-secondary-text-link-light bg-transparent border-2 border-secondary-border-default hover:bg-secondary-surface-default-subtle',
        'ghost' => 'text-primary-500 bg-transparent hover:bg-primary-50',
    ];

    // Sizes
    $sizes = [
        'sm' => 'text-sm px-4 py-2',
        'md' => 'text-lg px-6 py-3',
        'lg' => 'text-xl px-8 py-4',
    ];

    // Icons SVG
    $icons = [
        'arrow-right' => '<svg class="w-5 h-5 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
        'arrow-left' => '<svg class="w-5 h-5 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>',
        'heart' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>',
        'plus' => '<svg class="w-5 h-5 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>',
        'external' => '<svg class="w-5 h-5 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>',
        'check' => '<svg class="w-5 h-5 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
        'copy' =>' <svg class="w-5 h-5 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>',
        'edit' => '<svg class="w-5 h-5 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $iconSvg = $icon ? ($icons[$icon] ?? null) : null;

@endphp

@if($role == 'button')
    <button
        type="submit"
        {{ $attributes->merge(['class' => "inline-flex justify-center items-center gap-2 font-semibold rounded transition-all transform duration-200 {$variantClass} {$sizeClass}"]) }}
    >
        @if($iconSvg && $icon_position === 'left')
            {!! $iconSvg !!}
        @endif

        {{ $slot }}

        @if($iconSvg && $icon_position === 'right')
            {!! $iconSvg !!}
        @endif
    </button>
@else
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => "inline-flex justify-center items-center gap-2 font-semibold rounded transition-all transform duration-200 {$variantClass} {$sizeClass}"]) }}
        @if($external) target="_blank" rel="noopener noreferrer" @endif
    >
        @if($iconSvg && $icon_position === 'left')
            {!! $iconSvg !!}
        @endif

        {{ $slot }}

        @if($iconSvg && $icon_position === 'right')
            {!! $iconSvg !!}
        @endif
    </a>
@endif

