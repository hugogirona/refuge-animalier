<?php

use App\Enums\PetSpecies;
use App\Enums\PetStatus;
use App\Models\Breed;
use App\Models\Pet;
use App\Models\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function (){
    Shelter::factory()->create();
});

describe('Public Pet Listing (Index Page)', function () {

    it('loads the index view successfully', function () {
        $response = $this->get(route('pets.index'));

        $response->assertStatus(200)
            ->assertViewIs('pages.public.pets.index');
    });

    it('displays only available and published pets', function () {
        // Animal à afficher
        $visible = Pet::factory()->create([
            'name' => 'VisibleDog',
            'status' => PetStatus::AVAILABLE,
            'is_published' => true,
        ]);

        // Animal à cacher
        $hidden = Pet::factory()->create([
            'name' => 'HiddenDog',
            'status' => PetStatus::IN_CARE,
            'is_published' => true,
        ]);

        $response = $this->get(route('pets.index'));

        $response->assertOk()
            ->assertViewHas('pets', function ($pets) use ($visible, $hidden) {
                return $pets->contains($visible) && !$pets->contains($hidden);
            })
            ->assertSee('VisibleDog')
            ->assertDontSee('HiddenDog');
    });

    it('can filter pets by species', function () {
        $dog = Pet::factory()->create([
            'name' => 'Rex',
            'species' => PetSpecies::DOG,
            'status' => PetStatus::AVAILABLE, 'is_published' => true
        ]);

        $cat = Pet::factory()->create([
            'name' => 'Felix',
            'species' => PetSpecies::CAT,
            'status' => PetStatus::AVAILABLE, 'is_published' => true
        ]);

        // Simulation de l'URL ?species=dog
        $response = $this->get(route('pets.index', ['species' => 'dog']));

        $response->assertOk()
            ->assertSee('Rex')
            ->assertDontSee('Felix');
    });

    it('can filter pets by breed', function () {
        // 1. Créer les races
        $labradorBreed = Breed::factory()->create(['name' => 'Labrador Retriever']);
        $poodleBreed = Breed::factory()->create(['name' => 'Poodle']);

        $labradorPet = Pet::factory()->create([
            'name' => 'Buddy',
            'breed_id' => $labradorBreed->id,
            'status' => PetStatus::AVAILABLE,
            'is_published' => true
        ]);

        $poodlePet = Pet::factory()->create([
            'name' => 'Fifi',
            'breed_id' => $poodleBreed->id,
            'status' => PetStatus::AVAILABLE,
            'is_published' => true
        ]);

        $response = $this->get(route('pets.index', ['breed' => $labradorBreed->id]));

        $response->assertOk()
            ->assertSee('Buddy')
            ->assertDontSee('Fifi');
    });

});

describe('Public Pet Detail (Show Page)', function () {

    it('loads the show view for an available pet', function () {
        $pet = Pet::factory()->create([
            'name' => 'Rocky',
            'status' => PetStatus::AVAILABLE,
            'is_published' => true,
        ]);

        $response = $this->get(route('pets.show', $pet));

        $response->assertOk()
            ->assertViewIs('pages.public.pets.show')
            ->assertViewHas('pet', function ($viewPet) use ($pet) {
                return $viewPet->id === $pet->id;
            })
            ->assertSee('Rocky');
    });

    it('returns 404 for unpublished pet', function () {
        $pet = Pet::factory()->create([
            'is_published' => false,
        ]);

        $this->get(route('pets.show', $pet))
            ->assertNotFound();
    });

    it('returns 404 for pet in care', function () {
        $pet = Pet::factory()->create([
            'status' => PetStatus::IN_CARE,
            'is_published' => true,
        ]);

        $this->get(route('pets.show', $pet))
            ->assertNotFound();
    });
});
