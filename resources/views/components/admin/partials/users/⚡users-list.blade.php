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

    // --- PROPRIÉTÉS ---
    public string $search = '';

    // --- SÉLECTION ---
    public array $selected = [];
    public bool $selectAll = false;

    // --- LIFECYCLE ---
    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedPage(): void { $this->selected = []; $this->selectAll = false; }

    public function updatedSelectAll($value): void {
        if ($value) {
            $this->selected = $this->users->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selected = [];
        }
    }
    public function updatedSelected(): void { $this->selectAll = false; }

    // --- ACTIONS DE MASSE ---
    public function destroySelected(): void {
        User::whereIn('id', $this->selected)->where('id', '!=', auth()->id())->delete();
        $this->selected = [];
        session()->flash('success', 'Utilisateurs supprimés.');
    }

    public function deactivateSelected(): void {
        User::whereIn('id', $this->selected)->where('id', '!=', auth()->id())
            ->update(['status' => UserStatus::INACTIVE->value]);
        $this->selected = [];
    }

    public function activateSelected(): void {
        User::whereIn('id', $this->selected)->update(['status' => UserStatus::ACTIVE->value]);
        $this->selected = [];
    }

    // --- ACTION INDIVIDUELLE ---
    public function destroy($id): void {
        if ($id == auth()->id()) return;
        User::find($id)?->delete();
        session()->flash('success', 'Utilisateur supprimé.');
    }

    // --- DONNÉES ---
    #[Computed]
    public function users(): LengthAwarePaginator
    {
        return User::query()
            ->when($this->search, function (Builder $q) {
                $q->where(function ($sub) {
                    $sub->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('last_name')
            ->paginate(6);
    }
};
?>


<div class="flex flex-col gap-4 mb-12">

    {{-- Header : Barre de recherche + Actions --}}
    <div class="flex flex-col gap-3">
        <div class="bg-transparent">
            <x-search-filter.search-bar
                wire:model.live.debounce.300ms="search"
                placeholder="Rechercher..."
            />
        </div>

        {{-- Actions de masse (Réutilisation de la logique intelligente) --}}
        @if(count($selected) > 0)
            <div class="flex items-center justify-between bg-primary-surface-default-subtle border border-primary-border-default px-4 py-2 rounded-lg animate-fade-in">
                <span class="text-sm font-medium text-primary-text-link-light">
                    {{ count($selected) }} sélectionné(s)
                </span>

                <div class="flex gap-2">
                    {{-- Logique Un seul utilisateur --}}
                    @if(count($selected) === 1)
                        @php
                            $singleUser = $this->users->find($selected[0]);
                            $isActive = $singleUser && $singleUser->status === \App\Enums\UserStatus::ACTIVE->value;
                        @endphp

                        @if($isActive)
                            <button wire:click="deactivateSelected" wire:confirm="Désactiver ?" class="text-xs px-2 py-1 bg-white border border-neutral-300 text-neutral-700 rounded hover:bg-neutral-50">
                                Désactiver
                            </button>
                        @else
                            <button wire:click="activateSelected" class="text-xs px-2 py-1 bg-white border border-success-border-default text-success-text-default rounded hover:bg-success-surface-default-subtle">
                                Activer
                            </button>
                        @endif
                    @endif

                    <button wire:click="destroySelected" wire:confirm="Supprimer ?" class="text-xs px-2 py-1 bg-white border border-error-border-default text-error-text-link-light rounded hover:bg-error-surface-default-subtle">
                        Supprimer
                    </button>
                </div>
            </div>
        @endif

        {{-- Tout sélectionner --}}
        <div class="flex items-center gap-2 px-1">
            <input type="checkbox" wire:model.live="selectAll" id="selectAllUsers" class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500 border-neutral-300 cursor-pointer">
            <label for="selectAllUsers" class="text-sm text-grayscale-text-subtitle cursor-pointer select-none">
                Tout sélectionner
            </label>
        </div>
    </div>

    {{-- Liste des Cartes --}}
    <div class="flex flex-col gap-3">
        @forelse($this->users as $user)
            <article
                wire:key="user-mobile-{{ $user->id }}"
                class="bg-white rounded-xl border border-neutral-200 p-4 transition-all hover:shadow-md relative
                {{ in_array($user->id, $selected) ? 'ring-2 ring-primary-border-default bg-primary-surface-default-subtle/30' : '' }}"
            >
                <div class="flex items-start gap-4">

                    {{-- Checkbox --}}
                    <div class="shrink-0 pt-1" @click.stop>
                        <input
                            type="checkbox"
                            value="{{ $user->id }}"
                            wire:model.live="selected"
                            class="w-5 h-5 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer"
                        >
                    </div>

                    {{-- Photo --}}
                    <div class="shrink-0">
                        <img
                            src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->full_name) }}"
                            alt="{{ $user->full_name }}"
                            class="w-14 h-14 rounded-full object-cover bg-neutral-100 border border-neutral-100"
                        >
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        {{-- Header : Nom + Actions --}}
                        <div class="flex items-start justify-between gap-2 mb-1">
                            <div class="flex-1 min-w-0">
                                <h2 class="text-lg font-bold text-grayscale-text-title truncate">
                                    {{ $user->full_name }}
                                </h2>
                                <p class="text-sm text-neutral-500 truncate">{{ $user->email }}</p>
                            </div>

                            {{-- Menu Actions (ou Bouton Delete direct) --}}
                            <div @click.stop>
                                <button
                                    wire:click="destroy({{ $user->id }})"
                                    wire:confirm="Supprimer {{ $user->full_name }} ?"
                                    class="p-2 text-neutral-400 hover:text-error-text-link-light transition-colors"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Badges --}}
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            @if($user->isAdmin())
                                <x-admin.status-badge status="Administrateur" type="primary"/>
                            @else
                                <x-admin.status-badge status="Bénévole" type="secondary"/>
                            @endif

                            @if($user->status === \App\Enums\UserStatus::ACTIVE->value)
                                <x-admin.status-badge status="Actif" type="success"/>
                            @else
                                <x-admin.status-badge status="Inactif" type="default"/>
                            @endif
                        </div>

                        {{-- Footer Info --}}
                        <div class="flex justify-between items-center text-xs text-grayscale-text-caption border-t border-neutral-100 pt-3">
                            <span>Membre depuis : {{ $user->created_at->format('d/m/Y') }}</span>
                            <span>{{ $user->pets()->count() }} fiches</span>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="py-12 text-center text-grayscale-text-subtitle bg-white rounded-xl border border-neutral-200">
                <p class="text-lg font-medium">Aucun utilisateur trouvé</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($this->users->hasPages())
        <div class="flex justify-center pt-4">
            {{ $this->users->onEachSide(0)->links('vendor.pagination.livewire-custom-orange', ['itemName' => 'utilisateurs']) }}
        </div>
    @endif
</div>

