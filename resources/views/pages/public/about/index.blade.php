<x-layout :title="__('public/about.page_title')">

    <x-breadcrumb.breadcrumb class="mb-0!">
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            {{ __('public/about.breadcrumb.home') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ __('public/about.breadcrumb.about') }}
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <x-public.partials.about.about-banner
        :title="__('public/about.banner.title')"
        :subtitle="__('public/about.banner.subtitle')"
        image="about/about-banner"
        :image_alt="__('public/about.banner.image_alt')"
    />

    <div class="max-w-6xl mx-auto">
        <x-text-media
            :title="__('public/about.history.title')"
            image="about/trainer-about"
            :image_alt="__('public/about.history.image_alt')"
            image_ratio="video"
            image_order="left"
            :paragraphs="__('public/about.history.paragraphs')"
        />
        <x-text-media
            :title="__('public/about.today.title')"
            image="about/vet-about"
            :image_alt="__('public/about.today.image_alt')"
            image_ratio="video"
            :paragraphs="__('public/about.today.paragraphs')"
        />
    </div>

    <x-public.partials.about.about-values/>

    <x-public.partials.about.about-team :team_members="$team_members"/>

</x-layout>
