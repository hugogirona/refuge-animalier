<?php

use Livewire\Component;

new class extends Component {
    public array $adoptions = [];

    public function mount(): void
    {
        $this->adoptions = [
            [
                'id' => 1,
                'photo_url' => 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=400',
                'pet_name' => 'Moka',
                'pet_breed' => 'Caniche',
                'adopter_name' => 'Sarah Martin',
                'adopter_email' => 'sarah.martin@email.com',
                'created_at' => '15/06/2024',
                'status' => 'accepted',
                'last_action' => 'Il y a 1h',
            ],
            [
                'id' => 2,
                'photo_url' => 'https://images.unsplash.com/photo-1574158622682-e40e69881006?w=400',
                'pet_name' => 'Félix',
                'pet_breed' => 'Chat Européen',
                'adopter_name' => 'Jean Dupont',
                'adopter_email' => 'jean.dupont@email.com',
                'created_at' => '14/06/2024',
                'status' => 'new',
                'last_action' => 'Il y a 2h',
            ],
            [
                'id' => 3,
                'photo_url' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=400',
                'pet_name' => 'Luna',
                'pet_breed' => 'Labrador',
                'adopter_name' => 'Marie Leblanc',
                'adopter_email' => 'marie.leblanc@email.com',
                'created_at' => '13/06/2024',
                'status' => 'pending',
                'last_action' => 'Il y a 5h',
            ],
            [
                'id' => 5,
                'photo_url' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400',
                'pet_name' => 'Max',
                'pet_breed' => 'Berger Allemand',
                'adopter_name' => 'Sophie Bernard',
                'adopter_email' => 'sophie.bernard@email.com',
                'created_at' => '11/06/2024',
                'status' => 'refused',
                'last_action' => 'Il y a 2 jours',
            ],
            [
                'id' => 6,
                'photo_url' => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400',
                'pet_name' => 'Minou',
                'pet_breed' => 'Persan',
                'adopter_name' => 'Thomas Petit',
                'adopter_email' => 'thomas.petit@email.com',
                'created_at' => '10/06/2024',
                'status' => 'pending',
                'last_action' => 'Il y a 3 jours',
            ],
        ];
    }
}

?>

<main class="flex-1">
    <x-admin.partials.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('dashboard.index') }}">
            Tableau de bord
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            Adoptions
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <div>
        <x-admin.partials.title-header
            title="Gestion des adoptions"
            subtitle="12 demandes au total"
        />
    </div>

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
            <livewire:admin.partials.adoptions.adoptions-list :adoptions="$adoptions" />
        </template>

        {{-- Desktop: Table --}}
        <template x-if="isDesktop">
            <livewire:admin.partials.adoptions.adoptions-table :adoptions="$adoptions" />
        </template>
    </div>
</main>
