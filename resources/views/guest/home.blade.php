<x-guest.layout>
    <h1 class="sr-only">Accueil</h1>

    <x-guest.partials.home.hero-section/>
    <x-guest.partials.home.about-section/>
    <x-pet-list :animals="$featuredAnimals"/>
    <x-guest.partials.home.stats-section :stats="$stats"/>
    <x-guest.partials.home.faq-section/>
</x-guest.layout>
