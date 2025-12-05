@php
    $petName = 'Moka';
    $petBreed = 'Caniche';
    $petAge = '5';
    $petSex = 'male';
    $status = 'available';

    $personalityTraits = ['Calme', 'Affectueux', 'Sociable', 'Doux'];
    $personalityDescription = "Moka est un adorable caniche de 5 ans au caractère exceptionnel. Très calme et posé, il s'adapte parfaitement à la vie en appartement. C'est un compagnon idéal pour les personnes recherchant un chien tranquille et affectueux.\n\nIl adore les câlins et les moments de tendresse avec ses humains. Moka est également très sociable avec les autres chiens et s'entend à merveille avec les enfants. Il a été habitué à vivre en famille et apprécie particulièrement les promenades tranquilles.\n\nBien qu'il soit calme, Moka aime jouer de temps en temps et reste actif pour son âge. Il connaît les ordres de base et est propre. C'est vraiment un chien en or qui mérite une famille aimante !";
    $petStory = 'Moka est arrivé au refuge en juin 2024. Sa propriétaire, une dame âgée, est malheureusement décédée et la famille n\'a pas pu le garder. Il a vécu toute sa vie dans un environnement calme et aimant.'
@endphp


<x-layout type="guest" :title="$petName">

    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            {{ __('guest/pets.breadcrumb.home') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.index') }}">
            {{ __('guest/pets.breadcrumb.pets') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ $petName }}
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="container flex justify-between items-center mx-auto px-5 py-4 max-w-6xl md:px-8">
        <div class="flex items-center gap-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $petName }}</h1>
            <span
                class="px-3 py-1 {{ $status == 'available' ? 'bg-success-surface-default-subtle' : 'bg-warning-surface-default-subtle' }} text-grayscale-text-subtle text-sm font-medium rounded-full shadow-sm">
                {{ __('guest/pets.show.status.' . $status) }}
            </span>
        </div>
        <div class="hidden md:block">
            <x-cta-button variant="secondary" href="{{ route('adoption.create') }}">
                {{ __('guest/pets.show.cta_button', ['name' => $petName]) }}
            </x-cta-button>
        </div>
    </div>

    <div class="px-4 lg:px-8 py-8 max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[minmax(320px,1fr)_2fr] gap-6">

        <!-- Colonne de gauche -->
        <div class="flex flex-col gap-4">
            <div>
                <picture>
                    <source
                        srcset="{{ asset('storage/images/animals/moka_1x.webp') }} 1x,
                                {{ asset('storage/images/animals/moka_2x.webp') }} 2x,
                                {{ asset('storage/images/animals/moka_3x.webp') }} 3x"
                        type="image/webp"
                    >
                    <img
                        src="{{ asset('storage/images/animals/moka_2x.webp') }}"
                        alt="{{ __('guest/pets.show.image_alt', ['name' => $petName, 'breed' => $petBreed, 'age' => $petAge]) }}"
                        class="w-full aspect-video lg:aspect-[4/3] object-cover rounded-xl"
                        loading="lazy"
                    >
                </picture>
            </div>

            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ $petName }}</h2>
                <p class="text-xl text-neutral-600 mb-4">
                    {{ $petBreed }} • {{ __('guest/pets.show.sex_values.' . $petSex) }}
                </p>

                @php
                    $animalInfo = [
                        ['icon' => 'calendar', 'label' => __('guest/pets.show.info.age'), 'value' => $petAge . ' ans'],
                        ['icon' => 'male', 'label' => __('guest/pets.show.info.sex'), 'value' => __('guest/pets.show.sex_values.' . $petSex)],
                        ['icon' => 'paw', 'label' => __('guest/pets.show.info.coat'), 'value' => 'Brun'],
                        ['icon' => 'weight', 'label' => __('guest/pets.show.info.weight'), 'value' => '8 kg'],
                    ];
                @endphp

                <x-guest.partials.pet-show.info-grid :items="$animalInfo"/>
            </section>

            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4">{{ __('guest/pets.show.health.title') }}</h2>
                @php
                    $animalHealth = [
                        ['icon' => 'calendar', 'label' => __('guest/pets.show.health.last_vet_visit'), 'value' => '15 octobre 2024'],
                        ['icon' => 'medicine', 'label' => __('guest/pets.show.health.treatments'), 'value' => __('guest/pets.show.health.no_treatment')],
                        ['icon' => 'check', 'label' => __('guest/pets.show.health.sterilized'), 'value' => __('guest/pets.show.health.yes')],
                        ['icon' => 'check', 'label' => __('guest/pets.show.health.vaccines'), 'value' => __('guest/pets.show.health.up_to_date') . ' - Prochain rappel en mars 2025'],
                    ];
                @endphp

                <x-guest.partials.pet-show.health-grid :items="$animalHealth"/>
            </section>
        </div>

        <!-- Colonne de droite -->
        <div class="grid grid-rows-[1fr_auto_auto_auto] space-y-4 pb-8 lg:pb-0">
            <x-guest.partials.pet-show.pet-personality
                :traits="$personalityTraits"
                :description="$personalityDescription"
                class="min-h-0"
            />
            <x-guest.partials.pet-show.pet-story
                :story="$petStory"
                arrivalDate="15 juin 2024"
            />
            <div class="lg:hidden md:flex justify-center">
                <x-cta-button href="{{ route('adoption.create') }}" size="md" class="w-full md:w-auto">
                    {{ __('guest/pets.show.cta_button', ['name' => $petName]) }}
                </x-cta-button>
            </div>
            <x-guest.partials.pet-show.share-section :petName="$petName"/>
        </div>

    </div>

    <x-pet.pet-list :pets="$featured_pets"/>

</x-layout>
