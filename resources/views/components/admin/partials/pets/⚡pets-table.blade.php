<?php


use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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


    public function deleteSelected(): void
    {
        Pet::whereIn('id', $this->selected)->delete();
        $this->resetSelection();
    }

    public function delete($id): void
    {
        $pet = Pet::find($id);
        if ($pet) {
            $pet->delete();
        }
    }


    public function unpublishSelected(): void
    {
        Pet::whereIn('id', $this->selected)->update(['is_published' => false]);
        $this->resetSelection();
    }

    public function publishSelected(): void
    {
        Pet::whereIn('id', $this->selected)->update(['is_published' => true]);
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

    public function getPetsProperty(): LengthAwarePaginator
    {
        return Pet::query()
            ->with(['breed', 'creator'])
            ->when($this->search, function (Builder $q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('breed', function ($bq) {
                        $bq->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sortCol, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(5);
    }
};
?>

<div class="mb-12">

    <div class="flex flex-col md:flex-row justify-between items-center py-4 gap-4">
        {{-- Search Bar --}}
        <div class="w-full lg:max-w-xl">
            <x-search-filter.search-bar
                wire:model.live.debounce.300ms="search"
                placeholder="Rechercher par nom ou race..."
            />
        </div>

        {{-- ACTIONS DE MASSE (Apparaît si sélection) --}}
        @if(count($selected) > 0)
            <div class="flex items-center gap-2 bg-primary-surface-default-subtle border border-primary-border-default px-4 py-2 rounded-lg animate-fade-in">
                <span class="text-sm font-medium text-primary-text-link-light">
                    {{ count($selected) }} sélectionné(s)
                </span>

                <button wire:click="publishSelected" class="text-sm px-3 py-1 bg-white border border-neutral-300 rounded hover:bg-neutral-50 text-neutral-700 transition-colors">
                    Publier
                </button>

                <button wire:click="unpublishSelected" class="text-sm px-3 py-1 bg-white border border-neutral-300 rounded hover:bg-neutral-50 text-neutral-700 transition-colors">
                    Archiver
                </button>

                <button
                    wire:click="deleteSelected"
                    wire:confirm="Êtes-vous sûr de vouloir supprimer ces animaux ?"
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
                    {{-- Checkbox TOUT SÉLECTIONNER --}}
                    <input
                        type="checkbox"
                        wire:model.live="selectAll"
                        class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer"
                    >
                </x-admin.table.th>

                <x-admin.table.th>Photo</x-admin.table.th>

                <x-admin.table.th
                    sortable
                    wire:click="sortBy('name')"
                    class="cursor-pointer hover:text-primary-600 transition-colors group"
                >
                    Nom
                </x-admin.table.th>

                <x-admin.table.th>Espèce/Race</x-admin.table.th>
                <x-admin.table.th>Statut</x-admin.table.th>
                <x-admin.table.th>Publié</x-admin.table.th>

                {{-- Colonne DATE Triable --}}
                <x-admin.table.th
                    sortable
                    wire:click="sortBy('arrived_at')"
                    class="cursor-pointer hover:text-primary-600 transition-colors group"
                >
                    Date d'arrivée
                </x-admin.table.th>

                <x-admin.table.th>Créé par</x-admin.table.th>
                <x-admin.table.th class="w-20">Actions</x-admin.table.th>
            </x-admin.table.tr>
        </x-admin.table.thead>

        <x-admin.table.tbody>
            @forelse($this->pets as $pet)
                <x-admin.table.tr wire:key="pet-{{ $pet->id }}" class="{{ in_array($pet->id, $selected) ? 'bg-primary-surface-default-subtle' : '' }}">
                    <x-admin.table.td>
                        {{-- Checkbox INDIVIDUELLE --}}
                        <input
                            type="checkbox"
                            wire:model.live="selected"
                            value="{{ $pet->id }}"
                            class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer"
                        >
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <img
                            src="{{ $pet->photo_path ? asset('storage/'.$pet->photo_path) : 'placeholder' }}"
                            alt="{{ $pet->name }}"
                            class="w-12 h-12 rounded-lg object-cover bg-neutral-100"
                        >
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <span class="font-semibold text-grayscale-text-title">{{ $pet->name }}</span>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <div class="text-sm">
                            <div class="font-medium">{{ $pet->species->value }}</div>
                            <div class="text-grayscale-text-subtitle">{{ $pet->breed->name ?? 'Inconnue' }}</div>
                        </div>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <x-admin.status-badge
                            :status="$pet->status->value"
                            :type="$pet->status->color() ?? 'default'"
                        />
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <x-admin.status-badge
                            :status="$pet->is_published ? 'Oui' : 'Non'"
                            :type="$pet->is_published ? 'success' : 'default'"
                        />
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $pet->arrived_at?->format('d/m/Y') ?? '-' }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $pet->creator->full_name ?? 'Système' }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <x-admin.table.action-menu
                            :viewHref="route('admin-pets.show', $pet)"
                            :editHref="'#'"
                            deleteAction="delete({{ $pet->id }})"
                            deleteMessage="Voulez-vous vraiment supprimer {{ $pet->name }} ?"
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
                            <p class="text-lg font-medium">Aucun animal trouvé</p>
                        </div>
                    </x-admin.table.td>
                </x-admin.table.tr>
            @endforelse
        </x-admin.table.tbody>
    </x-admin.table.table>

    @if($this->pets->hasPages())
        <div class="mt-4 flex w-full justify-center">
            {{ $this->pets->onEachSide(1)->links('vendor.pagination.livewire-custom-orange') }}
        </div>
    @endif
</div>

