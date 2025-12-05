@props([
    'href' => '#',
    'title' => '',
    'active' => false,
])

@php
    $classes = 'text-lg md:text-xl text-white hover:border-b-1 transition-colors';
    if ($active) {
        $classes .= ' border-b-1';
    }
@endphp

<a
    href="{{ $href }}"
    title="{{ $title }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</a>

