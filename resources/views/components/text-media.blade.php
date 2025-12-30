@props([
    'title',
    'image',
    'image_alt' => '',
    'image_order' => 'right',
    'image_ratio' => '16/9',
    'bg_color' => 'white',
    'button_text' => null,
    'button_href' => null,
    'button_variant' => 'secondary',
    'paragraphs' => [],
])

@php
    $orderClass = $image_order === 'left' ? 'md:flex-row' : 'md:flex-row-reverse';
    $getImg = fn($suffix) => \Illuminate\Support\Facades\Storage::url('images/' . $image . $suffix);
@endphp

<section class="{{ $bg_color }} py-8 md:py-16 flex justify-center ">
    <div class="flex flex-col {{ $orderClass }} md:gap-8 lg:gap-12 items-center space-y-6 md:space-y-0 max-w-6xl px-5 md:px-8 mx-auto">

        <div class="w-full md:w-1/2">
            <picture class="w-full">
                <source
                    srcset="{{ $getImg('_1x.webp') }} 1x,
                            {{ $getImg('_2x.webp') }} 2x,
                            {{ $getImg('_3x.webp') }} 3x"
                    type="image/webp"
                >
                <img
                    src="{{ $getImg('_2x.webp') }}"
                    alt="{{ $image_alt }}"
                    class="w-full h-auto block aspect-{{ str_replace('/', '-', $image_ratio) }} object-cover rounded-lg md:rounded-xl shadow-lg"
                    loading="lazy"
                >
            </picture>
        </div>

        <div class="flex flex-col items-start space-y-4 md:space-y-6 w-full md:w-1/2">
            <h2 class="text-2xl md:text-3xl font-semibold text-grayscale-text-title">
                {{ $title }}
            </h2>

            <div class="flex flex-col space-y-3 md:space-y-4 text-base md:text-lg text-grayscale-text-body leading-relaxed">
                @if(count($paragraphs) > 0)
                    @foreach($paragraphs as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                @else
                    {{ $slot }}
                @endif
            </div>

            @if($button_text && $button_href)
                <x-cta-button
                    href="{{ $button_href }}"
                variant="{{ $button_variant }}"
                >
                    {{ $button_text }}
                </x-cta-button>
            @endif
        </div>

    </div>
</section>
