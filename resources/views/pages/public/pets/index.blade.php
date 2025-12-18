<x-layout :title="__('public/pets.page_title')">

    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            {{ __('public/pets.breadcrumb.home') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ __('public/pets.breadcrumb.pets') }}
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="container mx-auto px-5 py-4 max-w-6xl lg:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">
            {{ __('public/pets.heading.title') }}
        </h1>
        <p class="text-grayscale-text-subtitle" id="animalCount">
            {{ trans_choice('public/pets.heading.count', $query->count(), ['count' => $query->count()]) }}
        </p>
    </div>


    <div class="sticky top-16 md:top-20 z-30 bg-white border-b border-neutral-200">
        <div class="max-w-6xl mx-auto">
            <div class="mx-auto px-4 md:px-8 py-4">
                <form action="{{ route('pets.index') }}" method="GET" class="flex flex-wrap gap-4">

                    <div class="flex items-center">
                        <x-search-filter.filter-chip
                            name="species"
                            :filters="$filters"
                            :current="request('species', '')"
                        />
                    </div>

                    <div class="flex flex-wrap items-center gap-4 py-2">

                        <x-search-filter.sort-filter
                            name="age"
                            label="Tous les âges"
                            :options="['junior' => 'Junior (- 1 an)', 'adult'  => 'Adulte (1 - 8 ans)', 'senior' => 'Senior (+ 8 ans)',]"
                            :selected="request('age')"
                        />

                        @if(count($availableBreeds) > 1)
                            <x-search-filter.sort-filter
                                name="breed"
                                label="Toutes les races"
                                :options="$availableBreeds"
                                :selected="request('breed')"
                            />
                        @endif

                        <x-search-filter.sort-filter
                            name="sex"
                            label="Tous les sexes"
                            :options="['male'   => 'Mâle','female' => 'Femelle',]"
                            :selected="request('sex')"
                        />

                        {{-- Lien Reset --}}
                        @if(request()->anyFilled(['species', 'age', 'sex']))
                            <a href="{{ route('pets.index') }}"
                               class="text-sm font-medium text-red-500 hover:text-red-700 hover:underline transition-colors ml-auto sm:ml-0">
                                Effacer les filtres
                            </a>
                        @endif
                    </div>

                </form>

            </div>
        </div>
    </div>

    <x-pet.pet-list :pets="$pets"/>

</x-layout>
