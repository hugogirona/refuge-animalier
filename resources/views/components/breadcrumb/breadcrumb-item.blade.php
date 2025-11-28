@props(['href' => null, 'current' => false])

@php
    $isLast = $attributes->get('data-last', false);
@endphp

@if(!$isLast)
        <a
            href="{{ $href }}"
            {{ $attributes->merge(['class' => 'hover:text-primary-text-link-light transition-colors text-xs']) }}
        >
            {{ $slot }}
        </a>

    <!-- Séparateur -->
    <svg class="w-3 h-3 mx-2 flex-shrink-0 fill-none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
@else
    <span {{ $attributes->merge(['class' => $current ? 'text-grayscale-text-body font-semibold text-xs' : '']) }}>
        {{ $slot }}
    </span>
@endif
