<?php

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';
    public string $sortCol = 'last_name';
    public bool $sortAsc = true;

    public array $selected = [];
    public bool $selectAll = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPage(): void
    {
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->selected = $this->users->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function updatedSelected(): void
    {
        $this->selectAll = false;
    }

    // --- TRI ---
    public function sortBy(string $column): void
    {
        if ($this->sortCol === $column) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortCol = $column;
            $this->sortAsc = true;
        }
    }

    // --- ACTIONS ---
    public function destroySelected(): void
    {
        User::whereIn('id', $this->selected)->where('id', '!=', auth()->id())->delete();
        $this->selected = [];
    }

    public function destroy($id): void
    {
        if ($id == auth()->id()) return;
        User::find($id)?->delete();
    }

    public function deactivateSelected(): void
    {
        User::whereIn('id', $this->selected)
            ->where('id', '!=', auth()->id())
            ->update(['status' => UserStatus::INACTIVE->value]);

        $this->selected = [];
    }

    public function activateSelected(): void
    {
        User::whereIn('id', $this->selected)
            ->update(['status' => UserStatus::ACTIVE->value]);

        $this->selected = [];
    }

    public function toggleStatus($id): void
    {
        if ($id == auth()->id()) return;

        $user = User::find($id);
        if ($user) {
            $newStatus = $user->status === UserStatus::ACTIVE->value
                ? UserStatus::INACTIVE->value
                : UserStatus::ACTIVE->value;

            $user->update(['status' => $newStatus]);
        }
    }


    // --- DONNÉES ---
    #[Computed]
    public function users(): LengthAwarePaginator
    {
        return User::query()
            // Recherche
            ->when($this->search, function (Builder $q) {
                $q->where(function ($sub) {
                    $sub->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            // Tri
            ->orderBy($this->sortCol, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(5);
    }
};
?>


<div class="mb-12 flex flex-col gap-4">

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="w-full lg:max-w-xl">
            <x-search-filter.search-bar
                wire:model.live.debounce.300ms="search"
                placeholder="Rechercher par nom, email..."
            />
        </div>

        @if(count($selected) > 0)
            <div
                class="flex items-center gap-2 bg-primary-surface-default-subtle border border-primary-border-default px-4 py-2 rounded-lg animate-fade-in">
                <span class="text-sm font-medium text-primary-text-link-light">
                    {{ count($selected) }} sélectionné(s)
                </span>

                @if(count($selected) === 1)
                    @php
                        $singleUser = $this->users->find($selected[0]);
                        $isActive = $singleUser && $singleUser->status === UserStatus::ACTIVE->value;
                    @endphp

                    @if($isActive)
                        <button
                            wire:click="deactivateSelected"
                            wire:confirm="Désactiver ce compte empêchera sa connexion. Continuer ?"
                            class="text-xs px-2 py-1 bg-white border border-neutral-300 text-neutral-700 rounded hover:bg-neutral-50 transition-colors"
                        >
                            Désactiver
                        </button>
                    @else
                        <button
                            wire:click="activateSelected"
                            class="text-xs px-2 py-1 bg-white border border-success-border-default text-success-text-default rounded hover:bg-success-surface-default-subtle transition-colors"
                        >
                            Activer
                        </button>
                    @endif
                @endif

                <button
                    wire:click="destroySelected"
                    wire:confirm="Supprimer définitivement ces utilisateurs ?"
                    class="text-xs px-2 py-1 bg-white border border-error-border-default text-error-text-link-light rounded hover:bg-error-surface-default-subtle transition-colors"
                >
                    Supprimer
                </button>
            </div>
        @endif

    </div>

    {{-- Table --}}
    <x-admin.table.table>
        <x-admin.table.thead>
            <x-admin.table.tr>
                <x-admin.table.th class="w-12">
                    <input
                        type="checkbox"
                        wire:model.live="selectAll"
                        class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer"
                    >
                </x-admin.table.th>

                <x-admin.table.th sortable wire:click="sortBy('last_name')"
                                  class="cursor-pointer hover:text-primary-600 transition-colors group">
                    <div class="flex items-center gap-1">
                        Utilisateur
                        {{-- Icône de tri --}}
                        @if($sortCol === 'last_name')
                            <svg
                                class="w-4 h-4 {{ $sortAsc ? '' : 'rotate-180' }} transition-transform text-primary-600"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        @else
                            <svg class="w-4 h-4 text-neutral-300 opacity-0 group-hover:opacity-100 transition-opacity"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        @endif
                    </div>
                </x-admin.table.th>

                <x-admin.table.th>Rôle</x-admin.table.th>
                <x-admin.table.th>Statut</x-admin.table.th>
                <x-admin.table.th sortable wire:click="sortBy('created_at')"
                                  class="cursor-pointer hover:text-primary-600 transition-colors">
                    Membre depuis
                </x-admin.table.th>
                <x-admin.table.th>Contribution</x-admin.table.th>
                <x-admin.table.th class="w-20">Actions</x-admin.table.th>
            </x-admin.table.tr>
        </x-admin.table.thead>

        <x-admin.table.tbody>
            @forelse($this->users as $user)
                <x-admin.table.tr wire:key="user-{{ $user->id }}"
                                  class="{{ in_array($user->id, $selected) ? 'bg-primary-surface-default-subtle' : '' }}">

                    <x-admin.table.td>
                        <div @click.stop>
                            <input
                                wire:model.live="selected"
                                type="checkbox"
                                value="{{ $user->id }}"
                                class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer"
                            >
                        </div>
                    </x-admin.table.td>


                    {{-- Info User --}}
                    <x-admin.table.td>
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->full_name) }}"
                                alt="{{ $user->first_name }}"
                                class="w-10 h-10 rounded-full object-cover bg-neutral-100"
                            >
                            <div class="flex flex-col">
                                <p class="font-semibold text-grayscale-text-title">{{ $user->full_name }}</p>
                                <p class="text-sm text-grayscale-text-subtitle">{{ $user->email }}</p>
                            </div>
                        </div>
                    </x-admin.table.td>

                    {{-- Role --}}
                    <x-admin.table.td>
                        @if($user->isAdmin())
                            <x-admin.status-badge status="Administrateur" type="primary"/>
                        @else
                            <x-admin.status-badge status="Bénévole" type="secondary"/>
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        @if($user->status === UserStatus::ACTIVE->value)
                            <x-admin.status-badge status="Actif" type="success"/>
                        @else
                            <x-admin.status-badge status="Inactif" type="default"/>
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $user->created_at->format('d/m/Y') }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $user->pets()->count() }} fiches
                    </x-admin.table.td>

                    {{-- Actions --}}
                    <x-admin.table.td>
                        <div @click.stop>
                            <button
                                wire:click="destroy({{ $user->id }})"
                                wire:confirm="Supprimer cet utilisateur ?"
                                class="flex items-center justify-center w-full px-4 py-2.5 text-sm text-error-text-link-light transition cursor-pointer"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </x-admin.table.td>

                </x-admin.table.tr>
            @empty
                <x-admin.table.tr>
                    <x-admin.table.td colspan="7" class="text-center py-12 text-grayscale-text-subtitle">
                        Aucun utilisateur trouvé.
                    </x-admin.table.td>
                </x-admin.table.tr>
            @endforelse
        </x-admin.table.tbody>
    </x-admin.table.table>

    {{-- Pagination --}}
    @if($this->users->hasPages())
        <div class="mt-4 flex w-full justify-end">
            {{ $this->users->onEachSide(1)->links('vendor.pagination.livewire-custom-orange') }}
        </div>
    @endif
</div>

