@props([
    'label',
    'title',
    'href' => '#',
])

@php
    use App\Enums\IconTypes;

    $iconEnum = IconTypes::EXTERNAL_LINK;
    $svgContent = $iconEnum->svg();
@endphp

<a
        href="{{ $href }}"
        target="_blank"
        rel="noopener noreferrer"
        title="{{ $title }}"
        class="flex items-center gap-2 px-3 py-2 text-sm text-grayscale-text-title hover:bg-neutral-100 rounded-lg transition-colors"
>
    <div class="w-5 h-5 text-current">
        {!! $svgContent !!}
    </div>
    <span class="hidden md:block">{{ $label }}</span>
</a>

