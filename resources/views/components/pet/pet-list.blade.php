@props(['animals'])

<section class="pet-list-section max-w-7xl mx-auto py-8 px-4 lg:px-8 bg-white">
    <div class="w-full flex flex-col items-center lg:items-start justify-center">
        <div class="mb-6 space-y-1 w-full">
            <h2 class="text-2xl font-semibold text-center lg:text-left">
                Ils attendent une famille
            </h2>
            <p class="text-lg text-grayscale-text-subtle text-center lg:text-left">
                Découvrez quelques-uns de nos pensionnaires
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 w-full mb-6">
            @foreach($animals as $animal)
                <x-pet.pet-card
                    :name="$animal['name']"
                    :breed="$animal['breed']"
                    :age="$animal['age']"
                    :sex="$animal['sex']"
                    :trait="$animal['trait']"
                    :image="$animal['image']"
                    :slug="$animal['slug']"
                    :status="$animal['status']"
                />
            @endforeach
        </div>

        @if(!request()->routeIs('pets.index'))
            <div class="w-full flex justify-center lg:justify-end">
                <x-cta-button
                    href="{{ route('pets.index') }}"
                    icon="arrow-right"
                >
                    Voir tous nos animaux
                </x-cta-button>
            </div>
        @endif

    </div>
</section>
