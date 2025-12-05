@props([
    'story' => 'Moka est arrivé au refuge en juin 2024...',
    'arrivalDate' => '15 juin 2024'
])

<section class="bg-secondary-surface-default-subtle rounded-xl border border-secondary-border-default-subtle p-6">
    <h2 class="text-2xl font-semibold mb-4">{{ __('public/pets.show.story.title') }}</h2>
    <div class="flex items-start gap-4">
        <div>
            <p class="text-grayscale-text-body leading-relaxed mb-3">
                {{ $story }}
            </p>
            <p class="text-sm text-grayscale-text-subtitle">
                <strong>{{ __('public/pets.show.story.arrival_date') }}</strong> {{ $arrivalDate }}
            </p>
        </div>
    </div>
</section>
