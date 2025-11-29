<?php

use Livewire\Component;

new class extends Component
{
    public array $messages = [];

    public function mount(array $messages): void
    {
        $this->messages = $messages;
    }
};
?>

<div class="mb-12">
    {{-- Search Bar (non fonctionnelle pour l'instant) --}}
    <div class=" z-20 bg-transparent">
        <div class="lg:max-w-xl mr-auto py-4 flex flex-col gap-3">
            <x-search-filter.search-bar placeholder="Rechercher un message..."/>
        </div>
    </div>

    {{-- Table --}}

    <x-admin.table.table>
        <x-admin.table.thead>
            <x-admin.table.tr>
                <x-admin.table.th class="w-12">
                    <input
                        type="checkbox"
                        class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500"
                        @click="selectAll = !selectAll"
                    >
                </x-admin.table.th>
                <x-admin.table.th class="w-16">Statut</x-admin.table.th>
                <x-admin.table.th sortable>Expéditeur</x-admin.table.th>
                <x-admin.table.th>Sujet</x-admin.table.th>
                <x-admin.table.th sortable>Date</x-admin.table.th>
                <x-admin.table.th class="w-20">Actions</x-admin.table.th>
            </x-admin.table.tr>
        </x-admin.table.thead>

        <x-admin.table.tbody>
            @forelse($messages as $message)
                <x-admin.table.tr>
                    <x-admin.table.td
                        class="cursor-pointer"
                        x-data="{ checked: false }"
                        @click="checked = !checked">
                        <input
                            type="checkbox"
                            value="{{ $message['id'] }}"
                            x-model="checked"
                            class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500"
                        >
                    </x-admin.table.td>

                    <x-admin.table.td>
                        @if($message['opened'])
                            {{-- Message ouvert (enveloppe ouverte) --}}
                            <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" title="Lu">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                            </svg>
                        @else
                            {{-- Message non lu (enveloppe fermée) --}}
                            <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 24 24" title="Non lu">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <span class="font-semibold text-grayscale-text-title {{ !$message['opened'] ? 'font-bold' : '' }}">
                            {{ $message['expeditor'] }}
                        </span>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <p class="text-grayscale-text-subtitle text-sm {{ !$message['opened'] ? 'font-semibold' : '' }}">
                            {{ $message['subject'] }}
                        </p>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <span class="{{ !$message['opened'] ? 'font-semibold' : '' }}">
                            {{ $message['date'] }}
                        </span>
                    </x-admin.table.td>

                    <x-admin.table.td>
                        <x-admin.table.action-menu
                            deleteAction="alert('Supprimer')"
                            deleteMessage="Êtes-vous sûr de vouloir supprimer ce message ?"
                        />
                    </x-admin.table.td>

                </x-admin.table.tr>
            @empty
                <x-admin.table.tr>
                    <x-admin.table.td colspan="6" class="text-center py-12">
                        <div class="text-grayscale-text-subtitle">
                            <svg class="w-12 h-12 mx-auto mb-4 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-lg font-medium">Aucun message trouvé</p>
                        </div>
                    </x-admin.table.td>
                </x-admin.table.tr>
            @endforelse
        </x-admin.table.tbody>
    </x-admin.table.table>
</div>
