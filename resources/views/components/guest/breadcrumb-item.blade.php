@props(['href' => null, 'current' => false])

@php
    $isLast = $attributes->get('data-last', false);
@endphp

@if(!$isLast)
    @if($href && !$current)
        <a
            href="{{ $href }}"
            {{ $attributes->merge(['class' => 'hover:text-primary-text-link-light transition-colors']) }}
        >
            {{ $slot }}
        </a>
    @else
        <span {{ $attributes->merge(['class' => $current ? 'text-grayscale-text-body font-semibold' : '']) }}>
            {{ $slot }}
        </span>
    @endif

    <!-- Séparateur -->
    <svg class="w-4 h-4 mx-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
@else
    <span {{ $attributes->merge(['class' => $current ? 'text-grayscale-text-body font-semibold' : '']) }}>
        {{ $slot }}
    </span>
@endif
