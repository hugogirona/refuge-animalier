<?php

use Livewire\Component;

new class extends Component {
    public array $users = [];

    public function mount(): void
    {
        abort_unless(auth()->user()->isAdmin(), 403, 'Accès réservé aux administrateurs');

        $this->users = [
            [
                'id' => 1,
                'photo_url' => 'https://i.pravatar.cc/150?img=1',
                'first_name' => 'Élise',
                'last_name' => 'Dubois',
                'email' => 'elise.dubois@email.com',
                'role' => 'admin',
                'active' => true,
                'last_connection' => 'Il y a 1h',
                'contribution' => '45 fiches',
            ],
            [
                'id' => 2,
                'photo_url' => 'https://i.pravatar.cc/150?img=5',
                'first_name' => 'Marc',
                'last_name' => 'Laurent',
                'email' => 'marc.laurent@email.com',
                'role' => 'volunteer',
                'active' => true,
                'last_connection' => 'Il y a 3h',
                'contribution' => '28 fiches',
            ],
            [
                'id' => 3,
                'photo_url' => 'https://i.pravatar.cc/150?img=9',
                'first_name' => 'Sophie',
                'last_name' => 'Martin',
                'email' => 'sophie.martin@email.com',
                'role' => 'admin',
                'active' => true,
                'last_connection' => 'Il y a 2 jours',
                'contribution' => '67 fiches',
            ],
            [
                'id' => 4,
                'photo_url' => 'https://i.pravatar.cc/150?img=12',
                'first_name' => 'Thomas',
                'last_name' => 'Petit',
                'email' => 'thomas.petit@email.com',
                'role' => 'volunteer',
                'active' => false,
                'last_connection' => 'Il y a 1 semaine',
                'contribution' => '12 fiches',
            ],
            [
                'id' => 5,
                'photo_url' => 'https://i.pravatar.cc/150?img=20',
                'first_name' => 'Julie',
                'last_name' => 'Rousseau',
                'email' => 'julie.rousseau@email.com',
                'role' => 'volunteer',
                'active' => true,
                'last_connection' => 'Il y a 5h',
                'contribution' => '34 fiches',
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
            Utilisateurs
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <div>
        <x-admin.partials.title-header
            title="Gestion des utilisateurs"
            subtitle="12 bénévoles enregistrés"
            buttonHref="#"
            buttonLabel="Créer un utilisateur"
            buttonIcon="plus"
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
            <livewire:admin.partials.users.users-list :users="$users" />

        </template>

        {{-- Desktop: Table --}}
        <template x-if="isDesktop">
            <livewire:admin.partials.users.users-table :users="$users" />
        </template>
    </div>
</main>
