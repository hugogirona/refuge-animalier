<?php

use App\Models\Pet;
use Livewire\Component;

new class extends Component {
    public int $pets_count = 0;

    public function mount(): void
    {
        $this->pets_count = Pet::count();
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
            :subtitle="$this->pets_count . ' ' . 'animaux disponibles'"
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
            <livewire:admin.partials.pets.pets-list/>
        </template>

        {{-- Desktop: Table --}}
        <template x-if="isDesktop">
            <livewire:admin.partials.pets.pets-table/>
        </template>
    </div>

</main>
