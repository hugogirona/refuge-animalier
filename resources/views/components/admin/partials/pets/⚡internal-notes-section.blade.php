<?php

use App\Models\InternalNote;
use App\Models\Pet;
use Livewire\Component;

new class extends Component {
    public Pet $pet;
    public string $content = '';

    public function mount(Pet $pet): void
    {
        $this->pet = $pet;
    }

    public function getNotesProperty()
    {
        return $this->pet->internalNotes()
            ->with('user')
            ->latest()
            ->get();
    }

    public function addNote(): void
    {
        $this->validate(['content' => 'required|string|min:10']);

        $this->pet->internalNotes()->create([
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);

        $this->content = '';

    }

    public function deleteNote($id): void
    {
        $note = InternalNote::find($id);

        if (($note && $note->user_id === auth()->id()) || auth()->user()->isAdmin()) {
            $note->delete();
        }
    }
};

?>

<section class="bg-white rounded-xl border border-neutral-200 p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold">Notes internes ({{ $this->notes->count() }})</h2>
    </div>

    <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
        @forelse($this->notes as $note)
            <x-admin.partials.pets.internal-notes-item
                :author="$note->user->full_name"
                :time="$note->created_at->diffForHumans()"
                wire:click="deleteNote({{ $note->id }})"
            >
                {{ $note->content }}
            </x-admin.partials.pets.internal-notes-item>
        @empty
            <p class="text-sm text-neutral-500 italic">Aucune note pour le moment.</p>
        @endforelse
    </div>

    <form wire:submit="addNote" class="flex gap-4 pt-4 border-t border-neutral-200">

        <img
            src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->full_name) }}"
            alt="{{ auth()->user()->full_name }}"
            class="w-12 h-12 rounded-full shrink-0 bg-neutral-100"
        >

        <div class="flex-1">

            <x-form.form-textarea
                name="content"
                wire:model="content"
                :label="auth()->user()->full_name"
                placeholder="Ajouter une note..."
                rows="2"
                :error="$errors->first('content')"
            />

            <div class="mt-3 flex justify-end">
                <x-cta-button
                    size="sm"
                    role="button"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Ajouter</span>
                    <span wire:loading>Envoi...</span>
                </x-cta-button>
            </div>
        </div>
    </form>
</section>
