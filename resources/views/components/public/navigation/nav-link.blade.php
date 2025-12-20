@props([
    'href' => '#',
    'title' => '',
    'active' => false,
    'mobile' => false,
])

@php
    $styles = [
        'mobile' => [
            'base' => 'block text-lg px-4 py-3 rounded-lg font-medium transition-colors',
            'default' => 'text-grayscale-text-body hover:text-primary-text-link-label hover:bg-primary-surface-default-subtle',
            'active' => 'text-primary-text-link-label font-semibold',
        ],
        'desktop' => [
            'base' => 'text-base inline-flex items-center px-4 py-2 rounded text-sm font-lg transition-colors',
            'default' => 'text-grayscale-text-body hover:text-primary-text-link-label hover:bg-primary-surface-default-subtle',
            'active' => 'text-primary-text-link-label',
        ],
    ];

    $variant = $mobile ? 'mobile' : 'desktop';
    $classes = $styles[$variant]['base'] . ' ' . ($active ? $styles[$variant]['active'] : $styles[$variant]['default']);
@endphp

<a
    href="{{ $href }}"
    title="{{ $title }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</a>
