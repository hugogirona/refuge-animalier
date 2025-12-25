<?php

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    // --- PROPRIÉTÉS ---
    public string $search = '';
    public string $sortCol = 'created_at';
    public bool $sortAsc = false; // Plus récents en premier par défaut

    // --- SÉLECTION ---
    public array $selected = [];
    public bool $selectAll = false;

    // --- LIFECYCLE ---
    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedPage(): void { $this->selected = []; $this->selectAll = false; }

    public function updatedSelectAll($value): void {
        if ($value) {
            $this->selected = $this->messages->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selected = [];
        }
    }
    public function updatedSelected(): void { $this->selectAll = false; }

    // --- TRI ---
    public function sortBy(string $column): void {
        if ($this->sortCol === $column) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortCol = $column;
            $this->sortAsc = true;
        }
    }

    // --- ACTIONS ---
    public function deleteSelected(): void {
        ContactMessage::whereIn('id', $this->selected)->delete();
        $this->dispatch('message-updated');
        $this->selected = [];
    }

    public function markAsReadSelected(): void {
        ContactMessage::whereIn('id', $this->selected)->update([
            'status' => ContactMessageStatus::READ,
            'read_at' => now()
        ]);
        $this->dispatch('message-updated');
        $this->selected = [];
    }

    public function markAsUnreadSelected(): void {
        ContactMessage::whereIn('id', $this->selected)->update([
            'status' => ContactMessageStatus::NEW,
            'read_at' => null
        ]);
        $this->dispatch('message-updated');
        $this->selected = [];
    }

    public function delete($id): void {
        ContactMessage::find($id)?->delete();
        $this->dispatch('message-updated');
    }

    public function show($id): void
    {
        $this->redirect(route('messages.show', $id), navigate: true);
    }

    // --- DONNÉES ---
    #[Computed]
    public function messages(): LengthAwarePaginator
    {
        return ContactMessage::query()
            // Recherche
            ->when($this->search, function (Builder $q) {
                $q->where(function ($sub) {
                    $sub->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('subject', 'like', '%' . $this->search . '%');
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
                placeholder="Rechercher un message..."
            />
        </div>

        {{-- Actions de masse --}}
        @if(count($selected) > 0)
            <div class="flex items-center gap-2 bg-primary-surface-default-subtle border border-primary-border-default px-4 py-2 rounded-lg animate-fade-in">
                <span class="text-sm font-medium text-primary-text-link-light">
                    {{ count($selected) }} sélectionné(s)
                </span>

                <button
                    wire:click="markAsReadSelected"
                    class="text-xs px-2 py-1 bg-white border border-neutral-300 text-neutral-700 rounded hover:bg-neutral-50 transition-colors"
                >
                    Marquer comme lu
                </button>

                <button
                    wire:click="markAsUnreadSelected"
                    class="text-xs px-2 py-1 bg-white border border-neutral-300 text-neutral-700 rounded hover:bg-neutral-50 transition-colors"
                >
                    Marquer non lu
                </button>

                <button
                    wire:click="deleteSelected"
                    wire:confirm="Supprimer ces messages ?"
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
                <x-admin.table.th class="w-16">Statut</x-admin.table.th>
                <x-admin.table.th sortable wire:click="sortBy('name')" class="cursor-pointer hover:text-primary-600 transition-colors">
                    Expéditeur
                </x-admin.table.th>
                <x-admin.table.th>Sujet</x-admin.table.th>
                <x-admin.table.th sortable wire:click="sortBy('created_at')" class="cursor-pointer hover:text-primary-600 transition-colors">
                    Date
                </x-admin.table.th>
                <x-admin.table.th class="w-20">Actions</x-admin.table.th>
            </x-admin.table.tr>
        </x-admin.table.thead>

        <x-admin.table.tbody>
            @forelse($this->messages as $message)
                @php
                    $isUnread = $message->status === ContactMessageStatus::NEW;
                @endphp

                <x-admin.table.tr
                    wire:key="msg-{{ $message->id }}" class="{{ in_array($message->id, $selected) ? 'bg-primary-surface-default-subtle' : '' }}"
                    wire:click="show({{ $message->id }})">

                    {{-- Checkbox --}}
                    <x-admin.table.td>
                        <div @click.stop>
                            <input
                                type="checkbox"
                                wire:model.live="selected"
                                value="{{ $message->id }}"
                                class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer"
                            >
                        </div>
                    </x-admin.table.td>

                    {{-- Icone Statut --}}
                    <x-admin.table.td>
                        @if(!$isUnread)
                            <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" title="Lu">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                            </svg>
                        @else
                            <div class="relative">
                                <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 24 24" title="Nouveau">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <div class="flex flex-col">
                            <span class="text-grayscale-text-title {{ $isUnread ? 'font-bold' : 'font-semibold' }}">
                                {{ $message->name }}
                            </span>
                            <span class="text-xs text-grayscale-text-subtitle">{{ $message->email }}</span>
                        </div>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <p class="text-grayscale-text-subtitle text-sm truncate max-w-xs {{ $isUnread ? 'font-semibold text-grayscale-text-body' : '' }}">
                            {{ $message->subject }}
                        </p>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <span class="{{ $isUnread ? 'font-semibold text-primary-600' : '' }}">
                            {{ $message->created_at->format('d/m/Y') }}
                        </span>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <div @click.stop>
                            <button
                                wire:click="delete({{ $message->id }})"
                                wire:confirm="Supprimer ce message ?"
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
                    <x-admin.table.td colspan="6" class="text-center py-12 text-grayscale-text-subtitle">
                        Aucun message trouvé.
                    </x-admin.table.td>
                </x-admin.table.tr>
            @endforelse
        </x-admin.table.tbody>
    </x-admin.table.table>

    {{-- Pagination --}}
    @if($this->messages->hasPages())
        <div class="mt-4 flex w-full justify-end">
            {{ $this->messages->onEachSide(1)->links('vendor.pagination.livewire-custom-orange', ['itemName' => 'messages']) }}
        </div>
    @endif
</div>

