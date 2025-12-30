@props([
    'petName' => 'Moka'
])

<section class="bg-white rounded-xl border border-neutral-200 p-6 text-center">
    <h2 class="text-xl font-semibold mb-3">
        {{ __('public/pets.show.share.title', ['name' => $petName]) }}
    </h2>
    <p class="text-grayscale-text-body mb-4">
        {{ __('public/pets.show.share.subtitle', ['name' => $petName]) }}
    </p>

    <div x-data="{ copied: false }">
        <x-cta-button
            icon="copy"
            variant="secondary"
            title="{{ __('public/pets.show.share.copy_link') }}"
            size="md"
            @click.prevent="
                navigator.clipboard.writeText(window.location.href);
                copied = true;
                setTimeout(() => copied = false, 2000);
            "
        >
            <span x-show="!copied">{{ __('public/pets.show.share.copy_link') }}</span>
            <span x-show="copied" style="display: none;">{{ __('public/pets.show.share.link_copied') }}</span>
        </x-cta-button>
    </div>
</section>
