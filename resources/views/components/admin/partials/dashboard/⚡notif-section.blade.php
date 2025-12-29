<?php

namespace App\Livewire\Admin\Partials\Dashboard;

use App\Enums\AdoptionRequestStatus;
use App\Enums\ContactMessageStatus;
use App\Models\AdoptionRequest;
use App\Models\ContactMessage;
use App\Models\Pet;
use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {
    public int $newAdoptionsCount = 0;
    public int $newMessagesCount = 0;
    public int $pendingPetsCount = 0;
    public int $myPendingPetsCount = 0;

    public function mount(): void
    {
        $this->refreshCounts();
    }

    #[On('adoption-updated')]
    #[On('message-updated')]
    #[On('pet-updated')]
    public function refreshCounts(): void
    {
        $this->newAdoptionsCount = AdoptionRequest::where('status', AdoptionRequestStatus::NEW)->count();
        $this->newMessagesCount = ContactMessage::where('status', ContactMessageStatus::NEW)->count();
        $this->pendingPetsCount = Pet::where('is_published', false)->count();
        $this->myPendingPetsCount = auth()->user()->pets()->where('is_published', false)->count();
    }
}
?>

<section class="my-8 px-5 md:px-6">
    <h2 class="text-2xl font-bold mb-6">Notifications</h2>

    <div class="grid lg:grid-cols-2 gap-4">

        @if(auth()->user()->isAdmin())
            @if($newAdoptionsCount > 0)
                <x-admin.partials.dashboard.notif-card
                    title="Nouvelles demandes d'adoption"
                    :description="$newAdoptionsCount . ' nouvelle(s) demande(s) à traiter'"
                    linkText="Voir les demandes"
                    :linkHref="route('adoptions.index')"
                    :count="$newAdoptionsCount"
                    color="primary"
                />
            @endif
        @endif


        @if($pendingPetsCount > 0)
            @if(auth()->user()->isAdmin())
                <x-admin.partials.dashboard.notif-card
                    title="Fiches non publiées"
                    :description="$pendingPetsCount . ' fiche(s) en attente'"
                    linkText="Voir les animaux"
                    :linkHref="route('admin-pets.index')"
                    :count="$pendingPetsCount"
                    color="secondary"

                />
            @elseif(auth()->user()->isVolunteer())
                <x-admin.partials.dashboard.notif-card
                    title="Mes fiches non publiées"
                    :description="$myPendingPetsCount . ' fiche(s) en attente'"
                    linkText="Voir les animaux"
                    :linkHref="route('admin-pets.index')"
                    :count="$myPendingPetsCount"
                    color="secondary"
                />
            @endif
        @endif

        @if(auth()->user()->isAdmin())
            @if($newMessagesCount > 0)
                <x-admin.partials.dashboard.notif-card
                    title="Nouveaux messages"
                    :description="$newMessagesCount . ' message(s) non lu(s)'"
                    linkText="Voir les messages"
                    :linkHref="route('messages.index')"
                    :count="$newMessagesCount"
                    color="success"
                />
            @endif
        @endif

        {{-- Empty State (Si tout est à jour) --}}
        @if($newAdoptionsCount === 0 && $newMessagesCount === 0 && $pendingPetsCount === 0)
            <div
                class="lg:col-span-2 p-6 bg-white rounded-xl border border-neutral-200 text-center text-grayscale-text-subtitle">
                <p>Aucune notification en attente. Tout est à jour ! 🎉</p>
            </div>
        @endif

    </div>
</section>

