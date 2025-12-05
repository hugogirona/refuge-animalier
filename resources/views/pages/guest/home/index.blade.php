<x-layout :title="__('guest/home.page_title')">
    <h1 class="sr-only">{{ __('guest/home.page_title') }}</h1>

    <x-guest.partials.home.hero-section/>
    <x-guest.partials.home.about-section/>
    <x-pet.pet-list :pets="$featured_pets"/>
    <x-guest.partials.home.stats-section :stats="$stats"/>
    <x-guest.partials.home.faq-section/>
</x-layout>
