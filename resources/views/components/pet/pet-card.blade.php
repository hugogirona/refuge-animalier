@props([
    'name',
    'breed',
    'age',
    'sex',
    'trait',
    'image',
    'slug',
    'status'
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
        <h3 class="text-2xl font-bold text-grayscale-text-body">
            {{ $name }}
        </h3>

        <div class="space-y-1 text-grayscale-text-subtle">
            <p class="text-base">{{ $breed }} · {{ $age }} ans</p>
            <p class="text-base">{{ $sex }}</p>
        </div>

        <div class="flex items-center gap-2 text-sm text-grayscale-text-caption pb-2">
            <svg class="w-4 h-4 fill-grayscale-text-caption"   viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span>{{ $trait }}</span>
        </div>


            <x-cta-button variant="secondary" size="sm">
                Découvrir {{$name}}
            </x-cta-button>
        <a class="absolute right-0 top-0 bottom-0 left-0"
            href="{{route('pets.show')}}">&nbsp;</a>


    </div>
</article>

