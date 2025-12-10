@props([
    'traits' => ['Calme', 'Affectueux', 'Sociable', 'Doux'],
    'description' => ''
])

<section {{ $attributes->merge(['class' => 'bg-neutral-50 rounded-xl border border-neutral-200 p-6 flex flex-col']) }}>
    <h2 class="text-2xl font-semibold mb-4">{{ __('public/pets.show.personality.title') }}</h2>

    <!-- Character Tags -->
    @if(!empty($traits))
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($traits as $trait)
                <span class="px-4 py-2 bg-primary-surface-default-subtle text-primary-text-link-dark rounded-full text-sm font-medium">
                    {{ $trait }}
                </span>
            @endforeach
        </div>
    @endif

    <!-- Description - prend l'espace restant -->
    <div class="flex-1">
        <div class="text-grayscale-text-body leading-relaxed space-y-4">
            {!! nl2br(e($description)) !!}
        </div>
    </div>
</section>
