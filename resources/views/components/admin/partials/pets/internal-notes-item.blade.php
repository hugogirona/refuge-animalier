@props([
    'author',
    'time',
    'avatar' => null,
    'note_id',
    'showDelete' => false
])

<div {{ $attributes->merge(['class' => 'flex gap-4 group']) }}>

    <img
        src="{{ $avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($author).'&background=random' }}"
        alt="{{ $author }}"
        class="w-12 h-12 rounded-full shrink-0 object-cover bg-neutral-100"
    >

    <div class="flex-1">
        <div class="flex items-center justify-between mb-1">
            <div class="flex items-center gap-2">
                <span class="font-semibold text-grayscale-text-title">{{ $author }}</span>
                <span class="text-sm text-grayscale-text-caption">{{ $time }}</span>
            </div>

            @if($showDelete)
                <button type="button"
                        class="text-neutral-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity"
                        title="Supprimer"
                        wire:click="deleteNote({{ $note_id }})"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            @endif
        </div>

        <p class="text-gray-700">
            {{ $slot }}
        </p>
    </div>
</div>
