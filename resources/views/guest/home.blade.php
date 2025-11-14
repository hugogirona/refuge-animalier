<x-guest.layout title="Accueil">
    <x-guest.partials.home.hero-section/>
    <x-guest.partials.home.about-section/>
    <x-guest.partials.home.pet-list :animals="$featuredAnimals"/>
    <x-guest.partials.home.stats-section :stats="$stats"/>
    <x-guest.partials.home.faq-section/>
</x-guest.layout>
