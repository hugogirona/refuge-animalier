<?php

use App\Models\AdoptionRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Adoptions')]
class extends Component {
    public int $adoptions_count = 0;

    public function mount(): void
    {
        $this->authorize('viewAny', AdoptionRequest::class);
        $this->adoptions_count = AdoptionRequest::count();
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
            :subtitle="$this->adoptions_count . ' ' .'demandes au total'"
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
        <template x-if="!isDesktop">
            <livewire:admin.partials.adoptions.adoptions-list/>
        </template>

        <template x-if="isDesktop">
            <livewire:admin.partials.adoptions.adoptions-table/>
        </template>
    </div>
</main>
