<?php


use Livewire\Component;

new class extends Component {
    public array $users = [];

    public function mount(array $users): void
    {
        $this->users = $users;
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
                        class="w-4 h-4 text-primary-600 border-neutral-300 rounded  "
                        @click="selectAll = !selectAll"
                    >
                </x-admin.table.th>
                <x-admin.table.th sortable>Utilisateur</x-admin.table.th>
                <x-admin.table.th>Rôle</x-admin.table.th>
                <x-admin.table.th>Statut</x-admin.table.th>
                <x-admin.table.th>Dernière connexion</x-admin.table.th>
                <x-admin.table.th>Contribution</x-admin.table.th>
                <x-admin.table.th class="w-20">Actions</x-admin.table.th>
            </x-admin.table.tr>
        </x-admin.table.thead>

        <x-admin.table.tbody>
            @forelse($users as $user)
                <x-admin.table.tr>
                    <x-admin.table.td
                        class="cursor-pointer"
                        x-data="{ checked: false }"
                        @click="checked = !checked">
                        <input
                            type="checkbox"
                            value="{{ $user['id'] }}"
                            x-model="checked"
                            class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500"
                        >
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ $user['photo_url'] }}"
                                alt="{{ $user['first_name'] }}"
                                class="w-12 h-12 rounded-lg object-cover"
                            >
                            <div class="flex flex-col">
                                <p class="font-semibold text-grayscale-text-title">{{ $user['first_name'] . ' ' . $user['last_name'] }}</p>
                                <p class="text-sm text-grayscale-text-subtitle">{{ $user['email'] }}</p>
                            </div>
                        </div>
                    </x-admin.table.td>


                    <x-admin.table.td>
                        @if($user['role'] === 'admin')
                            <x-admin.status-badge status="Administrateur" type="primary"/>
                        @elseif($user['role'] === 'volunteer')
                            <x-admin.status-badge status="Bénévole" type="secondary"/>
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        @if($user['active'] === true)
                            <x-admin.status-badge status="Actif" type="success"/>
                        @else
                            <x-admin.status-badge status="Inactif" type="default"/>
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $user['last_connection'] }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $user['contribution'] }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <x-admin.table.action-menu
                            :editHref="'#'"
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
                            <p class="text-lg font-medium">Aucun utilisateur trouvé</p>
                        </div>
                    </x-admin.table.td>
                </x-admin.table.tr>
            @endforelse
        </x-admin.table.tbody>
    </x-admin.table.table>
</div>
