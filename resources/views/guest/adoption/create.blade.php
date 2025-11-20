<x-guest.layout title="Formulaire d'adoption">
    <!-- BREADCRUMB -->
    <x-breadcrumb.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            Accueil
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.index') }}">
            Nos animaux
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('pets.show') }}">
            Moka
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
           Adoption
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <div class="mx-auto px-4 pb-4 max-w-6xl lg:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Demande d'adoption pour Moka</h1>
        <p class="text-grayscale-text-subtle" id="animalCount">Caniche mâle de 5 ans</p>
    </div>

    <x-form.form-progressbar/>

    <div class="container mx-auto px-4 py-8 pb-24">
        <div class=" max-w-3xl lg:px-0 mx-auto mb-8">
            <p class="flex flex-col gap-2 text-grayscale-text-subtitle bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-lg p-4">
                <strong>Merci de votre intérêt pour Moka !</strong> Remplissez ce formulaire et nous vous recontacterons rapidement pour organiser une rencontre au refuge.
            </p>
        </div>
        <x-guest.partials.adoption.adoption-form/>
    </div>
</x-guest.layout>

