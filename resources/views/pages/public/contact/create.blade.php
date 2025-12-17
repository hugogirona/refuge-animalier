<x-layout type="public" :title="__('public/contact.page_title')">
    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            {{ __('public/contact.breadcrumb.home') }}
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ __('public/contact.breadcrumb.contact') }}
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="container mx-auto px-5 py-4 max-w-6xl md:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ __('public/contact.heading.title') }}</h1>
    </div>

    <div class="bg-white">
        <div class="max-w-6xl mx-auto px-5 py-6 md:px-8">

            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-success-surface-default-subtle border border-success-border-default-subtle flex items-start gap-3 animate-fade-in">
                    <svg
                        class="w-6 h-6 shrink-0 text-success-text-link-light fill-none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-bold">Message envoyé !</p>
                        <p class="text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-8">

                <div>
                    <x-public.partials.contact.contact-form/>
                </div>

                <div>
                    {{-- Coordonnées Cards --}}
                    <x-public.partials.contact.contact-infos/>

                    {{-- Map --}}
                    <x-public.partials.contact.google-map
                        embedUrl="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.2291!2d4.3517!3d50.8503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDUxJzAxLjEiTiA0wrAyMScwNi4xIkU!5e0!3m2!1sfr!2sbe!4v1234567890"
                    />
                </div>
            </div>
        </div>
    </div>

    <x-public.partials.contact.faq-section :faqs="__('public/contact.faq.items')" />

</x-layout>
