<x-layout :title="__('public/home.page_title')">
    <h1 class="sr-only">{{ __('public/home.page_title') }}</h1>

    <x-public.partials.home.hero-section/>
    <x-public.partials.home.about-section/>
    <x-pet.pet-list :pets="$featured_pets"/>
    <x-public.partials.home.stats-section :stats="$stats"/>
    <x-public.partials.home.faq-section/>
</x-layout>
