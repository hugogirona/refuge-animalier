<section class="hero-section bg-no-repeat bg-[position:center_100%] bg-[length:auto_110%] overflow-auto bg-hero pt-12 pb-20 px-5 md:pt-16 md:pb-24 lg:pt-20 lg:pb-32 mx-auto">



    <div class="container mx-auto max-w-7xl flex flex-col-reverse md:flex-row md:items-center md:justify-between gap-10 md:gap-12 lg:gap-16">
        <!-- Contenu texte -->
        <div class="flex flex-col space-y-6 items-start md:w-1/2 lg:w-2/5">
            <h1 class="text-grayscale-text-title text-4xl md:text-5xl lg:text-6xl flex flex-col leading-tight">
                <span class="not-italic">Trouvez votre</span>
                <span class="text-primary-text-link-light not-italic font-bold">compagnon idéal</span>
            </h1>
            <x-cta-button
                href="{{ route('pets.index') }}"
                icon="arrow-right"
            >
                Voir tous nos animaux
            </x-cta-button>
        </div>

        <!-- Image du chien -->
        <div class="md:w-1/2 lg:w-3/5">
            <picture class="flex justify-center lg:justify-end">
                <source
                    srcset="{{ asset('storage/images/home/hero-dog_1x.webp') }} 1x,
                            {{ asset('storage/images/home/hero-dog_2x.webp') }} 2x,
                            {{ asset('storage/images/home/hero-dog_3x.webp') }} 3x"
                    type="image/webp"
                >
                <img
                    src="{{ asset('storage/images/home/hero-dog_2x.webp') }}"
                    alt="Photo d'un chien joyeux attendant une famille au refuge"
                    class="w-full h-auto max-w-lg md:max-w-xl"
                    loading="eager"
                >
            </picture>
        </div>
    </div>
</section>
