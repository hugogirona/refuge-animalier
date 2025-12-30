@props([
    'name',
    'role',
    'image',
])

<div class="text-center group">
    {{-- Photo --}}
    <div class="mb-4 overflow-hidden rounded-full aspect-square w-32 h-32 md:w-40 md:h-40 mx-auto">
        <picture>

            <img
                src="{{$image}}"
                alt="{{ $name }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                loading="lazy"
            >
        </picture>
    </div>

    {{-- Name --}}
    <p class="font-semibold text-lg text-neutral-900 mb-1">
        {{ $name }}
    </p>
</div>

