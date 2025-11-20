@props([
    'name',
    'role',
    'image',
])

<div class="text-center group">
    {{-- Photo --}}
    <div class="mb-4 overflow-hidden rounded-full aspect-square w-32 h-32 md:w-40 md:h-40 mx-auto">
        <picture>
            <source
                srcset="{{ asset('storage/images/team/' . $image . '_1x.webp') }} 1x,
                        {{ asset('storage/images/team/' . $image . '_2x.webp') }} 2x"
                type="image/webp"
            >
            <img
                src="{{ asset('storage/images/team/' . $image . '_2x.webp') }}"
                alt="{{ $name }} - {{ $role }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                loading="lazy"
            >
        </picture>
    </div>

    {{-- Name --}}
    <h4 class="font-semibold text-lg text-neutral-900 mb-1">
        {{ $name }}
    </h4>

    {{-- Role --}}
    <p class="text-sm text-neutral-600">
        {{ $role }}
    </p>
</div>

