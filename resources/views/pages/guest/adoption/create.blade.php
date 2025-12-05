@php
    $petName = 'Moka';
    $petSpecies = 'Caniche';
    $petSex = 'mâle';
    $petAge = '5';
@endphp

<x-layout type="guest" :title="__('guest/adoption.page_title')">
    <!-- BREADCRUMB -->
    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            {{ __('guest/adoption.breadcrumb.home') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.index') }}">
            {{ __('guest/adoption.breadcrumb.pets') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.show') }}">
            {{ $petName }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ __('guest/adoption.breadcrumb.adoption') }}
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="mx-auto px-5 py-4 max-w-6xl md:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">
            {{ __('guest/adoption.heading.title', ['name' => $petName]) }}
        </h1>
        <p class="text-grayscale-text-subtitle" id="animalCount">
            {{ __('guest/adoption.heading.subtitle', [
                'species' => $petSpecies,
                'sex' => $petSex,
                'age' => $petAge
            ]) }}
        </p>
    </div>

    <x-form.form-progressbar/>

    <div class="container mx-auto px-4 py-8 pb-24">
        <div class="max-w-3xl lg:px-0 mx-auto mb-8">
            <p class="flex flex-col gap-2 text-grayscale-text-subtitle bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-lg p-4">
                <strong>{{ __('guest/adoption.intro.title', ['name' => $petName]) }}</strong>
                {{ __('guest/adoption.intro.text') }}
            </p>
        </div>
        <x-guest.partials.adoption.adoption-form :petName="$petName"/>
    </div>
</x-layout>
