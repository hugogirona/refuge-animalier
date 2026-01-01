<?php

use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Enums\UserRoles;

new #[Title('Paramètres')]
class extends Component {

    #[On('profile-updated')]
    #[On('shelter-updated')]
    public function refresh(): void
    {

    }
}

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

            <aside class="w-full xl:w-80 shrink-0">
                <x-admin.partials.settings.settings-nav currentSection="shelter-info"/>
            </aside>

            <div class="flex-1 space-y-6">
                @if(auth()->user()->isAdmin())
                    <div id="shelter-info" class="scroll-mt-6">
                        <livewire:admin.partials.settings.shelter-info/>
                    </div>
                @endif

                <div id="my-profile" class="scroll-mt-6">
                    <livewire:admin.partials.settings.my-profile-section/>
                </div>

                @if(auth()->user()->isAdmin())
                    <div id="notifications" class="scroll-mt-6">
                        <livewire:admin.partials.settings.notifications-section/>
                    </div>
                @endif


                <div id="security" class="scroll-mt-6">
                    <livewire:admin.partials.settings.change-password-section/>
                </div>
            </div>
        </div>
    </div>

</main>
