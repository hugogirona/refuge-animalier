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
                <img
                    src="{{ $pet->large_url }}"
                    srcset="{{ $pet->medium_url }}"
                    sizes="(max-width: 1024px) 100vw, 1200px"
                    alt="{{ __('public/pets.show.image_alt', ['name' => $pet->name, 'breed' => $pet->breed->name, 'age' => $pet->age_text]) }}"
                    class="w-full aspect-video lg:aspect-4/3 object-cover rounded-xl"
                    loading="lazy"
                >
            </div>


            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ $pet->name }}</h2>
                <p class="text-xl text-neutral-600 mb-4">
                    {{ __('breeds.'. $pet->breed->name)}} • {{ __('public/pets.show.sex_values.' . $pet->sex->value) }}
                </p>

                @php
                    $animalInfo = [
                        ['icon' => 'calendar', 'label' => __('public/pets.show.info.age'), 'value' => $pet->age_text],
                        ['icon' => $pet->sex->value, 'label' => __('public/pets.show.info.sex'), 'value' => __('public/pets.show.sex_values.' . $pet->sex->value)],
                        ['icon' => 'paw', 'label' => __('public/pets.show.info.coat'), 'value' => $pet->coat_color],
                    ];
                @endphp

                <x-public.partials.pet-show.info-grid :items="$animalInfo"/>
            </section>

            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4">{{ __('public/pets.show.health.title') }}</h2>
                @php
                    $animalHealth = [
                        ['icon' => 'calendar', 'label' => __('public/pets.show.health.last_vet_visit'),'value' => $pet->last_vet_visit?->format('d/m/Y') ?? 'Non renseigné'],
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
        <div class="grid grid-rows-[auto_auto_auto_1Fr] space-y-4 pb-8 lg:pb-0">
            <x-public.partials.pet-show.pet-personality
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
