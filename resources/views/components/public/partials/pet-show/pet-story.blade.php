@props([
    'story' => '',
    'arrivalDate' => ''
])

<section class="bg-secondary-surface-default-subtle rounded-xl border border-secondary-border-default-subtle p-6">
    <h2 class="text-2xl font-semibold mb-4">{{ __('public/pets.show.story.title') }}</h2>
    <div class="flex items-start gap-4">
        <div class="min-w-0 flex-1">
            <p class="text-grayscale-text-body leading-relaxed mb-3 wrap-break-word overflow-hidden">
                {!! nl2br(e($story)) !!}
            </p>
            @if($arrivalDate)
                <p class="text-sm text-grayscale-text-subtitle">
                    <strong>{{ __('public/pets.show.story.arrival_date') }}</strong> {{ $arrivalDate }}
                </p>
            @endif
        </div>
    </div>
</section>
