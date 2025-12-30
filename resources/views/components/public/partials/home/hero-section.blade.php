@php
    $bgImage = \Illuminate\Support\Facades\Storage::url('images/home/hero-bg_1x.webp');
@endphp

<section
    class="hero-section bg-no-repeat bg-position-[center_85%] bg-size-[auto_110%] overflow-auto pt-12 pb-20 px-5 md:pt-16 md:pb-24 lg:pt-20 lg:pb-32 mx-auto"
    style="background-image: url('{{ $bgImage }}');"
>
    <div class="container mx-auto max-w-7xl lg:px-8 flex flex-col-reverse md:flex-row md:items-center md:justify-between gap-10 md:gap-12 lg:gap-16">
        <!-- Contenu texte -->
        <div class="flex flex-col space-y-6 items-start md:w-1/2 lg:w-3/5">
            <h1 class="text-grayscale-text-title text-4xl md:text-5xl lg:text-6xl flex flex-col leading-tight">
                <span class="not-italic">{{ __('public/home.hero.title_line1') }}</span>
                <span class="text-primary-text-link-light not-italic font-bold">{{ __('public/home.hero.title_line2') }}</span>
            </h1>
            <x-cta-button
                href="{{ route('pets.index') }}"
                icon="arrow-right"
                title="{{ __('public/home.hero.button_text') }}"
            >
                {{ __('public/home.hero.button_text') }}
            </x-cta-button>
        </div>

        <div class="md:w-1/2 lg:w-3/5 relative overflow-visible">
            <svg class="absolute top-0 left-0 fill-none" xmlns="http://www.w3.org/2000/svg" lenght="auto" viewBox="0 0 803 982" aria-hidden="true">
                <g filter="url(#filter0_f_768_14819)">
                    <path d="M568.566 458.023C696.42 632.009 641.645 764.92 425.146 767.939C334.634 774.141 252.095 645.444 240.791 480.485C229.486 315.526 293.697 176.772 384.21 170.569C474.723 164.367 557.262 293.064 568.566 458.023Z" fill="url(#paint0_radial_768_14819)" fill-opacity="0.85"/>
                </g>
                <defs>
                    <filter id="filter0_f_768_14819" x="0" y="-69.1455" width="876.121" height="1076.8" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                        <feGaussianBlur stdDeviation="119.75" result="effect1_foregroundBlur_768_14819"/>
                    </filter>
                    <radialGradient id="paint0_radial_768_14819" cx="0" cy="0" r="1" gradientTransform="matrix(41.6373 287.23 -184.737 25.4901 411.925 479.511)" gradientUnits="userSpaceOnUse">
                        <stop offset="0.00173591" stop-color="#FBBF24"/>
                        <stop offset="1" stop-color="#DCDCDC"/>
                    </radialGradient>
                </defs>
            </svg>

            <picture class="flex justify-center lg:justify-end">
                <source
                    srcset="{{ Storage::url('images/home/hero-dog_1x.webp') }} 1x,
                            {{ Storage::url('images/home/hero-dog_2x.webp') }} 2x,
                            {{ Storage::url('images/home/hero-dog_3x.webp') }} 3x"
                    type="image/webp"
                >
                <img
                    src="{{ Storage::url('images/home/hero-dog_2x.webp') }}"
                    alt="{{ __('public/home.hero.image_alt') }}"
                    class="w-full h-auto max-w-lg md:max-w-xl z-1"
                    loading="eager"
                >
            </picture>
        </div>
    </div>
</section>
