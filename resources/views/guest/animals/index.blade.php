<x-guest.layout title="Liste des animaux">

    <!-- BREADCRUMB -->
    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            Accueil
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            Nos animaux
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>



        <div class="container mx-auto px-4 pb-4 max-w-7xl lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Nos animaux</h1>
            <p class="text-grayscale-text-subtle" id="animalCount">23 animaux disponibles</p>
        </div>

    <!-- SEARCH & FILTERS BAR (Sticky) -->
    <div class="sticky max-w-7xl mx-auto top-16 md:top-20 z-40 bg-white border-b border-neutral-200 shadow-sm rounded-xl">
        <div class="container mx-auto px-4 py-4">

            <x-search-filter.search-bar placeholder="Rechercher un animal..."/>

            <x-search-filter.filter-chip/>

            <x-search-filter.sort-filter/>

        </div>
    </div>


    <x-pet.pet-list :animals="$featuredAnimals"/>


</x-guest.layout>


