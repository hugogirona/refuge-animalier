<?php

use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';
    public string $sortCol = 'arrived_at';
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
            $this->selected = $this->pets->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function updatedSelected(): void
    {
        $this->selectAll = false;
    }

    public function edit($id): void
    {
        $this->dispatch('open_modal',
            form: 'admin.partials.pets.form',
            model_id: (string)$id
        );
    }

    public function show($id): void
    {
        $this->redirect(route('admin-pets.show', $id), navigate: true);
    }

    public function delete($id): void
    {
        Pet::find($id)?->delete();
    }

    public function deleteSelected(): void
    {
        Pet::whereIn('id', $this->selected)->delete();
        $this->selected = [];
    }

    public function unpublishSelected(): void
    {
        Pet::whereIn('id', $this->selected)->update(['is_published' => false]);
        $this->selected = [];
    }

    public function publishSelected(): void
    {
        Pet::whereIn('id', $this->selected)->update(['is_published' => true]);
        $this->selected = [];
    }

    #[On('pet-saved')]
    public function refreshPets(): void
    {
        unset($this->pets);
    }

    #[Computed]
    public function pets(): LengthAwarePaginator
    {
        return Pet::query()
            ->with(['breed', 'creator'])
            ->when($this->search, function (Builder $q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('breed', function ($breedQuery) {
                            $breedQuery->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(6);
    }
};
?>

<div class="mb-12 flex flex-col gap-4"
     >

    <div class="bg-transparent flex flex-col gap-3">
        <div class="lg:max-w-xl mr-auto pt-4 w-full">
            <x-search-filter.search-bar
                wire:model.live.debounce.300ms="search"
                placeholder="Rechercher par nom, email ou animal..."
            />
        </div>

        @if(count($selected) > 0)
            <div
                class="flex items-center justify-between bg-primary-surface-default-subtle border border-primary-border-default px-4 py-2 rounded-lg animate-fade-in">
                <span class="text-sm font-medium text-primary-text-link-light">
                    {{ count($selected) }} sélectionné(s)
                </span>
                <div class="flex gap-2">
                    <button wire:click="publishSelected"
                            class="text-xs px-2 py-1 bg-white border border-neutral-300 rounded text-neutral-700">
                        Publier
                    </button>
                    <button wire:click="unpublishSelected"
                            class="text-xs px-2 py-1 bg-white border border-neutral-300 rounded text-neutral-700">
                        Archiver
                    </button>
                    <button wire:click="deleteSelected" wire:confirm="Sûr ?"
                            class="text-xs px-2 py-1 bg-white border border-error-border-default rounded text-error-text-link-light">
                        Supprimer
                    </button>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-2 px-1">
            <input type="checkbox" wire:model.live="selectAll" id="mobileSelectAll"
                   class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500">
            <label for="mobileSelectAll" class="text-sm text-grayscale-text-subtitle">Tout sélectionner sur cette
                page</label>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @forelse($this->pets as $pet)
            <div wire:key="pet-mobile-{{ $pet->id }}"
                 wire:click="show({{ $pet->id }})"
                 class="bg-white rounded-xl border border-neutral-200 p-4 shadow-sm relative {{ in_array($pet->id, $selected) ? 'ring-2 ring-primary-border-default bg-primary-surface-default-subtle' : '' }}">

                <div class="absolute top-4 left-4 z-10">
                    <div @click.stop>
                        <input type="checkbox" wire:model.live="selected" value="{{ $pet->id }}"
                               class="w-5 h-5 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 shadow-sm">
                    </div>
                </div>

                <div class="absolute top-4 right-4 z-10">
                    <div @click.stop>
                        <x-admin.table.action-menu
                            editAction="edit({{ $pet->id }})"
                            deleteAction="delete({{ $pet->id }})"
                            deleteMessage="Voulez-vous vraiment supprimer {{ $pet->name }} ?"
                        />
                    </div>
                </div>

                <div class="flex flex-col items-center text-center mt-6">
                    <img
                        src="{{ $pet->photo_path ? asset('storage/'.$pet->photo_path) : 'https://ui-avatars.com/api/?name='.$pet->name }}"
                        alt="{{ $pet->name }}"
                        class="w-20 h-20 rounded-full object-cover mb-3 bg-neutral-100 border border-neutral-100"
                    >

                    <h3 class="font-bold text-lg text-grayscale-text-title">{{ $pet->name }}</h3>
                    <p class="text-sm text-grayscale-text-subtitle mb-2">{{ $pet->breed->name ?? 'Inconnue' }}</p>

                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <x-admin.status-badge :status="$pet->status->value" :type="$pet->status->color() ?? 'default'"/>
                        <x-admin.status-badge :status="$pet->is_published ? 'Publié' : 'Non publié'"
                                              :type="$pet->is_published ? 'success' : 'default'"/>
                    </div>

                    <div
                        class="w-full pt-3 border-t border-neutral-100 flex justify-between text-xs text-grayscale-text-caption">
                        <span>Arrivée: {{ $pet->arrived_at?->format('d/m/Y') ?? '-' }}</span>
                        <span>Par: {{ $pet->creator->first_name }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8 text-grayscale-text-subtitle">
                Aucun animal trouvé.
            </div>
        @endforelse
    </div>

    @if($this->pets->hasPages())
        <div class="mt-4 flex w-full justify-center">
            {{ $this->pets->onEachSide(0)->links('vendor.pagination.livewire-custom-orange') }}
        </div>
    @endif
</div>

