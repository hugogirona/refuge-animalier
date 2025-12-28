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

    public string $search = '';

    public array $selected = [];
    public bool $selectAll = false;

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

    public function deleteSelected(): void {
        ContactMessage::whereIn('id', $this->selected)->delete();
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

    #[Computed]
    public function messages(): LengthAwarePaginator
    {
        return ContactMessage::query()
            ->when($this->search, function (Builder $q) {
                $q->where(function ($sub) {
                    $sub->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('subject', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(6);
    }
};
?>


<div class="flex flex-col gap-4 mb-12">

    <div class="flex flex-col gap-3">
        <div class="bg-transparent">
            <x-search-filter.search-bar
                wire:model.live.debounce.300ms="search"
                placeholder="Rechercher un message..."
            />
        </div>

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
                    Marquer comme non lu
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

        <div class="flex items-center gap-2 px-1">
            <input type="checkbox" wire:model.live="selectAll" id="selectAllMessages" class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500 border-neutral-300 cursor-pointer">
            <label for="selectAllMessages" class="text-sm text-grayscale-text-subtitle cursor-pointer select-none">
                Tout sélectionner
            </label>
        </div>
    </div>

    <div class="flex flex-col gap-3">
        @forelse($this->messages as $message)
            @php
                $isUnread = $message->status === ContactMessageStatus::NEW;
                $isSelected = in_array($message->id, $selected);
            @endphp

            <article
                wire:key="msg-mobile-{{ $message->id }}"
                wire:click="show({{ $message->id }})"
                class="bg-white rounded-xl border p-4 transition-all hover:shadow-md relative cursor-pointer
                {{ $isSelected ? 'ring-1 ring-primary-border-default bg-primary-surface-default-subtle/30 border-primary-border-default' : 'border-neutral-200' }}
                {{ $isUnread ? 'border-l-4 border-l-primary-600 pl-3' : '' }}"
            >
                <div class="flex items-start gap-3">

                    <div class="shrink-0 pt-1" @click.stop>
                        <input
                            type="checkbox"
                            value="{{ $message->id }}"
                            wire:model.live="selected"
                            class="w-5 h-5 text-primary-600 border-neutral-300 rounded focus:ring-primary-500 cursor-pointer"
                        >
                    </div>

                    <div class="shrink-0 mt-0.5">
                        @if(!$isUnread)
                            <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2 mb-1">
                            <div class="flex-1 min-w-0">
                                <h2 class="text-sm font-semibold text-grayscale-text-title truncate {{ $isUnread ? 'font-bold' : '' }}">
                                    {{ $message->name }}
                                </h2>
                                <time class="text-xs text-grayscale-text-subtitle {{ $isUnread ? 'text-primary-600 font-medium' : '' }}">
                                    {{ $message->created_at->format('d/m/Y') }}
                                </time>
                            </div>

                            <div @click.stop>
                                <div @click.stop>
                                    <button
                                        wire:click="delete({{ $message->id }})"
                                        wire:confirm="Supprimer ce message ?"
                                        class="p-2 text-neutral-400 hover:text-error-text-link-light transition-colors"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <p class="text-sm text-grayscale-text-body line-clamp-1 {{ $isUnread ? 'font-semibold' : '' }}">
                            {{ $message->subject }}
                        </p>
                        <p class="text-xs text-grayscale-text-subtitle line-clamp-2 mt-1">
                            {{ Str::limit($message->content) }}
                        </p>
                    </div>
                </div>
            </article>
        @empty
            <div class="py-12 text-center text-grayscale-text-subtitle bg-white rounded-xl border border-neutral-200">
                <p class="text-lg font-medium">Aucun message trouvé</p>
            </div>
        @endforelse
    </div>

    @if($this->messages->hasPages())
        <div class="flex justify-center pt-4">
            {{ $this->messages->onEachSide(0)->links('vendor.pagination.livewire-custom-orange', ['itemName' => 'messages']) }}
        </div>
    @endif
</div>

