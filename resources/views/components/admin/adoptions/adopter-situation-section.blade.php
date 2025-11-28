@props([
    'housingType' => null,
    'hasGarden' => null,
    'otherPets' => null,
    'petExperience' => null
])

<article class="mb-6">
    <h3 class="text-sm font-semibold uppercase tracking-wider mb-3">Situation</h3>
    <div class="grid md:grid-cols-2 gap-4">
        @if($housingType)
            <div class="bg-neutral-50 rounded-lg p-4">
                <p class="text-sm text-grayscale-text-caption mb-2">Type de logement</p>
                <p class="text-grayscale-text-body">{{ $housingType }}</p>
            </div>
        @endif

        @if($hasGarden !== null)
            <div class="bg-neutral-50 rounded-lg p-4">
                <p class="text-sm text-grayscale-text-caption mb-2">Jardin</p>
                <p class="text-grayscale-text-body">
                    {{ $hasGarden ? 'Oui' : 'Non' }}
                </p>
            </div>
        @endif

        @if($otherPets)
            <div class="bg-neutral-50 rounded-lg p-4 md:col-span-2">
                <p class="text-sm text-grayscale-text-caption mb-2">Autres animaux</p>
                <p class="text-grayscale-text-body" >{{ $otherPets }}</p>
            </div>
        @endif

        @if($petExperience)
            <div class="bg-neutral-50 rounded-lg p-4 md:col-span-2">
                <p class="text-sm text-grayscale-text-caption mb-2">Expérience avec les animaux</p>
                <p class="text-grayscale-text-body leading-relaxed ">{{ $petExperience }}</p>
            </div>
        @endif
    </div>
</article>
