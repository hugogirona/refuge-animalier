<?php

use Livewire\Component;

new class extends Component {
    public array $shelter = [];
    public array $user = [];
    public array $notifications = [];

    public function mount(): void
    {
        $this->shelter = [
            'name' => 'Les Pattes Heureuses',
            'logo' => 'https://via.placeholder.com/150',
            'address' => '123 Rue des Animaux',
            'postal_code' => '1000',
            'city' => 'Bruxelles',
            'phone' => '+32 2 123 45 67',
            'email' => 'contact@pattesheureuses.be',
        ];

        $this->user = [
            'first_name' => 'Thomas',
            'last_name' => 'Martin',
            'email' => 'thomas.martin@refuge.be',
            'phone' => '+32 470 65 43 21',
            'avatar' => 'https://i.pravatar.cc/300?img=12',
        ];

        $this->notifications = [
            'email_notifications' => ['new_adoption', 'new_pet', 'new_message'],
            'frequency' => 'immediate',
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
            Paramètres
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <div>
        <x-admin.partials.title-header
            title="Paramètres"
        />
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-6 mb-8">
        <div class="flex flex-col xl:flex-row-reverse gap-6">
            {{-- Navigation secondaire (sidebar) --}}
            <aside class="w-full xl:w-80 flex-shrink-0">
                <x-admin.partials.settings.settings-nav currentSection="shelter-info" />
            </aside>

            {{-- Contenu principal --}}
            <div class="flex-1 space-y-6">
                <div id="shelter-info" class="scroll-mt-6">
                    <livewire:admin.partials.settings.shelter-info :shelter="$shelter"/>
                </div>

                <div id="my-profile" class="scroll-mt-6">
                    <livewire:admin.partials.settings.my-profile-section :user="$user"/>
                </div>

                <div id="notifications" class="scroll-mt-6">
                    <livewire:admin.partials.settings.notifications-section :notifications="$notifications"/>
                </div>

                <div id="security" class="scroll-mt-6">
                    <livewire:admin.partials.settings.change-password-section/>
                </div>
            </div>
        </div>
    </div>

</main>
