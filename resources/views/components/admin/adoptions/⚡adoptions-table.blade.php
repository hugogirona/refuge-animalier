<?php


use Livewire\Component;

new class extends Component {
    public array $adoptions = [];

    public function mount(array $adoptions): void
    {
        $this->adoptions = $adoptions;
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
                <x-admin.table.th>Animal</x-admin.table.th>
                <x-admin.table.th>Adoptant</x-admin.table.th>
                <x-admin.table.th sortable>Date</x-admin.table.th>
                <x-admin.table.th>Statut</x-admin.table.th>
                <x-admin.table.th>Dernière action</x-admin.table.th>
                <x-admin.table.th class="w-20">Actions</x-admin.table.th>
            </x-admin.table.tr>
        </x-admin.table.thead>

        <x-admin.table.tbody>
            @forelse($adoptions as $adoption)
                <x-admin.table.tr>
                    <x-admin.table.td
                        class="cursor-pointer"
                        x-data="{ checked: false }"
                        @click="checked = !checked">
                        <input
                            type="checkbox"
                            value="{{ $adoption['id'] }}"
                            x-model="checked"
                            class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500"
                        >
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ $adoption['photo_url'] }}"
                                alt="{{ $adoption['pet_name'] }}"
                                class="w-12 h-12 rounded-lg object-cover"
                            >
                            <div class="flex flex-col">
                                <p class="font-semibold text-grayscale-text-title">{{ $adoption['pet_name'] }}</p>
                                <p class="text-sm text-grayscale-text-title">{{ $adoption['pet_breed'] }}</p>
                            </div>
                        </div>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <p class="font-semibold text-grayscale-text-title">{{ $adoption['adopter_name'] }}</p>
                        <p class="text-sm text-grayscale-text-subtitle">{{ $adoption['adopter_email'] }}</p>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $adoption['created_at'] }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        @if($adoption['status'] === 'accepted')
                            <x-admin.status-badge status="Acceptée" type="success"/>
                        @elseif($adoption['status'] === 'new')
                            <x-admin.status-badge status="Nouvelle" type="primary"/>
                        @elseif($adoption['status'] === 'pending')
                            <x-admin.status-badge status="En attente" type="warning"/>
                        @elseif($adoption['status'] === 'refused')
                            <x-admin.status-badge status="Refusée" type="default"/>
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $adoption['last_action'] }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <x-admin.table.action-menu
                            :viewHref="route('adoptions.show')"
                            deleteAction="alert('Supprimer')"
                            deleteMessage="Êtes-vous sûr de vouloir supprimer cette demande ?"
                        />
                    </x-admin.table.td>

                </x-admin.table.tr>
            @empty
                <x-admin.table.tr>
                    <x-admin.table.td colspan="9" class="text-center py-12">
                        <div class="text-grayscale-text-subtitle">
                            <svg class="w-12 h-12 mx-auto mb-4 text-neutral-300" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-lg font-medium">Aucune demande d'adoption trouvée</p>
                        </div>
                    </x-admin.table.td>
                </x-admin.table.tr>
            @endforelse
        </x-admin.table.tbody>
    </x-admin.table.table>
</div>
