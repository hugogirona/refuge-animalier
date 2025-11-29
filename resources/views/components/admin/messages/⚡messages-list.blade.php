<?php

use Livewire\Component;

new class extends Component
{
    public array $messages = [];

    public function mount(array $messages): void
    {
        $this->messages = $messages;
    }

    public function markAsRead($messageId): void
    {
        foreach ($this->messages as &$message) {
            if ($message['id'] === $messageId) {
                $message['opened'] = true;
            }
        }
    }

    public function markAsUnread($messageId): void
    {
        foreach ($this->messages as &$message) {
            if ($message['id'] === $messageId) {
                $message['opened'] = false;
            }
        }
    }

    public function deleteMessage($messageId): void
    {
        $this->messages = array_filter($this->messages, fn($msg) => $msg['id'] !== $messageId);
        session()->flash('success', 'Message supprimé');
    }
};
?>

<div class="space-y-4">
    {{-- Search Bar --}}
    <div class="py-4" role="search" aria-label="Recherche de messages">
        <x-search-filter.search-bar placeholder="Rechercher un message..."/>
    </div>

    {{-- Messages List --}}
    <div aria-label="Liste des messages" class="flex flex-col gap-2">

        @forelse($messages as $message)
            <article
                class="bg-white rounded-xl border border-neutral-200 p-4 hover:shadow-md transition-shadow {{ !$message['opened'] ? 'border-l-4 border-l-primary-600' : '' }}"
                aria-labelledby="message-{{ $message['id'] }}-title"
                aria-describedby="message-{{ $message['id'] }}-subject"
            >
                {{-- Header --}}
                <header class="flex items-start justify-between gap-3 mb-3">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        {{-- Status Icon --}}
                        <div class="flex-shrink-0" aria-hidden="true">
                            @if($message['opened'])
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

                        {{-- Screen reader status --}}
                        <span class="sr-only">
                            {{ $message['opened'] ? 'Message lu' : 'Message non lu' }}
                        </span>

                        {{-- Expeditor --}}
                        <div class="flex-1 min-w-0">
                            <h2
                                id="message-{{ $message['id'] }}-title"
                                class="font-semibold text-grayscale-text-title truncate {{ !$message['opened'] ? 'font-bold' : '' }}"
                            >
                                {{ $message['expeditor'] }}
                            </h2>
                        </div>

                        {{-- Date --}}
                        <time
                            datetime="{{ $message['date'] }}"
                            class="text-xs text-grayscale-text-subtitle whitespace-nowrap {{ !$message['opened'] ? 'font-semibold' : '' }}"
                        >
                            {{ $message['date'] }}
                        </time>
                    </div>

                    {{-- Actions Menu --}}
                    <nav class="flex-shrink-0" aria-label="Actions du message">
                        <div class="relative" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                @click.away="open = false"
                                class="inline-flex items-center justify-center text-neutral-400 hover:text-grayscale-text-subtitle p-1 rounded hover:bg-neutral-100 transition"
                                aria-label="Ouvrir le menu d'actions"
                                aria-expanded="false"
                                :aria-expanded="open.toString()"
                                aria-haspopup="true"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                </svg>
                            </button>

                            <div
                                x-show="open"
                                x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-neutral-200 z-50"
                                @click.away="open = false"
                                role="menu"
                                aria-orientation="vertical"
                                style="display: none;"
                            >
                                <a
                                    href="#"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-grayscale-text-subtitle bg-white hover:bg-neutral-50"
                                    role="menuitem"
                                >
                                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>Voir</span>
                                </a>

                                @if(!$message['opened'])
                                    <button
                                        wire:click="markAsRead({{ $message['id'] }})"
                                        @click="open = false"
                                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-grayscale-text-subtitle bg-white hover:bg-neutral-50"
                                        role="menuitem"
                                    >
                                        <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                                        </svg>
                                        <span>Marquer comme lu</span>
                                    </button>
                                @else
                                    <button
                                        wire:click="markAsUnread({{ $message['id'] }})"
                                        @click="open = false"
                                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-grayscale-text-subtitle bg-white hover:bg-neutral-50"
                                        role="menuitem"
                                    >
                                        <svg class="w-4 h-4 text-neutral-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                        </svg>
                                        <span>Marquer comme non lu</span>
                                    </button>
                                @endif

                                <div class="border-t border-neutral-200" role="separator"></div>

                                <button
                                    wire:click="deleteMessage({{ $message['id'] }})"
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer ce message ?"
                                    @click="open = false"
                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-error-text-link-light bg-white hover:bg-error-surface-default-subtle"
                                    role="menuitem"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span>Supprimer</span>
                                </button>
                            </div>
                        </div>
                    </nav>
                </header>

                {{-- Subject --}}
                <div class="pl-8">
                    <p
                        id="message-{{ $message['id'] }}-subject"
                        class="text-sm text-grayscale-text-subtitle line-clamp-2 {{ !$message['opened'] ? 'font-semibold' : '' }}"
                    >
                        {{ $message['subject'] }}
                    </p>
                </div>

            </article>
        @empty
            <div class="bg-white rounded-xl border border-neutral-200 p-12 text-center" role="status">
                <svg class="w-12 h-12 mx-auto mb-4 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <p class="text-lg font-medium text-grayscale-text-subtitle">Aucun message trouvé</p>
            </div>
        @endforelse
    </div>
</div>
