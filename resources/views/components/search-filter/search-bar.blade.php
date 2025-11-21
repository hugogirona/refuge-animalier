@props([
    'placeholder' => 'Rechercher...',
    'name' => 'search',
    'id' => 'searchInput',
    'value' => '',
    'size' => 'md',
    'wire' => null, // Pour Livewire plus tard
])

@php
    $sizes = [
        'sm' => 'pl-9 pr-4 py-2 text-sm',
        'md' => 'pl-10 pr-4 py-3 text-base',
        'lg' => 'pl-12 pr-4 py-4 text-lg',
    ];

    $iconSizes = [
        'sm' => 'w-4 h-4 left-2.5',
        'md' => 'w-5 h-5 left-3',
        'lg' => 'w-6 h-6 left-3',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $iconClass = $iconSizes[$size] ?? $iconSizes['md'];
@endphp

<div {{ $attributes->merge(['class' => 'relative']) }}>
    {{-- Search Icon --}}
    <svg
        class="absolute fill-none {{ $iconClass }} top-1/2 transform -translate-y-1/2 text-neutral-400 pointer-events-none"

        stroke="currentColor"
        viewBox="0 0 24 24"
    >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
    </svg>

    {{-- Input --}}
    <input
        type="search"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        @if($wire) wire:model{{ $wire }} @endif
        {{ $attributes->except('class')->merge([
            'class' => "w-full {$sizeClass} border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-surface-default focus:border-transparent transition-colors"
        ]) }}
    >
</div>

