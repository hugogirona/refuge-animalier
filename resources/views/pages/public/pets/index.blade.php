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
            {{ trans_choice('public/pets.heading.count', $pets->total(), ['count' => $pets->total()]) }}
        </p>
    </div>


    <div class="sticky top-16 md:top-20 z-30 bg-white border-b border-neutral-200 shadow-sm">
        <div class="max-w-6xl mx-auto">
            <div class="mx-auto px-4 lg:px-6 py-3 lg:py-4">

                <form action="{{ route('pets.index') }}" method="GET" class="flex flex-col gap-3 md:gap-4">
                    <div class="flex items-center overflow-x-auto hide-scrollbar -mx-4 px-4 md:mx-0 md:px-0 md:overflow-visible">
                        <x-search-filter.filter-chip
                            name="species"
                            :filters="$filters"
                            :current="request('species', '')"
                            class="flex-nowrap"
                        />
                    </div>

                    <div class="flex flex-wrap items-center gap-3 border-t border-neutral-100 pt-3 md:border-none md:pt-0">

                        <div class="contents sm:flex sm:flex-wrap sm:gap-3 grid-cols-2 gap-2 w-full sm:w-auto">

                            <div class="w-full sm:w-auto">
                                <x-search-filter.sort-filter
                                    name="age"
                                    label="{{ __('public/pets.filters.all_ages') }}"
                                    :options="[
                                    'junior' => __('public/pets.filters.junior'),
                                    'adult'  => __('public/pets.filters.adult'),
                                    'senior' => __('public/pets.filters.senior'),
                                    ]"
                                    :selected="request('age')"
                                    class="w-full"
                                />

                            </div>

                            @if(count($availableBreeds) > 1)
                                <div class="w-full sm:w-auto">
                                    <x-search-filter.sort-filter
                                        name="breed"
                                        label="{{ __('public/pets.filters.all_races') }}"
                                        :options="$availableBreeds"
                                        :selected="request('breed')"
                                        class="w-full"
                                    />
                                </div>
                            @endif

                            <div class="w-full sm:w-auto">
                                <x-search-filter.sort-filter
                                    name="sex"
                                    label="{{ __('public/pets.filters.all_sexes') }}"
                                    :options="['male' => __('public/pets.show.sex_values.male'),'female' => __('public/pets.show.sex_values.female')]"
                                    :selected="request('sex')"
                                    class="w-full"
                                />
                            </div>
                        </div>

                        @if(request()->anyFilled(['species', 'age', 'sex', 'breed']))
                            <a href="{{ route('pets.index') }}"
                               class="text-sm font-medium text-red-500 hover:text-red-700 hover:underline transition-colors ml-auto whitespace-nowrap px-2 py-1">
                                Effacer
                            </a>
                        @endif
                    </div>

                </form>

            </div>
        </div>
    </div>


    <x-pet.pet-list :pets="$pets"/>

</x-layout>
