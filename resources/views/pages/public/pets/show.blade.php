@php
    $personalityTraits = ['Calme', 'Affectueux', 'Sociable', 'Doux'];
@endphp


<x-layout :title="$pet->name">

    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            {{ __('public/pets.breadcrumb.home') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.index') }}">
            {{ __('public/pets.breadcrumb.pets') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ $pet->name }}
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="container flex justify-between items-center mx-auto px-5 py-4 max-w-6xl md:px-8">
        <div class="flex items-center gap-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $pet->name }}</h1>
            <span
                class="px-3 py-1 {{ $pet->status->value == 'available' ? 'bg-success-surface-default-subtle' : 'bg-warning-surface-default-subtle' }} text-grayscale-text-subtle text-sm font-medium rounded-full shadow-sm">
                {{ __('public/pets.show.status.' . $pet->status->value) }}
            </span>
        </div>
        <div class="hidden md:block">
            <x-cta-button variant="secondary" href="{{ route('adoption.create', $pet) }}">
                {{ __('public/pets.show.cta_button', ['name' => $pet->name]) }}
            </x-cta-button>
        </div>
    </div>

    <div class="px-4 lg:px-8 py-8 max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[minmax(320px,1fr)_2fr] gap-6">

        <!-- Colonne de gauche -->
        <div class="flex flex-col gap-4">
            <div>
                <picture>
                    <source
                        srcset="{{ asset('storage/images/animals/'. $pet->photo_path .'_1x.webp') }} 1x,
                                {{ asset('storage/images/animals/'. $pet->photo_path .'_2x.webp') }} 2x,
                                {{ asset('storage/images/animals/'. $pet->photo_path .'_3x.webp') }} 3x"
                        type="image/webp"
                    >
                    <img
                        src="{{ asset('storage/images/animals/'. $pet->photo_path .'_2x.webp') }}"
                        alt="{{ __('public/pets.show.image_alt', ['name' => $pet->name, 'breed' => $pet->breed, 'age' => $pet->getAgeTextAttribute()]) }}"
                        class="w-full aspect-video lg:aspect-4/3 object-cover rounded-xl"
                        loading="lazy"
                    >
                </picture>
            </div>

            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ $pet->name }}</h2>
                <p class="text-xl text-neutral-600 mb-4">
                    {{ $pet->breed}} • {{ __('public/pets.show.sex_values.' . $pet->sex->value) }}
                </p>

                @php
                    $animalInfo = [
                        ['icon' => 'calendar', 'label' => __('public/pets.show.info.age'), 'value' => $pet->getAgeTextAttribute()],
                        ['icon' => 'male', 'label' => __('public/pets.show.info.sex'), 'value' => __('public/pets.show.sex_values.' . $pet->sex->value)],
                        ['icon' => 'paw', 'label' => __('public/pets.show.info.coat'), 'value' => $pet->coat_color],
                        ['icon' => 'weight', 'label' => __('public/pets.show.info.weight'), 'value' => '8 kg'],
                    ];
                @endphp

                <x-public.partials.pet-show.info-grid :items="$animalInfo"/>
            </section>

            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4">{{ __('public/pets.show.health.title') }}</h2>
                @php
                    $animalHealth = [
                        ['icon' => 'calendar', 'label' => __('public/pets.show.health.last_vet_visit'), 'value' => $pet->last_vet_visit],
                        ['icon' => 'check', 'label' => __('public/pets.show.health.sterilized'), 'value' => $pet->sterilized
                        ? __('public/pets.show.health.yes')
                        : __('public/pets.show.health.no') ],
                        ['icon' => 'check', 'label' => __('public/pets.show.health.vaccines'), 'value' => $pet->vaccinations],
                    ];
                @endphp

                <x-public.partials.pet-show.health-grid :items="$animalHealth"/>
            </section>
        </div>

        <!-- Colonne de droite -->
        <div class="grid grid-rows-[1fr_auto_auto_auto] space-y-4 pb-8 lg:pb-0">
            <x-public.partials.pet-show.pet-personality
                :traits="$personalityTraits"
                :description="$pet->personality"
                class="min-h-0"
            />
            <x-public.partials.pet-show.pet-story
                :story="$pet->story"
                :arrivalDate="$pet->arrived_at"></x-public.partials.pet-show.pet-story>
            <div class="lg:hidden md:flex justify-center">
                <x-cta-button href="{{ route('adoption.create', $pet) }}" size="md" class="w-full md:w-auto">
                    {{ __('public/pets.show.cta_button', ['name' =>  $pet->name]) }}
                </x-cta-button>
            </div>
            <x-public.partials.pet-show.share-section :petName="$pet->name"/>
        </div>

    </div>

    <x-pet.pet-list :pets="$random_pets"/>

</x-layout>
