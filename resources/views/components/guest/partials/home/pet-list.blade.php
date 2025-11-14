@props(['animals'])

<section class="pet-list-section py-8 px-4 bg-white ">
    <div class="container max-w-6xl mx-auto flex flex-col items-center lg:items-start justify-center ">
        <div class="mb-6 space-y-1">
            <h2 class="text-2xl font-semibold text-center lg:text-left">
                Ils attendent une famille
            </h2>
            <p class="text-lg text-grayscale-text-subtle text-center lg:text-left">
                Découvrez quelques-uns de nos pensionnaires
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto mb-6">
            @foreach($animals as $animal)
                <x-pet-card
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


        <div class="text-center">
            <x-cta-button
                href="{{ route('pets.index') }}"
                icon="arrow-right"
            >
                Voir tous nos animaux
            </x-cta-button>
        </div>

    </div>
</section>

