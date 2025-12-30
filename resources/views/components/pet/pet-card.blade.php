@props([
    'pet',
])

<article class="bg-white border
                border-neutral-200
                rounded-xl
                overflow-hidden
                shadow
                hover:shadow-md
                transition-all
                duration-200
                hover:-translate-y-1
                relative
                ">
    <div class="relative">
        <img
            src="{{ $pet->large_url }}"
            alt="{{ $pet->name }}, {{ $pet->breed->name ?? 'Race inconnue' }} de {{ $pet->age_text }}"
            class="w-full aspect-4/3 object-cover"
            loading="lazy"
        >

        <span class="absolute top-3 right-3 px-3 py-1
            {{ $pet->status === \App\Enums\PetStatus::AVAILABLE ? 'bg-success-surface-default-subtle' : 'bg-warning-surface-default-subtle' }}
            text-grayscale-text-subtle text-sm font-medium rounded-full shadow-md">
           {{ __('public/pets.show.status.' . $pet->status->value) }}
        </span>
    </div>

    <div class="p-4 space-y-2 flex flex-col">
        <h3 class="text-2xl font-bold text-grayscale-text-body">
            {{ $pet->name }}
        </h3>

        <div class="space-y-1 text-grayscale-text-subtle">
            <p class="text-base">{{ __('breeds.'. $pet->breed->name)}} · {{ $pet->age_text }}</p>
            <p class="text-base">{{ __('public/pets.show.sex_values.' . $pet->sex->value) }}</p>
        </div>

        <div class="flex items-center gap-2 text-sm text-grayscale-text-caption pb-2">
            <svg class="w-4 h-4 fill-grayscale-text-caption" viewBox="0 0 24 24">
                <path
                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span>{{ Str::limit($pet->trait, 50) }}</span>
        </div>

        <x-cta-button
            href="{{ route('pets.show', $pet) }}"
            variant="secondary"
            size="sm"
            class="z-10 relative"
            title="{{__('public/pets.button.see'). ' ' . $pet->name }}"
        >
            {{__('public/pets.button.see'). ' ' . $pet->name }}
        </x-cta-button>

        <a
            class="absolute right-0 top-0 bottom-0 left-0 z-0"
            href="{{ route('pets.show', $pet) }}"
            title="{{__('public/pets.button.see'). ' ' . $pet->name }}"
        >&nbsp;</a>
    </div>
</article>
