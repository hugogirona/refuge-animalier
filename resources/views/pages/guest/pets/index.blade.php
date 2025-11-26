<x-layout type="guest" title="Liste des animaux">

    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            Accueil
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            Nos animaux
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>


    <div class="container mx-auto px-5 py-4 max-w-6xl lg:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Nos animaux</h1>
        <p class="text-grayscale-text-subtitle" id="animalCount">23 animaux disponibles</p>
    </div>

    <!-- SEARCH & FILTERS BAR (Sticky) -->
    <div class=" sticky top-16 md:top-20 z-30 bg-white border-b border-neutral-200">
        <div class="max-w-6xl mx-auto">
            <div class="mx-auto px-4 md:px-8 py-6">

                <x-search-filter.search-bar placeholder="Rechercher un animal..."/>

{{--                <x-search-filter.filter-chip/>--}}

{{--                <x-search-filter.sort-filter/>--}}

            </div>
        </div>
    </div>

    <x-pet.pet-list :pets="$featured_pets"/>


</x-layout>


