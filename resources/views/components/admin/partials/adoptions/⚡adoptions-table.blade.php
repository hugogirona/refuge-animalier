<?php

use App\Enums\PetStatus;
use App\Models\AdoptionRequest;
use App\Enums\AdoptionRequestStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';
    public string $sortCol = 'created_at';
    public bool $sortAsc = false;

    public array $selected = [];
    public bool $selectAll = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPage($page): void
    {
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->selected = $this->adoptions->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function updatedSelected(): void
    {
        $this->selectAll = false;
    }

    public function show($id): void
    {
        $this->redirect(route('adoptions.show', $id), navigate: true);
    }

    public function delete($id): void
    {
        $request = AdoptionRequest::find($id);
        if ($request) {
            $request->delete();
        }
        $this->dispatch('adoption-updated');
    }

    public function deleteSelected(): void
    {
        AdoptionRequest::whereIn('id', $this->selected)->delete();
        $this->dispatch('adoption-updated');
        $this->resetSelection();
    }

    public function acceptSelected(): void
    {
        $requests = AdoptionRequest::with('pet')->whereIn('id', $this->selected)->get();

        foreach ($requests as $request) {
            $request->update([
                'status' => AdoptionRequestStatus::ACCEPTED,
                'adopted_at' => now(),
                'processed_by' => auth()->id(),
            ]);

            if ($request->pet) {
                $request->pet->update([
                    'status' => PetStatus::ADOPTED,
                    'is_published' => false
                ]);
            }
        }

        $this->dispatch('adoption-updated');
        $this->dispatch('pet-updated');
        $this->resetSelection();
    }


    public function rejectSelected(): void
    {
        $requests = AdoptionRequest::with('pet')->whereIn('id', $this->selected)->get();

        foreach ($requests as $request) {
            $request->update([
                'status' => AdoptionRequestStatus::REJECTED,
                'adopted_at' => null,
                'processed_by' => auth()->id(),
            ]);

            if ($request->pet && $request->pet->status === PetStatus::ADOPTION_PENDING) {
                $request->pet->update([
                    'status' => PetStatus::AVAILABLE
                ]);
            }
        }

        $this->dispatch('adoption-updated');
        $this->dispatch('pet-updated');
        $this->resetSelection();
    }


    private function resetSelection(): void
    {
        $this->selected = [];
        $this->selectAll = false;
    }

    public function sortBy(string $column): void
    {
        if ($this->sortCol === $column) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortCol = $column;
            $this->sortAsc = true;
        }
    }

    #[On('adoption-request-updated')]
    public function refreshRequests(): void
    {
        unset($this->adoptions);
    }

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
            ->orderByRaw("status = 'new' DESC")
            ->orderBy($this->sortCol, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(5);
    }
};
?>


<div class="mb-12">
    <div class="flex flex-col md:flex-row justify-between items-center py-4 gap-4">
        <div class="w-full lg:max-w-xl">
            <x-search-filter.search-bar
                wire:model.live.debounce.300ms="search"
                placeholder="Rechercher par nom, email ou animal..."
            />
        </div>

        @if(count($selected) > 0)
            <div
                class="flex items-center gap-2 bg-primary-surface-default-subtle border border-primary-border-default px-4 py-2 rounded-lg animate-fade-in">
                <span class="text-sm font-medium text-primary-text-link-light">
                    {{ count($selected) }} sélectionné(s)
                </span>

                <button
                    wire:click="acceptSelected"
                    class="text-sm px-3 py-1 bg-white border border-neutral-300 rounded hover:bg-neutral-50 text-neutral-700 transition-colors"
                >
                    Accepter
                </button>

                <button
                    wire:click="rejectSelected"
                    class="text-sm px-3 py-1 bg-white border border-neutral-300 rounded hover:bg-neutral-50 text-neutral-700 transition-colors"
                >
                    Refuser
                </button>

                <button
                    wire:click="deleteSelected"
                    wire:confirm="Êtes-vous sûr de vouloir supprimer ces demandes ?"
                    class="text-sm px-3 py-1 bg-white border border-error-border-default rounded hover:bg-error-surface-default text-error-text-link-light hover:text-white transition-colors"
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

                <x-admin.table.th>Animal</x-admin.table.th>
                <x-admin.table.th>Adoptant</x-admin.table.th>

                <x-admin.table.th
                    sortable
                    wire:click="sortBy('created_at')"
                    class="cursor-pointer hover:text-primary-600 transition-colors group"
                >
                    Date
                </x-admin.table.th>

                <x-admin.table.th>Statut</x-admin.table.th>
                <x-admin.table.th>Traité par</x-admin.table.th>
                <x-admin.table.th class="w-20">Actions</x-admin.table.th>
            </x-admin.table.tr>
        </x-admin.table.thead>

        <x-admin.table.tbody>
            @forelse($this->adoptions as $adoption)
                <x-admin.table.tr
                    wire:key="adoption-{{ $adoption->id }}"
                    wire:click="show({{ $adoption->id }})"
                    class="cursor-pointer hover:bg-neutral-50 transition-colors {{ in_array($adoption->id, $selected) ? 'bg-primary-surface-default-subtle' : '' }}"
                >
                    <x-admin.table.td>
                        <div @click.stop>
                            <input
                                type="checkbox"
                                wire:model.live="selected"
                                value="{{ $adoption->id }}"
                                class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer"
                            >
                        </div>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ $adoption->pet->thumbnail_url }}"
                                alt="{{ $adoption->pet->name }}"
                                class="w-12 h-12 rounded-lg object-cover bg-neutral-100"
                            >
                            <div class="flex flex-col">
                                <p class="font-semibold text-grayscale-text-title">{{ $adoption->pet->name }}</p>
                                <p class="text-sm text-grayscale-text-subtitle">{{ $adoption->pet->breed->name ?? 'Race inconnue' }}</p>
                            </div>
                        </div>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <p class="font-semibold text-grayscale-text-title">{{ $adoption->full_name }}</p>
                        <p class="text-sm text-grayscale-text-subtitle">{{ $adoption->email }}</p>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $adoption->created_at->format('d/m/Y H:i') }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        @php
                            $statusConfig = match($adoption->status) {
                                AdoptionRequestStatus::ACCEPTED => ['label' => 'Acceptée', 'type' => 'success'],
                                AdoptionRequestStatus::NEW => ['label' => 'Nouvelle', 'type' => 'primary'],
                                AdoptionRequestStatus::PENDING => ['label' => 'En attente', 'type' => 'warning'],
                                AdoptionRequestStatus::REJECTED => ['label' => 'Refusée', 'type' => 'error'],
                                default => ['label' => 'Inconnu', 'type' => 'default'],
                            };
                        @endphp
                        <x-admin.status-badge
                            :status="$statusConfig['label']"
                            :type="$statusConfig['type']"
                        />
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $adoption->processor->full_name ?? '-' }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <div @click.stop>
                            <x-admin.table.action-menu
                                viewAction="show({{ $adoption->id }})"
                                deleteAction="delete({{ $adoption->id }})"
                                deleteMessage="Voulez-vous vraiment supprimer cette demande d'adoption de {{ $adoption->full_name }} ?"
                            />
                        </div>
                    </x-admin.table.td>

                </x-admin.table.tr>
            @empty
                <x-admin.table.tr>
                    <x-admin.table.td colspan="7" class="text-center py-12">
                        <div class="text-grayscale-text-subtitle">
                            <svg class="w-12 h-12 mx-auto mb-4 text-neutral-300" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-lg font-medium">Aucune adoption trouvée</p>
                        </div>
                    </x-admin.table.td>
                </x-admin.table.tr>
            @endforelse
        </x-admin.table.tbody>
    </x-admin.table.table>

    @if($this->adoptions->hasPages())
        <div class="mt-4 flex w-full justify-center">
            {{ $this->adoptions->onEachSide(1)->links('vendor.pagination.livewire-custom-orange') }}
        </div>
    @endif

</div>
