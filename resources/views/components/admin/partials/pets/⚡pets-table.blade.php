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

<div class="mb-12">
    {{-- Search Bar (non fonctionnelle pour l'instant) --}}
    <div class=" z-20 bg-transparent">
        <div class="lg:max-w-xl mr-auto py-4 flex flex-col gap-3">
            <x-search-filter.search-bar placeholder="Rechercher un animal..."/>
        </div>
    </div>

    {{-- Table --}}

    <x-admin.table.table>
        <x-admin.table.thead>
            <x-admin.table.tr>
                <x-admin.table.th class="w-12">
                    <input
                        type="checkbox"
                        class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500"
                        @click="selectAll = !selectAll"
                    >
                </x-admin.table.th>
                <x-admin.table.th>Photo</x-admin.table.th>
                <x-admin.table.th sortable>Nom</x-admin.table.th>
                <x-admin.table.th>Espèce/Race</x-admin.table.th>
                <x-admin.table.th>Statut</x-admin.table.th>
                <x-admin.table.th>Publié</x-admin.table.th>
                <x-admin.table.th sortable>Date d'arrivée</x-admin.table.th>
                <x-admin.table.th>Créé par</x-admin.table.th>
                <x-admin.table.th class="w-20">Actions</x-admin.table.th>
            </x-admin.table.tr>
        </x-admin.table.thead>

        <x-admin.table.tbody>
            @forelse($pets as $pet)
                <x-admin.table.tr>
                    <x-admin.table.td
                        class="cursor-pointer"
                        x-data="{ checked: false }"
                        @click="checked = !checked">
                        <input
                            type="checkbox"
                            value="{{ $pet['id'] }}"
                            x-model="checked"
                            class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500"
                        >
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <img
                            src="{{ $pet['photo_url'] }}"
                            alt="{{ $pet['nom'] }}"
                            class="w-12 h-12 rounded-lg object-cover"
                        >
                    </x-admin.table.td>

                    <x-admin.table.td>
                    <span class="font-semibold text-grayscale-text-title">
                        {{ $pet['nom'] }}
                    </span>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <div class="text-sm">
                            <div class="font-medium">{{ $pet['espece'] }}</div>
                            <div class="text-grayscale-text-subtitle">{{ $pet['race'] }}</div>
                        </div>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        @if($pet['statut'] === 'Disponible')
                            <x-admin.status-badge status="Disponible" type="success" />
                        @elseif($pet['statut'] === 'En soins')
                            <x-admin.status-badge status="En soins" type="warning" />
                        @elseif($pet['statut'] === 'Adopté')
                            <x-admin.status-badge status="Adopté" type="default" />
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        @if($pet['statut_publication'] === 'Oui')
                            <x-admin.status-badge status="Oui" type="success" />
                        @else
                            <x-admin.status-badge status="Non" type="default" />
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $pet['date_arrivee'] }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $pet['createur'] }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <x-admin.table.action-menu
                            :viewHref="route('admin-pets.show')"
                            :editHref="'#'"
                            deleteAction="alert('Supprimer')"
                            deleteMessage="Êtes-vous sûr de vouloir supprimer {{ $pet['nom'] }} ?"
                        />
                    </x-admin.table.td>

                </x-admin.table.tr>
            @empty
                <x-admin.table.tr>
                    <x-admin.table.td colspan="9" class="text-center py-12">
                        <div class="text-grayscale-text-subtitle">
                            <svg class="w-12 h-12 mx-auto mb-4 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-lg font-medium">Aucun animal trouvé</p>
                            <p class="text-sm mt-1">Commencez par ajouter un animal</p>
                        </div>
                    </x-admin.table.td>
                </x-admin.table.tr>
            @endforelse
        </x-admin.table.tbody>
    </x-admin.table.table>
</div>
