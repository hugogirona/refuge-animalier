<?php

use App\Enums\AdoptionRequestStatus;
use App\Models\AdoptionRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    // --- FILTRES ---
    public string $search = '';

    // --- SÉLECTION ---
    public array $selected = [];
    public bool $selectAll = false;

    // --- LIFECYCLE ---
    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedPage(): void { $this->selected = []; $this->selectAll = false; }

    public function updatedSelectAll($value): void {
        if ($value) {
            $this->selected = $this->adoptions->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selected = [];
        }
    }
    public function updatedSelected(): void { $this->selectAll = false; }

    // --- ACTIONS DE MASSE ---
    public function acceptSelected(): void {
        AdoptionRequest::whereIn('id', $this->selected)->update(['status' => AdoptionRequestStatus::ACCEPTED]);
        $this->selected = [];
        session()->flash('success', 'Demandes acceptées.');
    }

    public function rejectSelected(): void {
        AdoptionRequest::whereIn('id', $this->selected)->update(['status' => AdoptionRequestStatus::REJECTED]);
        $this->selected = [];
        session()->flash('success', 'Demandes refusées.');
    }

    public function deleteSelected(): void {
        AdoptionRequest::whereIn('id', $this->selected)->delete();
        $this->selected = [];
    }

    // --- DONNÉES ---
    #[Computed]
    public function adoptions(): LengthAwarePaginator
    {
        return AdoptionRequest::query()
            ->with(['pet.breed', 'processor'])
            ->when($this->search, function (Builder $q) {
                $q->where(function ($query) {
                    $query->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhereHas('pet', function ($petQuery) {
                            $petQuery->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(6);
    }
};
?>

<div class="flex flex-col gap-6 mb-12">

    {{-- Header : Recherche + Actions (Inchangé) --}}
    <div class="bg-transparent flex flex-col gap-3">
        <div class="lg:max-w-xl mr-auto pt-4 w-full">
            <x-search-filter.search-bar
                wire:model.live.debounce.300ms="search"
                placeholder="Rechercher par nom, email ou animal..."
            />
        </div>

        @if(count($selected) > 0)
            <div class="flex items-center justify-between bg-primary-surface-default-subtle border border-primary-border-default px-4 py-2 rounded-lg animate-fade-in">
                <span class="text-sm font-medium text-primary-text-link-light">
                    {{ count($selected) }} sélectionné(s)
                </span>
                <div class="flex gap-2">
                    <button wire:click="acceptSelected" class="text-xs px-2 py-1 bg-white border border-success-border-default text-success-text-default rounded hover:bg-success-surface-default-subtle transition-colors">
                        Accepter
                    </button>
                    <button wire:click="rejectSelected" class="text-xs px-2 py-1 bg-white border border-error-border-default text-error-text-link-light rounded hover:bg-error-surface-default-subtle transition-colors">
                        Refuser
                    </button>
                    <button wire:click="deleteSelected" wire:confirm="Supprimer définitivement ?" class="text-xs px-2 py-1 bg-white border border-neutral-300 text-neutral-600 rounded hover:bg-neutral-50 transition-colors">
                        Supprimer
                    </button>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-2 px-1">
            <input type="checkbox" wire:model.live="selectAll" id="adoptionSelectAll"
                   class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500">
            <label for="adoptionSelectAll" class="text-sm text-grayscale-text-subtitle">Tout sélectionner sur cette
                page</label>
        </div>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($this->adoptions as $adoption)
            @php
                $statusConfig = match($adoption->status) {
                    App\Enums\AdoptionRequestStatus::NEW => [
                        'label' => 'Nouvelle', 'badgeType' => 'primary', 'borderColor' => 'border-primary-border-default', 'btnVariant' => 'primary', 'btnText' => 'Traiter'
                    ],
                    App\Enums\AdoptionRequestStatus::PENDING => [
                        'label' => 'En cours', 'badgeType' => 'warning', 'borderColor' => 'border-warning-border-default', 'btnVariant' => 'secondary', 'btnText' => 'Voir le suivi'
                    ],
                    App\Enums\AdoptionRequestStatus::REJECTED => [
                        'label' => 'Refusée', 'badgeType' => 'error', 'borderColor' => 'border-neutral-200', 'btnVariant' => 'ghost', 'btnText' => 'Détails'
                    ],
                    App\Enums\AdoptionRequestStatus::ACCEPTED => [
                        'label' => 'Acceptée', 'badgeType' => 'success', 'borderColor' => 'border-success-border-default', 'btnVariant' => 'secondary', 'btnText' => 'Voir le dossier'
                    ],
                };

                $isSelected = in_array($adoption->id, $selected);
            @endphp

            <article wire:key="adoption-{{ $adoption->id }}"
                     class="bg-white rounded-2xl border transition-all hover:shadow-md overflow-hidden flex flex-col h-full
                     {{ $isSelected ? 'ring-2 ring-primary-border-default ' . $statusConfig['borderColor'] : $statusConfig['borderColor'] }}">

                <div class="flex items-center justify-between py-3 px-4 bg-neutral-50 border-b border-neutral-100">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" wire:model.live="selected" value="{{ $adoption->id }}"
                               class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500 border-neutral-300 cursor-pointer">

                        <x-admin.status-badge
                            :status="$statusConfig['label']"
                            :type="$statusConfig['badgeType']"
                        />
                    </div>
                    <span class="text-xs font-medium text-grayscale-text-caption">
                        {{ $adoption->created_at->format('d/m/Y') }}
                    </span>
                </div>

                <div class="p-6 flex-1 flex flex-col {{ $isSelected ? 'bg-primary-surface-default-subtle/30' : '' }}">
                    <div class="flex items-center gap-4 mb-6">
                        <img
                            src="{{ $adoption->pet->thumbnail_url }}"
                            alt="{{ $adoption->pet->name }}"
                            class="w-14 h-14 rounded-xl object-cover bg-neutral-100 border border-neutral-200"
                        >
                        <div>
                            <h3 class="text-lg font-bold text-grayscale-text-title leading-tight">{{ $adoption->pet->name }}</h3>
                            <p class="text-sm text-grayscale-text-subtitle">{{ $adoption->pet->breed->name ?? 'Race inconnue' }}</p>
                        </div>
                    </div>

                    <div class="mb-4 space-y-1">
                        <p class="text-xs font-bold uppercase tracking-wider text-grayscale-text-caption">Candidat</p>
                        <p class="text-base font-bold text-grayscale-text-body">{{ $adoption->full_name }}</p>
                        <p class="text-sm text-grayscale-text-subtitle truncate" title="{{ $adoption->email }}">{{ $adoption->email }}</p>
                    </div>

                    <div class="flex-1"></div>

                    <div class="mb-6 pt-4 border-t border-neutral-100">
                        <p class="text-xs text-grayscale-text-subtitle flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $adoption->processor?->full_name ? 'Traité par ' . $adoption->processor->full_name : 'Pas encore traitée' }}
                        </p>
                    </div>

                    <x-cta-button
                        :href="route('adoptions.show', $adoption)"
                        :variant="$statusConfig['btnVariant']"
                        class="w-full justify-center"
                    >
                        {{ $statusConfig['btnText'] }}
                    </x-cta-button>
                </div>
            </article>
        @empty
            <div class="col-span-full py-12 text-center text-grayscale-text-subtitle bg-white rounded-xl border border-neutral-200">
                <svg class="w-12 h-12 mx-auto mb-4 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-lg font-medium">Aucune demande trouvée</p>
            </div>
        @endforelse
    </div>

    @if($this->adoptions->hasPages())
        <div class="flex justify-center pt-6">
            {{ $this->adoptions->onEachSide(1)->links('vendor.pagination.livewire-custom-orange') }}
        </div>
    @endif
</div>

