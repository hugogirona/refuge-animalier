<?php

use Livewire\Component;

new class extends Component {
    public array $adoptions = [];

    public function mount(array $adoptions): void
    {
        $this->adoptions = $adoptions;
    }
};
?>

<div class="flex flex-col gap-4 mb-12">
    {{-- Search Bar (non fonctionnelle pour l'instant) --}}

    <div class="bg-transparent">
        <div class="lg:max-w-xl mr-auto py-4 flex flex-col gap-3">
            <x-search-filter.search-bar placeholder="Rechercher une demande..."/>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    @foreach($adoptions as $adoption)
        <x-admin.partials.adoptions.adoption-card
            :petPhoto="$adoption['photo_url']"
            :petName="$adoption['pet_name']"
            :petBreed="$adoption['pet_breed']"
            :adopterName="$adoption['adopter_name']"
            :adopterEmail="$adoption['adopter_email']"
            :requestDate="$adoption['created_at']"
            :status="$adoption['status']"
            :lastAction="$adoption['last_action']"
            :linkUrl="route('adoptions.show')"
        />
    @endforeach
    </div>
</div>
