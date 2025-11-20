{{-- components/text-media.blade.php --}}
@props([
    'title',
    'image',
    'image_alt' => '',
    'image_order' => 'right', // left, right
    'image_ratio' => '16/9',
    'bg_color' => 'white',
    'button_text' => null,
    'button_href' => null,
    'button_variant' => 'secondary',
    'paragraphs' => [], // Array de paragraphes
])

@php
    $orderClass = $image_order === 'left' ? 'md:flex-row' : 'md:flex-row-reverse';
@endphp

<section class="{{ $bg_color }} py-8 md:py-16 flex justify-center ">
    <div class="flex flex-col {{ $orderClass }} md:gap-8 lg:gap-12 items-center space-y-6 md:space-y-0 max-w-6xl px-5 md:px-8 mx-auto">

        {{-- Image Column --}}
        <div class="w-full md:w-1/2">
            <picture class="w-full">
                <source
                    srcset="{{ asset('storage/images/' . $image . '_1x.webp') }} 1x,
                            {{ asset('storage/images/' . $image . '_2x.webp') }} 2x,
                            {{ asset('storage/images/' . $image . '_3x.webp') }} 3x"
                    type="image/webp"
                >
                <img
                    src="{{ asset('storage/images/' . $image . '_2x.webp') }}"
                    alt="{{ $image_alt }}"
                    class="w-full h-auto block aspect-{{$image_ratio}} object-cover rounded-lg md:rounded-xl shadow-lg"
                    loading="lazy"
                >
            </picture>
        </div>

        {{-- Text Column --}}
        <div class="flex flex-col items-start space-y-4 md:space-y-6 w-full md:w-1/2">
            {{-- Title --}}
            <h2 class="text-2xl md:text-3xl font-semibold text-grayscale-text-title">
                {{ $title }}
            </h2>

            {{-- Paragraphs --}}
            <div class="flex flex-col space-y-3 md:space-y-4 text-base md:text-lg text-grayscale-text-body leading-relaxed">
                @if(count($paragraphs) > 0)
                    @foreach($paragraphs as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                @else
                    {{ $slot }}
                @endif
            </div>

            {{-- Button (optionnel) --}}
            @if($button_text && $button_href)
                <x-cta-button
                    href="{{ $buttonHref }}"
                    variant="{{ $button_variant }}"
                >
                    {{ $buttonText }}
                </x-cta-button>
            @endif
        </div>

    </div>
</section>

