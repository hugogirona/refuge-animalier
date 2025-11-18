<x-guest.layout title="Liste des animaux">

    <!-- BREADCRUMB -->
    <x-breadcrumb>
        <x-guest.breadcrumb-item href="{{ route('home') }}">
            Accueil
        </x-guest.breadcrumb-item>
        <x-guest.breadcrumb-item current data-last>
            Nos animaux
        </x-guest.breadcrumb-item>
    </x-breadcrumb>

    <!-- PAGE HEADER -->
    <div>
        <div class="container mx-auto px-4 pb-4 max-w-7xl">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Nos animaux</h1>
            <p class="text-grayscale-text-subtle" id="animalCount">23 animaux disponibles</p>
        </div>
    </div>

    <!-- SEARCH & FILTERS BAR (Sticky) -->
    <div class="sticky max-w-7xl mx-auto top-16 md:top-20 z-40 bg-white border-b border-neutral-200 shadow-sm rounded-xl">
        <div class="container mx-auto px-4 py-4">

            <!-- Search Bar -->
            <x-search-bar placeholder="Rechercher un animal..."/>

            <!-- Filter Chips (Horizontal Scroll) -->
            <x-filter-chip/>

            <!-- Sort & Advanced Filters -->
            <x-sort-filter/>

        </div>
    </div>


    <x-pet-list :animals="$featuredAnimals"/>



</x-guest.layout>


