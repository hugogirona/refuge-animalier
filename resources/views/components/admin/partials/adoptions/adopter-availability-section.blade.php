@props([
    'preferredDays' => null,
    'timeSlots' => null,
    'contactPreference' => null
])

<article class="mb-6">
    <h3 class="text-sm font-semibold uppercase tracking-wider mb-3">Disponibilités</h3>
    <div class="grid grid-cols-1 gap-4">
        @if($preferredDays && count($preferredDays) > 0)
            <div class="bg-neutral-50 rounded-lg p-4">
                <p class="text-sm font-medium text-grayscale-text-caption mb-2">Jours préférés</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($preferredDays as $day)
                        <span class="px-3 py-1 bg-primary-surface-default-subtle text-primary-text-link-light text-sm font-medium rounded-full">{{ $day }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if($timeSlots && count($timeSlots) > 0)
            <div class="bg-neutral-50 rounded-lg p-4">
                <p class="text-sm font-medium text-grayscale-text-caption mb-2">Plages horaires</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($timeSlots as $slot)
                        <span class="px-3 py-1 bg-secondary-surface-default-subtle text-secondary-text-link-light text-sm font-medium rounded-full">{{ $slot }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if($contactPreference)
            <div class="bg-neutral-50 rounded-lg p-4">
                <p class="text-sm font-medium text-grayscale-text-caption mb-2">Mode de contact préféré</p>
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">
                    {{ $contactPreference }}
                </span>
            </div>
        @endif
    </div>
</article>

