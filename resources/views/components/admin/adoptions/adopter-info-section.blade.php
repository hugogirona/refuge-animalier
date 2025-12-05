@props([
    'adopter' => []
])

<section>
    <div class="bg-white rounded-xl border border-neutral-200 p-6">
        <h2 class="text-xl font-semibold mb-6">Informations de l'adoptant</h2>

        <article class="mb-6">
            <h3 class="text-sm font-semibold text-neutral-500 uppercase tracking-wider mb-3">Contact</h3>
            @php
                $adopterInfo = [
                    ['icon' => 'user', 'label' => 'Nom complet', 'value' => 'Sarah Martin'],
                    ['icon' => 'email', 'label' => 'Email', 'value' => 'sarah.martin@email.com '],
                    ['icon' => 'phone', 'label' => 'Téléphone', 'value' => 'Brun'],
                    ['icon' => 'location', 'label' => 'Adresse', 'value' => '8 kg'],
                ];
            @endphp

            <x-public.partials.pet-show.info-grid :items="$adopterInfo"/>
        </article>

        {{-- Situation --}}
        <x-admin.adoptions.adopter-situation-section
            :housingType="$adopter['housing_type'] ?? null"
            :hasGarden="$adopter['has_garden'] ?? null"
            :gardenSize="$adopter['garden_size'] ?? null"
            :otherPets="$adopter['other_pets'] ?? null"
            :petExperience="$adopter['pet_experience'] ?? null"
        />


        {{-- Disponibilités --}}
        <x-admin.adoptions.adopter-availability-section
            :preferredDays="$adopter['preferred_days'] ?? null"
            :timeSlots="$adopter['time_slots'] ?? null"
            :contactPreference="$adopter['contact_preference'] ?? null"
        />

        {{-- Message --}}
        @if(isset($adopter['motivation']))
            <article>
                <h3 class="text-sm font-semibold text-neutral-500 uppercase tracking-wider mb-3">Message de
                    l'adoptant</h3>
                <div
                    class="bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-lg p-4">
                    <p class="text-grayscale-text-body leading-relaxed italic">
                        "{{ $adopter['motivation'] }}"
                    </p>
                </div>
            </article>
        @endif
    </div>
</section>
