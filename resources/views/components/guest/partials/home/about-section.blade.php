<section class="about-section">
    <svg
        viewBox="0 0 393 71"
        xmlns="http://www.w3.org/2000/svg"
        class="w-full h-auto block -mb-1"
        preserveAspectRatio="none"
    >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0 21.5927C77.0618 -13.1115 130.162 0.889581 188.012 16.1429C243.516 30.7779 303.393 46.5657 393 21.5927V71H0V21.5927Z"
            fill="#FFF7ED"
            vector-effect="non-scaling-stroke"
        />
    </svg>
    <div class="bg-primary-surface-default-subtle px-5 py-8 flex justify-center">
        <div class="max-w-6xl flex flex-col md:flex-row-reverse md:gap-6 items-start space-y-4 md:space-y-0">

            <picture class="w-full md:w-1/2">
                <source
                    srcset="{{ asset('storage/images/home/cat-about_1x.webp') }} 1x,
                            {{ asset('storage/images/home/cat-about_2x.webp') }} 2x,
                            {{ asset('storage/images/home/cat-about_3x.webp') }} 3x"
                    type="image/webp"
                >
                <img
                    src="{{ asset('storage/images/home/cat-about_2x.webp') }}"
                    alt="Photo d'un petit chat en train de se reposer"
                    class="w-full h-auto block aspect-video md:aspect-[4/3] object-cover rounded-lg"
                    loading="eager"
                >
            </picture>

            <div class="flex flex-col items-start space-y-4 md:w-1/2">
                <h2 class="text-2xl font-semibold">
                    Les Pattes Heureuses
                </h2>

                <div class="flex flex-col space-y-2">
                    <p>
                        Depuis 2018, notre refuge accueille et soigne des animaux abandonnés ou maltraités. Notre
                        mission est de leur offrir une seconde chance et de les accompagner vers une adoption responsable.
                    </p>
                    <p>
                        Chaque animal est suivi par notre équipe de bénévoles passionnés et reçoit tous les soins nécessaires avant son adoption.
                    </p>
                </div>

                <x-cta-button href="{{ route('about') }}" variant="secondary">
                    À propos de nous
                </x-cta-button>
            </div>
        </div>
    </div>
</section>
