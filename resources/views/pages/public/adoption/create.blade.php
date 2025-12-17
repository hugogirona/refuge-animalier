<x-layout :title="__('public/adoption.page_title')">
    <!-- BREADCRUMB -->
    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            {{ __('public/adoption.breadcrumb.home') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.index') }}">
            {{ __('public/adoption.breadcrumb.pets') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.show', $pet) }}">
            {{ $pet->name }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ __('public/adoption.breadcrumb.adoption') }}
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="mx-auto px-5 py-4 max-w-6xl md:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">
            {{ __('public/adoption.heading.title', ['name' => $pet->name]) }}
        </h1>
        <p class="text-grayscale-text-subtitle" id="animalCount">
            {{ __('public/adoption.heading.subtitle', [
                'species' => $pet->species->value,
                'sex' => $pet->sex->value,
                'age' => $pet->getAgeTextAttribute()
            ]) }}
        </p>
    </div>

    <x-form.form-progressbar/>

    <div class="container mx-auto px-4 py-8 pb-24">
        <div class="max-w-3xl lg:px-0 mx-auto mb-8">
            <p class="flex flex-col gap-2 text-grayscale-text-subtitle bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-lg p-4">
                <strong>{{ __('public/adoption.intro.title', ['name' => $pet->name]) }}</strong>
                {{ __('public/adoption.intro.text') }}
            </p>
        </div>
        <x-public.partials.adoption.adoption-form :pet="$pet"/>
    </div>
</x-layout>
