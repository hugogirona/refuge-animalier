<?php

use App\Enums\AdoptionRequestStatus;
use App\Enums\PetStatus;
use App\Models\AdoptionRequest;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public AdoptionRequest $adoption;

    public function mount(AdoptionRequest $adoption): void
    {
        $this->authorize('view', $adoption);
        $this->adoption = $adoption->load(['pet', 'pet.breed']);
    }

    #[Computed]
    public function actions(): array
    {
        $actions = [
            [
                'label' => 'Envoyer un email',
                'href' => 'mailto:' . $this->adoption->email,
                'variant' => 'secondary',
            ],
            [
                'label' => 'Appeler',
                'href' => 'tel:' . str_replace(' ', '', $this->adoption->phone),
                'variant' => 'secondary',
            ],
        ];

        $status = $this->adoption->status instanceof AdoptionRequestStatus
            ? $this->adoption->status
            : AdoptionRequestStatus::from($this->adoption->status);

        if ($status === AdoptionRequestStatus::NEW) {
            $actions[] = [
                'label' => 'Mettre en attente',
                'action' => 'setPending',
                'variant' => 'secondary',
                'confirm' => 'Êtes-vous sûr de vouloir mettre cette demande d\'adoption en attente?'
            ];
        }


        if (in_array($status, [AdoptionRequestStatus::PENDING, AdoptionRequestStatus::NEW])) {
            $actions[] = [
                'label' => 'Valider la demande',
                'action' => 'accept',
                'variant' => 'success',
                'confirm' => 'Êtes-vous sûr de vouloir accepter cette demande d\'adoption ?',
            ];

            $actions[] = [
                'label' => 'Refuser la demande',
                'action' => 'reject',
                'variant' => 'error',
                'confirm' => 'Êtes-vous sûr de vouloir refuser cette demande d\'adoption ?',
            ];
        }


        if ($status === AdoptionRequestStatus::ACCEPTED) {
            $actions[] = [
                'label' => 'Remettre en attente',
                'action' => 'setPending',
                'variant' => 'secondary',
            ];
        }

        if ($status === AdoptionRequestStatus::REJECTED) {
            $actions[] = [
                'label' => 'Reconsidérer',
                'action' => 'setPending',
                'variant' => 'secondary',
            ];
        }

        return $actions;
    }

    #[Computed]
    public function statusBadgeType(): string
    {
        return match ($this->adoption->status) {
            AdoptionRequestStatus::NEW => 'primary',
            AdoptionRequestStatus::PENDING => 'warning',
            AdoptionRequestStatus::ACCEPTED => 'success',
            AdoptionRequestStatus::REJECTED => 'error',
        };
    }

    #[Computed]
    public function statusLabel(): string
    {
        return match ($this->adoption->status) {
            AdoptionRequestStatus::NEW => 'Nouvelle',
            AdoptionRequestStatus::PENDING => 'En attente',
            AdoptionRequestStatus::ACCEPTED => 'Acceptée',
            AdoptionRequestStatus::REJECTED => 'Refusée',
        };
    }


    // Actions
    public function accept(): void
    {
        $this->adoption->update([
            'status' => AdoptionRequestStatus::ACCEPTED,
            'adopted_at' => now(),
            'processed_by' => auth()->user()->id,
        ]);

        $this->adoption->pet->update([
            'status' => PetStatus::ADOPTED,
            'is_published' => false
        ]);

        $this->dispatch('adoption-updated');
        $this->dispatch('pet-updated');
    }


    public function reject(): void
    {
        $this->adoption->update([
            'status' => AdoptionRequestStatus::REJECTED,
            'adopted_at' => null,
            'processed_by' => auth()->user()->id,
        ]);

        if ($this->adoption->pet->status === PetStatus::ADOPTION_PENDING) {
            $this->adoption->pet->update([
                'status' => PetStatus::AVAILABLE
            ]);
            $this->dispatch('pet-updated');
        }

        $this->dispatch('adoption-updated');
    }

    public function setPending(): void
    {
        $this->adoption->update([
            'status' => AdoptionRequestStatus::PENDING,
            'adopted_at' => null,
            'processed_by' => auth()->user()->id,
            ]);

        $this->adoption->pet->update([
            'status' => PetStatus::ADOPTION_PENDING,
        ]);

        $this->dispatch('adoption-updated');
        $this->dispatch('pet-updated');
    }

};
?>

<main class="flex-1">
    <x-admin.partials.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('dashboard.index') }}">Tableau de bord
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('adoptions.index') }}">Demandes</x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>Dossier
            #{{ date('Y') . $adoption->id }}</x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>
    <div>
        <x-admin.partials.title-header
            title="Demande d'adoption"
            :subtitle="$this->adoption->full_name . ' pour ' . $this->adoption->pet->name"
            :badgeStatus="$this->statusLabel"
            :badgeType="$this->statusBadgeType"
        />
    </div>

    <div class="max-w-7xl mx-auto p-5 md:p-6 grid grid-cols-1 lg:grid-cols-[2Fr_1Fr] gap-4">
        <div class="flex flex-col gap-4 lg:order-2 lg:col-span-1">

            <x-admin.partials.adoptions.adoption-pet-card :pet="$this->adoption->pet"/>

            <x-admin.partials.adoptions.quick-actions :actions="$this->actions"/>
        </div>
        <x-admin.partials.adoptions.adopter-info-section :adoption="$this->adoption"/>
    </div>

</main>

