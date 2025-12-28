<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {
    public int $users_count = 0;

    public function mount(): void
    {
        $this->authorize('viewAny', User::class);

        $this->users_count = User::count();
    }

    public function create(): void
    {

        $this->dispatch('open_modal',
            form: 'admin.partials.users.form',
            model_id: null
        );
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
            subtitle="12 "
            :subtitle="$this->users_count . ' ' . 'bénévoles enregistrés'"
            buttonLabel="Ajouter un utilisateur"
            buttonAction="create"
            buttonIcon="plus"
        />
    </div>

    <div
        x-data="{
        isDesktop: window.innerWidth >= 1500,
        resizeTimer: null,
        init() {
            window.addEventListener('resize', () => {
                clearTimeout(this.resizeTimer)
                this.resizeTimer = setTimeout(() => {
                    this.isDesktop = window.innerWidth >= 1500
                }, 50)
            })
        }
    }"
        class="px-4 md:px-6 max-w-7xl mx-auto"
    >
        {{-- Mobile/Tablet: Cards --}}
        <template x-if="!isDesktop">
            <livewire:admin.partials.users.users-list/>
        </template>

        {{-- Desktop: Table --}}
        <template x-if="isDesktop">
            <livewire:admin.partials.users.users-table />
        </template>
    </div>
</main>
