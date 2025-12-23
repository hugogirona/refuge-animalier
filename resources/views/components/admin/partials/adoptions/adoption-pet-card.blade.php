@props([
    'pet'
])

<article class="bg-white border border-neutral-200 rounded-xl overflow-hidden relative">
    {{-- Image --}}
    <div class="relative">
        <div>
            <img
                src="{{ $pet->large_url }}"
                srcset="{{ $pet->medium_url }} 600w,
                {{ $pet->large_url }} 1200w"
                sizes="(max-width: 1024px) 100vw, 1200px"
                alt="{{ $pet->name }}"
                class="w-full aspect-video lg:aspect-4/3 object-cover bg-neutral-100 border border-neutral-200"
                loading="lazy"
            >
        </div>

        <span class="absolute top-3 right-3 px-3 py-1 bg-white/90 backdrop-blur-sm text-grayscale-text-subtle text-sm font-medium rounded-full shadow-md">
            {{ $pet->status->value }}
        </span>
    </div>

    <div class="p-4 space-y-2 flex flex-col">
        <h2 class="text-2xl font-bold text-grayscale-text-body">
            {{ $pet->name }}
        </h2>

        <div class="space-y-1 text-grayscale-text-subtle pb-2">
            <p class="text-base">{{ $pet->breed->name ?? 'Race inconnue' }} · {{ $pet->age_text }}</p>
            <p class="text-base">{{ $pet->sex->value }}</p>
        </div>

        <x-cta-button :href="route('admin-pets.show', $pet)" variant="primary" size="sm" class="z-1 w-full justify-center">
            Voir la fiche complète
        </x-cta-button>
    </div>
</article>
