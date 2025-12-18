<?php

use App\Enums\PetStatus;
use App\Models\AdoptionRequest;
use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can load the home page', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertViewIs('pages.public.home.index');
});

it('can load the pets.index page', function () {
    $response = $this->get(route('pets.index'));

    $response->assertOk()
        ->assertViewIs('pages.public.pets.index');
});

it('can load the pets.show page for an available pet', function () {
    // On crée un animal pour tester la route dynamique
    $pet = Pet::factory()->create([
        'name' => 'Moka',
        'status' => PetStatus::AVAILABLE,
        'is_published' => true,
    ]);

    $response = $this->get(route('pets.show', $pet));

    $response->assertOk()
        ->assertViewIs('pages.public.pets.show')
        ->assertSee('Moka');
});

it('can load the adoption.create page', function () {
    $pet = Pet::factory()->create([
        'status' => PetStatus::AVAILABLE,
        'is_published' => true,
    ]);

    $response = $this->get(route('adoption.create', $pet));

    $response->assertOk()
        ->assertViewIs('pages.public.adoption.create');
});

it('can load the adoption.confirmation page', function () {
    $adoptionRequest = AdoptionRequest::factory()->create();

    $response = $this->get(route('adoption.confirmation', $adoptionRequest));

    $response->assertOk()
        ->assertViewIs('pages.public.adoption.confirmation')
        ->assertSee('Demande envoyée')
        ->assertSee($adoptionRequest->first_name);
});

it('can load the about page', function () {
    $response = $this->get(route('about'));

    $response->assertOk()
        ->assertViewIs('pages.public.about.index');
});

it('can load the contact page', function () {
    $response = $this->get(route('contact.create'));

    $response->assertOk()
        ->assertViewIs('pages.public.contact.create');
});

it('can load the legal page', function () {
    $response = $this->get(route('legal'));

    $response->assertOk()
        ->assertViewIs('pages.public.legal.index');
});
