<?php

use App\Enums\AdoptionRequestStatus;
use App\Enums\PetStatus;
use App\Models\AdoptionRequest;
use App\Models\Pet;
use App\Models\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function (){
    Shelter::factory()->create();
});

describe('Adoption Form Display (GET)', function () {

    it('displays the form for an available pet', function () {
        $pet = Pet::factory()->create([
            'status' => PetStatus::AVAILABLE,
            'is_published' => true,
        ]);

        $this->get(route('adoption.create', $pet))
            ->assertOk()
            ->assertViewIs('pages.public.adoption.create')
            ->assertViewHas('pet');
    });

    it('returns 404 if pet is not available (in care)', function () {
        $pet = Pet::factory()->create([
            'status' => PetStatus::IN_CARE,
            'is_published' => true,
        ]);

        $this->get(route('adoption.create', $pet))
            ->assertNotFound();
    });

    it('returns 404 if pet is unpublished', function () {
        $pet = Pet::factory()->create([
            'status' => PetStatus::AVAILABLE,
            'is_published' => false,
        ]);

        $this->get(route('adoption.create', $pet))
            ->assertNotFound();
    });
});

describe('Adoption Form Submission (POST)', function () {

    // Données valides de base pour éviter de répéter le tableau partout
    $validData = function ($overrides = []) {
        return array_merge([
            'pet_id' => null, // À remplir
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'email' => 'jean.dupont@test.com',
            'phone' => '0612345678',
            'address' => '10 Rue de la Paix',
            'zip_code' => '75000',
            'city' => 'Paris',
            'accommodation_type' => 'house',
            'garden' => 'yes',
            'has_other_pets' => 'Un chat',
            'had_same' => 'Oui',
            'available_days' => ['monday', 'tuesday'],
            'available_hours' => ['morning'],
            'preferred_contact_method' => 'email',
            'contact' => 'email',
            'message' => 'J\'adore ce chien !',
            'rgpd' => '1',
            'newsletter_consent' => '1',
        ], $overrides);
    };

    it('stores the request and redirects to confirmation', function () use ($validData) {
        $pet = Pet::factory()->create();

        $data = $validData(['pet_id' => $pet->id]);

        $response = $this->post(route('adoption.store'), $data);
        $response->assertRedirect();

        $request = AdoptionRequest::first();
        $response->assertRedirect(route('adoption.confirmation', $request));

        $this->assertDatabaseHas('adoption_requests', [
            'pet_id' => $pet->id,
            'email' => 'jean.dupont@test.com',
            'accommodation_type' => 'house',
            'has_garden' => true,
            'newsletter_consent' => true,
            'has_other_pets' => 'Un chat',
            'status' => AdoptionRequestStatus::NEW->value,
        ]);
    });


    it('validates required fields', function () {
        $response = $this->post(route('adoption.store'), []);

        $response->assertSessionHasErrors([
            'pet_id', 'first_name', 'email', 'rgpd'
        ]);
    });

    it('validates email format', function () {
        $pet = Pet::factory()->create();

        $response = $this->post(route('adoption.store'), [
            'pet_id' => $pet->id,
            'email' => 'not-an-email',
        ]);

        $response->assertSessionHasErrors(['email']);
    });

    it('prevents duplicate requests for the same pet and email', function () use ($validData) {
        $pet = Pet::factory()->create();

        $this->post(route('adoption.store'), $validData(['pet_id' => $pet->id]));

        $response = $this->post(route('adoption.store'), $validData(['pet_id' => $pet->id]));

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('adoption_requests', 1);
    });

    it('allows same email to request a DIFFERENT pet', function () use ($validData) {
        $pet1 = Pet::factory()->create();
        $pet2 = Pet::factory()->create();

        // Demande pour Rex
        $this->post(route('adoption.store'), $validData(['pet_id' => $pet1->id]))
            ->assertSessionHasNoErrors();

        // Demande pour Moka (même email)
        $this->post(route('adoption.store'), $validData(['pet_id' => $pet2->id]))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('adoption_requests', 2);
    });
});

describe('Adoption Confirmation Page (GET)', function () {

    it('displays the confirmation page with correct data', function () {
        $request = AdoptionRequest::factory()->create([
            'first_name' => 'Alice',
        ]);

        $response = $this->get(route('adoption.confirmation', $request));

        $response->assertOk()
            ->assertViewIs('pages.public.adoption.confirmation')
            ->assertSee('Alice')
            ->assertSee($request->pet->name);
    });
});
