@props([
    'description' => ''
])

<section {{ $attributes->merge(['class' => 'bg-neutral-50 rounded-xl border border-neutral-200 p-6']) }}>
    <h2 class="text-2xl font-semibold mb-4">{{ __('public/pets.show.personality.title') }}</h2>

    <!-- Description avec word-break -->
    <div class="text-grayscale-text-body leading-relaxed space-y-4 wrap-break-word overflow-hidden">
        {!! nl2br(e($description)) !!}
    </div>
</section>
