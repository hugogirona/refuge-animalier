@php $status = 'Disponible' @endphp

<x-layout type="guest" :title="'Moka'">

    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            Accueil
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.index') }}">
            Nos animaux
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            Moka
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="container flex justify-between items-center mx-auto px-5 py-4 max-w-6xl md:px-8">
        <div class="flex items-center gap-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Moka</h1>
            <span
                class="px-3 py-1 {{$status == 'Disponible' ? 'bg-success-surface-default-subtle' : 'bg-warning-surface-default-subtle'}} text-grayscale-text-subtle text-sm font-medium rounded-full shadow-sm">
            {{$status}}
        </span>
        </div>
        <div class="hidden md:block">
            <x-cta-button variant="secondary" href="{{route('adoption.create')}}">Je veux rencontrer Moka</x-cta-button>
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
                        alt="Moka, caniche de 5 ans"
                        class="w-full aspect-video lg:aspect-[4/3] object-cover rounded-xl"
                        loading="lazy"
                    >
                </picture>
            </div>
            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Moka</h2>
                <p class="text-xl text-neutral-600 mb-4">Caniche • Mâle</p>

                @php
                    $animalInfo = [
                        ['icon' => 'calendar', 'label' => 'Âge', 'value' => '5 ans'],
                        ['icon' => 'male', 'label' => 'Sexe', 'value' => 'Mâle'],
                        ['icon' => 'paw', 'label' => 'Pelage', 'value' => 'Brun'],
                        ['icon' => 'weight', 'label' => 'Poids', 'value' => '8 kg'],
                    ];
                @endphp

                <x-guest.partials.pet-show.info-grid :items="$animalInfo"/>
            </section>
            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4">Santé</h2>
                @php
                    $animalHealth = [
                        ['icon' => 'calendar', 'label' => 'Dernière visite vétérinaire', 'value' => '15 octobre 2024'],
                        ['icon' => 'medicine', 'label' => 'Traitements en cours', 'value' => 'Aucun traitement particulier'],
                        ['icon' => 'check', 'label' => 'Stérilisé', 'value' => 'Oui'],
                        ['icon' => 'check', 'label' => 'Vaccins', 'value' => 'À jour - Prochain rappel en mars 2025'],
                    ];
                @endphp

                <x-guest.partials.pet-show.health-grid :items="$animalHealth"/>
            </section>
        </div>

        <!-- Colonne de droite -->
        <div class="grid grid-rows-[1fr_auto_auto_auto] space-y-4 pb-8 lg:pb-0">
            <x-guest.partials.pet-show.pet-personality class="min-h-0"/>
            <x-guest.partials.pet-show.pet-story/>
            <div class="lg:hidden md:flex justify-center">
                <x-cta-button href="{{route('adoption.create')}}" size="md" class="w-full md:w-auto">
                    Je veux rencontrer Moka
                </x-cta-button>
            </div>
            <x-guest.partials.pet-show.share-section/>
        </div>

    </div>

    <x-pet.pet-list :pets="$featured_pets"/>

</x-layout>
