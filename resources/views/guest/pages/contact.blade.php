<x-guest.layout title="Contactez-nous">
    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            Accueil
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            Contact
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="container mx-auto px-5 py-4 max-w-6xl md:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Nous contacter</h1>
    </div>

    <div class="bg-white">
        <div class="max-w-6xl mx-auto px-5 py-6 md:px-8">

            <div class="grid lg:grid-cols-2 gap-8">

                <div>
                    <x-guest.partials.contact.contact-form/>
                </div>

                <div>
                    {{-- Coordonnées Cards --}}
                    <x-guest.partials.contact.contact-infos/>

                    {{-- Map --}}
                    <x-guest.partials.contact.google-map
                        embedUrl="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.2291!2d4.3517!3d50.8503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDUxJzAxLjEiTiA0wrAyMScwNi4xIkU!5e0!3m2!1sfr!2sbe!4v1234567890"
                    />
                </div>
            </div>
        </div>
    </div>

    <x-guest.partials.contact.faq-section :faqs="$faqs" />


</x-guest.layout>

