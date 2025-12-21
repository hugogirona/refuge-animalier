<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public ?string $current = null;
    public string $key = '';
    public ?string $model_id = null;

    #[On('open_modal')]
    public function open(string $form, ?string $model_id = null): void
    {
        $this->current = $form;
        $this->model_id = $model_id;
        $this->key = uniqid();
    }

    #[On('close_modal')]
    public function close(): void
    {
        $this->current = null;
        $this->model_id = null;
    }

};
?>

<div
    x-data="{ show: @entangle('current').live }"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-9999 overflow-hidden"
    style="display: none;"
>
    <div
        class="fixed inset-y-0 right-0 w-full md:w-2/3 lg:w-1/2 xl:w-2/5 bg-white shadow-2xl overflow-y-auto"
        x-show="show"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        @click.away="$wire.close()"
    >
        <div class="sticky top-0 right-0 p-4 flex justify-end bg-white border-b border-neutral-200 z-10">
            <button
                wire:click="close"
                class="text-neutral-500 hover:text-neutral-700 transition-colors"
                aria-label="Fermer"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        @if(!is_null($current))
            <livewire:is :component="$current" :key="$key" :model_id="$model_id"/>
        @endif
    </div>
</div>
