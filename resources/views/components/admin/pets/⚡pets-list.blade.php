<?php

use Livewire\Component;

new class extends Component
{
    public array $pets = [];

    public function mount(array $pets): void
    {
        $this->pets = $pets;
    }
};
?>

<div class="flex flex-col gap-4 mb-12">
    {{-- Search Bar (non fonctionnelle pour l'instant) --}}

    <div class="bg-transparent">
        <div class="lg:max-w-xl mr-auto py-4 flex flex-col gap-3">
            <x-search-filter.search-bar placeholder="Rechercher un animal..."/>
        </div>
    </div>

    @foreach($pets as $pet)
        <article class="bg-white rounded-xl border border-neutral-200 p-4 hover:shadow-md transition-shadow cursor-pointer"
                 x-data="{ checked: false }"
                 @click="checked = !checked">
            <div class="flex items-center gap-4">

                {{-- Checkbox --}}
                    <div class="flex-shrink-0 pt-1">
                        <input
                            type="checkbox"
                            value="{{ $pet['id'] }}"
                            class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500"
                            x-model="checked"
                        >
                    </div>

                {{-- Photo --}}
                <div class="flex-shrink-0">
                    <img
                        src="{{ $pet['photo_url'] }}"
                        alt="{{ $pet['nom'] }}"
                        class="w-16 h-16 rounded-full object-cover"
                    >
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    {{-- Header --}}
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-lg font-semibold text-grayscale-text-title truncate">
                                {{ $pet['nom'] }}
                            </h2>
                            <p class="text-sm text-neutral-600">
                                {{ $pet['espece'] }} · {{ $pet['race'] ?? 'N/A' }}
                            </p>
                        </div>

                        {{-- Actions Menu --}}
                        <button class="flex-shrink-0 text-neutral-400 hover:text-grayscale-text-subtitle p-3 pr-0" @click.stop>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Badges --}}
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        @if($pet['statut'] === 'Disponible')
                            <x-admin.status-badge status="Disponible" type="success" />
                        @elseif($pet['statut'] === 'En soins')
                            <x-admin.status-badge status="En soins" type="warning" />
                        @elseif($pet['statut'] === 'Adopté')
                            <x-admin.status-badge status="Adopté" type="default" />
                        @endif

                        @if($pet['statut_publication'] === 'Oui')
                            <x-admin.status-badge status="Publié" type="success" />
                        @endif
                    </div>

                    {{-- Footer --}}
                    <p class="text-xs text-neutral-500">
                        Arrivé le {{ $pet['date_arrivee'] }} · Par {{ $pet['createur'] }}
                    </p>
                </div>

            </div>
        </article>
    @endforeach

</div>
