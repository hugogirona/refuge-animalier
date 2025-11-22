@props([
    'count' => 0,
])

@php
    use App\Enums\IconType;

    $iconEnum = IconType::tryFrom('bell');
    $svgContent = $iconEnum?->svg() ?? '';

@endphp



<button class="relative p-2 rounded-lg hover:bg-neutral-100 transition-colors">
    {!! $svgContent !!}
    @if($count > 0)
        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-primary-surface-default rounded-full border-2 border-white"></span>
    @endif
</button>

