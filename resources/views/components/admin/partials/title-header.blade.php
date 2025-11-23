@props(['title', 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'container px-5 py-4 md:px-6']) }}>
    <h1 class="text-3xl md:text-4xl font-semibold mb-2">{{ $title }}</h1>

    @if($subtitle)
        <p class="text-grayscale-text-subtitle">{{ $subtitle }}</p>
    @endif
</div>
