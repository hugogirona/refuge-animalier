<?php

use Livewire\Component;

new class extends Component {
    public array $messages = [];

    public function mount(): void
    {
        $this->messages = [
            [
                'id' => 1,
                'opened' => false,
                'expeditor' => 'Sarah Martin',
                'subject' => 'Demande d\'information sur l\'adoption de Moka',
                'date' => '28 nov. 2024',
            ],
            [
                'id' => 2,
                'opened' => true,
                'expeditor' => 'Jean Dupont',
                'subject' => 'Question sur les horaires de visite',
                'date' => '27 nov. 2024',
            ],
            [
                'id' => 3,
                'opened' => false,
                'expeditor' => 'Marie Leblanc',
                'subject' => 'Proposition de bénévolat',
                'date' => '26 nov. 2024',
            ],
            [
                'id' => 4,
                'opened' => true,
                'expeditor' => 'Pierre Rousseau',
                'subject' => 'Suivi de ma demande d\'adoption',
                'date' => '25 nov. 2024',
            ],
            [
                'id' => 5,
                'opened' => true,
                'expeditor' => 'Sophie Bernard',
                'subject' => 'Remerciements pour l\'accueil',
                'date' => '24 nov. 2024',
            ],
            [
                'id' => 6,
                'opened' => false,
                'expeditor' => 'Thomas Petit',
                'subject' => 'Question sur les frais d\'adoption',
                'date' => '23 nov. 2024',
            ],
        ];

    }
};
?>

<main class="flex-1">
    <x-admin.partials.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('dashboard.index') }}">
            Tableau de bord
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            Messages
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <div>
        <x-admin.partials.title-header
            title="Messages reçus"
            subtitle="9 messages au total"
            badgeStatus="2 non lus"
            badgeType="secondary"
        />
    </div>

    {{-- Responsive Container --}}
    <div
        x-data="{
        isDesktop: window.innerWidth >= 1350,
        resizeTimer: null,
        init() {
            window.addEventListener('resize', () => {
                clearTimeout(this.resizeTimer)
                this.resizeTimer = setTimeout(() => {
                    this.isDesktop = window.innerWidth >= 1350
                }, 50)
            })
        }
    }"
        class="px-4 md:px-6 max-w-7xl mx-auto"
    >
        {{-- Mobile/Tablet: Cards --}}
        <template x-if="!isDesktop">
            @livewire('admin.messages.messages-list', ['messages' => $messages])
        </template>

        {{-- Desktop: Table --}}
        <template x-if="isDesktop">
            @livewire('admin.messages.messages-table', ['messages' => $messages])
        </template>
    </div>
</main>
