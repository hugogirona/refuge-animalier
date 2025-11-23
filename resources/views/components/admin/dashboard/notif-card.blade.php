

{{-- components/admin/notif-card.blade.php --}}
@props([
    'title',
    'description',
    'linkText',
    'linkHref',
    'count' => null,
    'color' => 'primary', // primary, secondary, success, error
])

@php
    $colors = [
        'primary' => [
            'bg' => 'bg-primary-surface-default-subtle',
            'border' => 'border-l-primary-surface-default',
            'badge' => 'bg-primary-surface-default',
            'link' => 'text-primary-text-link-light hover:text-primary-text-link-dark',
        ],
        'secondary' => [
            'bg' => 'bg-secondary-surface-default-subtle',
            'border' => 'border-l-secondary-surface-default',
            'badge' => 'bg-secondary-surface-default',
            'link' => 'text-secondary-text-link-light hover:text-secondary-text-link-dark',
        ],
        'success' => [
            'bg' => 'bg-success-surface-default-subtle',
            'border' => 'border-l-success-surface-default',
            'badge' => 'bg-success-surface-default',
            'link' => 'text-success-text-link-light hover:text-success-text-link-dark',
        ],
        'error' => [
            'bg' => 'bg-error-surface-default-subtle',
            'border' => 'border-l-error-surface-default',
            'badge' => 'bg-error-surface-default',
            'link' => 'text-error-text-link-light hover:text-error-text-link-dark',
        ],
    ];

    $colorClass = $colors[$color] ?? $colors['primary'];
@endphp

<div class="relative {{ $colorClass['bg'] }} border-l-4 {{ $colorClass['border'] }} rounded-lg p-4 hover:shadow transition-shadow">

    @if($count)
        <div class="absolute top-4 right-4">
            <span class="w-10 h-10 {{ $colorClass['badge'] }} text-white rounded-full flex items-center justify-center font-semibold">
                {{ $count }}
            </span>
        </div>
    @endif


    <article class="{{ $count ? 'pr-14' : '' }}">
        <h3 class="text-lg font-bold text-grayscale-text-title mb-2">
            {{ $title }}
        </h3>

        <p class="text-grayscale-text-subtitle mb-4">
            {{ $description }}
        </p>

        <a href="{{ $linkHref }}" class="{{ $colorClass['link'] }} font-medium inline-flex items-center gap-1 transition-colors">
            {{ $linkText }}
            <svg class="w-4 h-4 fill-none"  stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </article>
</div>
