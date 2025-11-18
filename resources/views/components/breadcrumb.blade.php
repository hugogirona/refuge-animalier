@props(['size' => 'desktop'])

@php
    $sizeClasses = match($size) {
        'mobile' => 'text-xs py-2',
        'desktop' => 'text-sm py-3',
    };
@endphp

<div {{ $attributes->merge(['class' => 'bg-white']) }}>
    <div class="max-w-7xl mx-auto px-4 lg:px-0 {{ $sizeClasses }}">
        <nav class="flex items-center text-grayscale-text-body" aria-label="breadcrumb">
            {{ $slot }}
        </nav>
    </div>
</div>
