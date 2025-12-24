@props([
    'editAction' => null,
    'deleteAction' => null,
    'deleteMessage' => 'Êtes-vous sûr de vouloir supprimer cet élément ?',
])

<div
    class="relative"
    x-data="{ open: false }"
    x-init="$watch('open', value => value && $dispatch('close-other-menus', $el))"
    @close-other-menus.window="if ($event.detail !== $el) open = false"
    @click.away="open = false"
    @keydown.escape.window="open = false"
>

    <button
        @click="open = !open"
        class="inline-flex items-center justify-center text-neutral-400 hover:text-grayscale-text-subtitle p-1 rounded hover:bg-neutral-100 transition"
    >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
        </svg>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute overflow-hidden right-0 mt-2 w-48 bg-white rounded-lg shadow-md border border-neutral-200 z-50"
        style="display: none;"
    >

        @if($editAction)
            <button
                wire:click="{{ $editAction }}"
                @click="open = false"
                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-grayscale-text-subtitle bg-white hover:bg-neutral-50 transition text-left"
            >
                <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span>Éditer</span>
            </button>
        @endif

        @if( $editAction && $deleteAction)
            <div class="border-t border-neutral-200"></div>
        @endif

        @if($deleteAction)
            <button
                wire:click="{{ $deleteAction }}"
                wire:confirm="{{ $deleteMessage }}"
                @click="open = false"
                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-error-text-link-light bg-white hover:bg-error-surface-default-subtle transition text-left"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                <span>Supprimer</span>
            </button>
        @endif

        {{ $slot }}
    </div>
</div>
