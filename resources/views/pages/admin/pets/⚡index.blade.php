<?php

use Livewire\Component;

new class extends Component {
    public array $pets = [];

    public function mount(): void
    {
        $this->pets = [
            [
                'id' => 1,
                'nom' => 'Moka',
                'espece' => 'Chien',
                'race' => 'Caniche',
                'photo_url' => 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=200',
                'statut' => 'Disponible',
                'statut_publication' => 'Oui',
                'date_arrivee' => '15/06/2024',
                'createur' => 'Élise D.',
            ],
            [
                'id' => 2,
                'nom' => 'Luna',
                'espece' => 'Chat',
                'race' => 'Persan',
                'photo_url' => 'https://images.unsplash.com/photo-1574158622682-e40e69881006?w=200',
                'statut' => 'Disponible',
                'statut_publication' => 'Oui',
                'date_arrivee' => '20/06/2024',
                'createur' => 'Thomas B.',
            ],
            [
                'id' => 3,
                'nom' => 'Tango',
                'espece' => 'Chat',
                'race' => 'Européen',
                'photo_url' => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=200',
                'statut' => 'En soins',
                'statut_publication' => 'Non',
                'date_arrivee' => '10/06/2024',
                'createur' => 'Élise D.',
            ],
            [
                'id' => 4,
                'nom' => 'Rex',
                'espece' => 'Chien',
                'race' => 'Berger Allemand',
                'photo_url' => 'https://images.unsplash.com/photo-1568572933382-74d440642117?w=200',
                'statut' => 'Disponible',
                'statut_publication' => 'Oui',
                'date_arrivee' => '05/06/2024',
                'createur' => 'Thomas B.',
            ],
            [
                'id' => 5,
                'nom' => 'Bella',
                'espece' => 'Chien',
                'race' => 'Labrador',
                'photo_url' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=200',
                'statut' => 'Adopté',
                'statut_publication' => 'Non',
                'date_arrivee' => '01/06/2024',
                'createur' => 'Chloé M.',
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
            Animaux
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <div>
        <x-admin.partials.title-header
            title="Gestion des animaux"
            subtitle="23 animaux disponibles"
            buttonHref="#"
            buttonLabel="Ajouter un animal"
            buttonIcon="plus"
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
            <livewire:admin.partials.pets.pets-list :pets="$pets" />
        </template>

        {{-- Desktop: Table --}}
        <template x-if="isDesktop">
            <livewire:admin.partials.pets.pets-table />
        </template>
    </div>

</main>
