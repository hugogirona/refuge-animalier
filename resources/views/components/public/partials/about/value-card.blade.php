@props([
    'icon',
    'title',
    'description',
])

@php
    use App\Enums\IconTypes;

    // Convertir le string en enum
    $iconEnum = IconTypes::tryFrom($icon);

    // Récupérer la config
    $bgClass = $iconEnum?->bg() ?? 'bg-gray-50';
    $textClass = $iconEnum?->text() ?? 'text-gray-500';
    $svgContent = $iconEnum?->svg() ?? '';
@endphp

<div class="bg-white rounded-xl p-6 border border-neutral-200 hover:shadow transition-shadow">
    {{-- Icon --}}
    <div class="w-14 h-14 {{ $bgClass }} rounded-lg flex items-center justify-center mb-4">
        <div class="{{ $textClass }}">
            {!! $svgContent !!}
        </div>
    </div>

    {{-- Title --}}
    <h3 class="text-xl font-semibold mb-3 text-grayscale-text-title">
        {{ $title }}
    </h3>

    {{-- Description --}}
    <p class="text-grayscale-text-subtitle leading-relaxed">
        {{ $description }}
    </p>
</div>

