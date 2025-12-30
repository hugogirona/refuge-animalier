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

        <div class="space-y-1 text-grayscale-text-subtle mb-6">
            <p class="text-base">{{ __('breeds.'. $pet->breed->name)}} · {{ $pet->age_text }}</p>
            <p class="text-base">{{ __('public/pets.show.sex_values.' . $pet->sex->value) }}</p>
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
