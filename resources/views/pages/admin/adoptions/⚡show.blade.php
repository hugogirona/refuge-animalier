<?php

use Livewire\Component;

new class extends Component {
    public array $adopter = [];
    public array $pet = [];
    public array $actions = [];

    public function mount(): void
    {
        $this->adopter = [
            'first_name' => 'Sarah',
            'last_name' => 'Martin',
            'email' => 'sarah.martin@email.com',
            'phone' => '+32 475 12 34 56',
            'birth_date' => '15 mars 1990 (34 ans)',
            'address' => '45 Avenue des Fleurs',
            'postal_code' => '1050',
            'city' => 'Bruxelles',
            'profession' => 'Enseignante',
            'housing_type' => 'Maison',
            'has_garden' => true,
            'garden_size' => '500m²',
            'pet_experience' => 'J\'ai eu un caniche pendant 12 ans. Je connais bien la race et ses besoins spécifiques.',
            'other_pets' => 'Aucun',
            'motivation' => 'Je cherche un compagnon calme et affectueux. Moka semble parfait ! J\'ai un grand jardin et beaucoup de temps à lui consacrer. J\'ai déjà eu un caniche et je connais bien leurs besoins.',
            'preferred_days' => ['Mercredi', 'Samedi', 'Dimanche'],
            'time_slots' => ['Après-midi', 'Soir'],
            'contact_preference' => 'Téléphone',
        ];

        $this->pet = [
            'name' => 'Moka',
            'breed' => 'Caniche',
            'age' => '5',
            'sex' => 'Mâle',
            'image' => 'moka',
            'slug' => 'moka',
            'status' => 'Disponible',
        ];

        $this->actions = [
            [
                'label' => 'Envoyer un email',
                'href' => 'mailto:' . $this->adopter['email'],
                'variant' => 'secondary',
            ],
            [
                'label' => 'Appeler',
                'href' => 'tel:' . str_replace(' ', '', $this->adopter['phone']),
                'variant' => 'secondary',
            ],
            [
                'label' => 'Valider la demande',
                'href' => '#',
                'variant' => 'success',
            ],
            [
                'label' => 'Refuser la demande',
                'href' => '#',
                'variant' => 'error',
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
        <x-breadcrumb.breadcrumb-item href="{{ route('adoptions.index') }}">
            Adoptions
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            Dossier #1234
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <div>
        <x-admin.partials.title-header
            title="Demande d'adoption"
            subtitle="Sarah Martin pour Moka"
        />
    </div>

    <div class="max-w-7xl mx-auto p-5 md:p-6 grid grid-cols-1 lg:grid-cols-[auto_1Fr] gap-4">
        <div class="flex flex-col gap-4 lg:order-2 min-w-sm">

                <x-admin.partials.adoptions.adoption-pet-card
                    :name="$pet['name']"
                    :breed="$pet['breed']"
                    :age="$pet['age']"
                    :sex="$pet['sex']"
                    :image="$pet['image']"
                    :slug="$pet['slug']"
                    :status="$pet['status']"
                />

            <x-admin.partials.adoptions.quick-actions :actions="$actions"/>
        </div>
        <x-admin.partials.adoptions.adopter-info-section :adopter="$adopter"/>
    </div>

</main>
