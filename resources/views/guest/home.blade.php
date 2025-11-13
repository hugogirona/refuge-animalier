<x-guest.layout title="Accueil">
    <x-guest.partials.home.hero-section></x-guest.partials.home.hero-section>
    <x-guest.partials.home.about-section></x-guest.partials.home.about-section>
    <x-guest.partials.home.pet-list :animals="$featuredAnimals"></x-guest.partials.home.pet-list>
</x-guest.layout>
