@props([
    'title',
    'subtitle' => null,
    'image',
    'image_alt' => '',
    'height' => 'md', // sm, md, lg
    'overlay' => 'dark', // dark, light, gradient
    'textAlign' => 'center', // left, center
])

@php
    $heights = [
        'sm' => 'h-64 md:h-80',
        'md' => 'h-80 md:h-96',
        'lg' => 'h-96 md:h-[500px]',
    ];

    $overlays = [
        'dark' => 'bg-gradient-to-b from-black/30 to-black/60',
        'light' => 'bg-gradient-to-b from-white/30 to-white/60',
        'gradient' => 'bg-gradient-to-br from-primary-500/30 to-secondary-500/30',
        'none' => '',
    ];

    $textAlignClass = $textAlign === 'center' ? 'text-center' : 'text-left';

    $heightClass = $heights[$height] ?? $heights['md'];
    $overlayClass = $overlays[$overlay] ?? $overlays['dark'];

$getImg = fn($suffix) => \Illuminate\Support\Facades\Storage::url('images/' . $image . $suffix);
@endphp

<section class="relative {{ $heightClass }} overflow-hidden">

    <div class="absolute inset-0">
        <picture>
            <source
                srcset="{{ $getImg('_1x.webp') }} 1x,
                        {{ $getImg('_2x.webp') }} 2x,
                        {{ $getImg('_3x.webp') }} 3x"
                type="image/webp"
            >
            <img
                src="{{ $getImg('_2x.webp') }}"
                alt="{{ $image_alt }}"
                class="w-full h-full object-cover"
                loading="eager"
            >
        </picture>

        @if($overlayClass)
            <div class="absolute inset-0 {{ $overlayClass }}"></div>
        @endif
    </div>


    <div class="relative h-full flex items-center justify-center px-4">
        <div class="max-w-4xl {{ $textAlignClass }}">

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold !text-white mb-4 leading-tight drop-shadow-lg">
                {{ $title }}
            </h1>

            @if($subtitle)
                <p class="text-lg md:text-xl lg:text-2xl text-white/90 leading-relaxed drop-shadow-md">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
    </div>
</section>
