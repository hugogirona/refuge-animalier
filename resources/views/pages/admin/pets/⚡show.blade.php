<?php

use App\Models\Pet;
use Livewire\Component;

new class extends Component {
    public Pet $pet;

    public function mount(Pet $pet): void
    {
        $this->pet = $pet->load(['breed', 'creator']);
    }

    public function edit(): void
    {
        $this->dispatch('open_modal',
            form: 'admin.partials.pets.form',
            model_id: (string) $this->pet->id
        );
    }
};
?>

<main class="flex-1">
    <x-admin.partials.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('dashboard.index') }}">
            Tableau de bord
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('admin-pets.index') }}">
            Animaux
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            {{ $pet->name }}
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <div>
        <x-admin.partials.title-header
            :title="$pet->name"
            buttonLabel="Éditer la fiche"
            buttonAction="edit"
            buttonIcon="edit"
        />
    </div>

    <div class="px-4 lg:px-6 py-8 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[minmax(320px,1fr)_2fr] gap-6">

        <div class="flex flex-col gap-4">
            <div>
                <img
                    src="{{ $pet->large_url }}"
                    srcset="{{ $pet->medium_url }} 600w,
                {{ $pet->large_url }} 1200w"
                    sizes="(max-width: 1024px) 100vw, 1200px"
                    alt="{{ $pet->name }}"
                    class="w-full aspect-video lg:aspect-4/3 object-cover rounded-xl bg-neutral-100 border border-neutral-200"
                    loading="lazy"
                >
            </div>


            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ $pet->name }}</h2>
                <p class="text-xl text-neutral-600 mb-4">
                    {{ $pet->breed->name ?? 'Race inconnue' }} • {{ $pet->sex->value }}
                </p>

                @php
                    $animalInfo = [
                        ['icon' => 'calendar', 'label' => 'Âge', 'value' => $pet->age_text],
                        ['icon' => 'male', 'label' => 'Sexe', 'value' => $pet->sex->value],
                        ['icon' => 'paw', 'label' => 'Pelage', 'value' => $pet->coat_color],
                        ['icon' => 'weight', 'label' => 'Poids', 'value' => $pet->weight ?? '-'],
                    ];
                @endphp

                <x-public.partials.pet-show.info-grid :items="$animalInfo"/>
            </section>

            <section class="bg-white rounded-xl border border-neutral-200 p-6">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4">Santé</h2>
                @php
                    $animalHealth = [
                        ['icon' => 'calendar', 'label' => 'Dernière visite', 'value' => $pet->last_vet_visit],
                        ['icon' => 'medicine', 'label' => 'Traitements', 'value' => 'Aucun (statique)'],
                        ['icon' => 'check', 'label' => 'Stérilisé', 'value' => $pet->sterilized ? 'Oui' : 'Non'],
                        ['icon' => 'check', 'label' => 'Vaccins', 'value' => $pet->vaccinations],
                    ];
                @endphp

                <x-public.partials.pet-show.health-grid :items="$animalHealth"/>
            </section>
        </div>

        <div class="flex flex-col gap-4 pb-8 lg:pb-0 min-w-0">
            @if($pet->personality)
                <x-public.partials.pet-show.pet-personality
                    :description="$pet->personality"
                />
            @endif

            @if($pet->story)
                <x-public.partials.pet-show.pet-story
                    :story="$pet->story"
                    :arrivalDate="$pet->arrived_at?->format('d/m/Y') ?? 'Date inconnue'"
                />
            @endif

            <livewire:admin.partials.pets.internal-notes-section :pet="$pet"/>
        </div>


    </div>
</main>
