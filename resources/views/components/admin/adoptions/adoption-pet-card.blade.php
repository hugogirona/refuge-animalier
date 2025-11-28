@props([
    'name',
    'breed',
    'age',
    'sex',
    'image',
    'slug',
    'status'
])

<article class="bg-white border border-neutral-200 rounded-xl overflow-hidden relative">
    {{-- Image --}}
    <div class="relative">
        <picture>
            <source
                srcset="{{ asset('storage/images/animals/' . $image . '_1x.webp') }} 1x,
                        {{ asset('storage/images/animals/' . $image . '_2x.webp') }} 2x,
                        {{ asset('storage/images/animals/' . $image . '_3x.webp') }} 3x"
                type="image/webp"
            >
            <img
                src="{{ asset('storage/images/animals/' . $image . '_2x.webp') }}"
                alt="{{ $name }}, {{ $breed }} de {{ $age }} ans"
                class="w-full aspect-[4/3] object-cover"
                loading="lazy"
            >
        </picture>

        <span class="absolute top-3 right-3 px-3 py-1 {{$status == 'Disponible' ? 'bg-success-surface-default-subtle' : 'bg-warning-surface-default-subtle'}} text-grayscale-text-subtle text-sm font-medium rounded-full shadow-md">
            {{ $status }}
        </span>
    </div>

    <div class="p-4 space-y-2 flex flex-col">
        <h2 class="text-2xl font-bold text-grayscale-text-body">
            {{ $name }}
        </h2>

        <div class="space-y-1 text-grayscale-text-subtle pb-2">
            <p class="text-base">{{ $breed }} · {{ $age }} ans</p>
            <p class="text-base">{{ $sex }}</p>
        </div>

        <x-cta-button variant="secondary" size="sm" class="z-1">
            Voir la fiche complète
        </x-cta-button>

        <a class="absolute right-0 top-0 bottom-0 left-0" href="{{ route('pets.show', $slug) }}">&nbsp;</a>
    </div>
</article>
