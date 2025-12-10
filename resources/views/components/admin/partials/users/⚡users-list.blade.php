<?php

use Livewire\Component;

new class extends Component
{
    public array $users = [];

    public function mount(array $users): void
    {
        $this->users = $users;
    }
};
?>

<div class="flex flex-col gap-4 mb-12">

    <div class="bg-transparent">
        <div class="lg:max-w-xl mr-auto py-4 flex flex-col gap-3">
            <x-search-filter.search-bar placeholder="Rechercher un animal..."/>
        </div>
    </div>

    @foreach($users as $user)
        <article class="bg-white rounded-xl border border-neutral-200 p-4 hover:shadow-md transition-shadow cursor-pointer"
                 x-data="{ checked: false }">
            <div class="flex items-center gap-4">

                {{-- Checkbox --}}
                <div class="shrink-0 pt-1" @click="checked = !checked">
                    <input
                        type="checkbox"
                        value="{{ $user['id'] }}"
                        class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-500"
                        x-model="checked"
                    >
                </div>

                {{-- Photo --}}
                <div class="shrink-0">
                    <img
                        src="{{ $user['photo_url'] }}"
                        alt="{{ $user['first_name'] . ' ' . $user['last_name'] }}"
                        class="w-16 h-16 rounded-full object-cover"
                    >
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    {{-- Header --}}
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-lg font-semibold text-grayscale-text-title truncate">
                                {{ $user['first_name'] . ' ' . $user['last_name'] }}
                            </h2>
                            <p class="text-sm text-neutral-600">
                                {{ $user['email'] }}
                            </p>
                        </div>

                        {{-- Actions Menu --}}
                        <x-admin.table.action-menu
                            :editHref="'#'"
                            deleteAction="alert('Supprimer')"
                            deleteMessage="Êtes-vous sûr de vouloir supprimer cette demande ?"
                        />
                    </div>

                    {{-- Badges --}}
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        @if($user['role'] === 'admin')
                            <x-admin.status-badge status="Administrateur" type="primary"/>
                        @elseif($user['role'] === 'volunteer')
                            <x-admin.status-badge status="Bénévole" type="secondary"/>
                        @endif

                            @if($user['active'] === true)
                                <x-admin.status-badge status="Actif" type="success"/>
                            @else
                                <x-admin.status-badge status="Inactif" type="default"/>
                            @endif
                    </div>

                    {{-- Footer --}}
                    <p class="text-xs text-grayscale-text-caption">
                        Dernière connexion : {{ $user['last_connection'] }}
                    </p>
                </div>

            </div>
        </article>
    @endforeach

</div>
