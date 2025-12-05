<x-layout type="guest" :title="__('guest/about.page_title')">

    <x-breadcrumb.breadcrumb class="!mb-0">
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            {{ __('guest/about.breadcrumb.home') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ __('guest/about.breadcrumb.about') }}
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <x-guest.partials.about.about-banner
        :title="__('guest/about.banner.title')"
        :subtitle="__('guest/about.banner.subtitle')"
        image="about/about-banner"
        :image_alt="__('guest/about.banner.image_alt')"
    />

    <div class="max-w-6xl mx-auto">
        <x-text-media
            :title="__('guest/about.history.title')"
            image="home/cat-about"
            :image_alt="__('guest/about.history.image_alt')"
            image_ratio="video"
            :paragraphs="__('guest/about.history.paragraphs')"
        />
        <x-text-media
            :title="__('guest/about.today.title')"
            image="home/cat-about"
            :image_alt="__('guest/about.today.image_alt')"
            image_order="left"
            image_ratio="video"
            :paragraphs="__('guest/about.today.paragraphs')"
        />
    </div>

    <x-guest.partials.about.about-values/>

    <x-guest.partials.about.about-team :team_members="$team_members"/>

</x-layout>
