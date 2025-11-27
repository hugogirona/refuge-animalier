@props(['size' => 'desktop'])

@php
    $sizeClasses = match($size) {
        'mobile' => 'text-xs py-3',
        'desktop' => 'text-sm py-4',
    };
@endphp

<div {{ $attributes->merge(['class' => 'bg-grayscale-negative border-b border-neutral-200']) }}>
    <div class="max-w-7xl mx-auto px-5 md:px-6 {{ $sizeClasses }}">
        <nav class="flex items-center text-grayscale-text-body" aria-label="breadcrumb">
            {{ $slot }}
        </nav>
    </div>
</div>
<?php
