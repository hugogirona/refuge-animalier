<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tableau de bord')]
class extends Component {
    public array $actions = [];

    public function mount(): void
    {
        $this->actions = [
            [
                'label' => 'Vers la gestion des animaux',
                'href' => route('admin-pets.index'),
                'variant' => 'primary',
            ],
            [
                'label' => 'Ajouter un animal',
                'href' => '#',
                'variant' => 'primary',
                'icon' => 'plus',
            ],
            [
                'label' => 'Voir les demandes d\'adoption',
                'href' => route('adoptions.index'),
                'variant' => 'secondary',
            ],
            [
                'label' => 'Gérer les bénévoles',
                'href' => route('users.index'),
                'variant' => 'outline',
            ],
        ];
    }
};
?>
<main class="flex-1">
    <x-admin.partials.breadcrumb>
        <x-breadcrumb.breadcrumb-item current data-last>
            Tableau de bord
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <x-admin.partials.title-header
        title="Tableau de bord"
        subtitle="Bienvenue Élise, voici un aperçu des activités du refuge"
    />

    <div class="grid min-[1650px]:grid-cols-[1fr_450px] max-w-7xl mx-auto">

        {{-- Main Content (left) --}}
        <div class="space-y-6">
            <x-admin.dashboard.notif-section/>
            <x-admin.dashboard.overview-section/>
        </div>

        {{-- Sidebar (right) --}}
        <div
            class="my-8 px-5 md:px-6 gap-4 grid min-[1650px]:gap-6 min-[1150px]:grid-cols-2 min-[1650px]:grid-cols-1 min-[1650px]:grid-rows-[repeat(auto-fit,minmax(0,max-content))]">
            <x-admin.dashboard.quick-actions :actions="$actions"/>
            <x-admin.dashboard.recent-activity-section/>
        </div>

    </div>

</main>
