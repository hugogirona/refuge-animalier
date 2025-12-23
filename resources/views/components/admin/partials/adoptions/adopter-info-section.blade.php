@props([
    'adoption'
])

<section>
    <div class="bg-white rounded-xl border border-neutral-200 p-6">
        <h2 class="text-xl font-semibold mb-6">Informations de l'adoptant</h2>

        <article class="mb-6">
            <h3 class="text-sm font-semibold text-neutral-500 uppercase tracking-wider mb-3">Contact</h3>
            @php
                $adopterInfo = [
                    ['icon' => 'user', 'label' => 'Nom complet', 'value' => $adoption->full_name],
                    ['icon' => 'email', 'label' => 'Email', 'value' => $adoption->email],
                    ['icon' => 'phone', 'label' => 'Téléphone', 'value' => $adoption->phone],
                    ['icon' => 'location', 'label' => 'Adresse', 'value' => $adoption->address . ', ' . $adoption->zip_code . ' ' . $adoption->city],
                ];
            @endphp

            <x-public.partials.pet-show.info-grid :items="$adopterInfo"/>
        </article>

        <x-admin.partials.adoptions.adopter-situation-section
            :housingType="$adoption->accommodation_type"
            :hasGarden="$adoption->has_garden"
            :otherPets="$adoption->has_other_pets"
            :petExperience="$adoption->had_same"
        />

        <x-admin.partials.adoptions.adopter-availability-section
            :preferredDays="$adoption->available_days"
            :timeSlots="$adoption->available_hours"
            :contactPreference="$adoption->preferred_contact_method"
        />

        @if($adoption->message)
            <article class="mt-6">
                <h3 class="text-sm font-semibold text-neutral-500 uppercase tracking-wider mb-3">Message de l'adoptant</h3>
                <div class="bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-lg p-4">
                    <p class="text-grayscale-text-body leading-relaxed italic">
                        "{{ $adoption->message }}"
                    </p>
                </div>
            </article>
        @endif
    </div>
</section>
