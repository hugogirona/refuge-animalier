@props([
    'status',
    'type' => 'default',
])

@php
    $colors = [
        'primary' => 'bg-primary-surface-default-subtle',
        'secondary' => 'bg-secondary-surface-default-subtle',
        'success' => 'bg-success-surface-default-subtle',
        'warning' => 'bg-warning-surface-default-subtle',
        'error' => 'bg-error-surface-default-subtle',
        'default' => 'bg-neutral-100',
    ];

    $dotColors = [
        'primary' => 'bg-primary-surface-default',
        'secondary' => 'bg-secondary-surface-default',
        'success' => 'bg-success-surface-default',
        'warning' => 'bg-warning-surface-default',
        'error' => 'bg-error-surface-default',
        'default' => 'bg-neutral-500',
    ];
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $colors[$type] }}">
    <span class="w-1.5 h-1.5 rounded-full {{ $dotColors[$type] }}"></span>
    {{ $status }}
</span>
