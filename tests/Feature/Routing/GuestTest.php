<?php

it('can load the home page', function () {
    $response = $this->get(route('home'));
    $response->assertStatus(200);
    $response->assertViewIs('pages.guest.home.index');
    $response->assertSee(['Trouvez votre', 'compagnon idéal']);
});

it('can load the pets.index page', function () {
    $response = $this->get(route('pets.index'));
    $response->assertStatus(200);
    $response->assertViewIs('pages.guest.pets.index');
    $response->assertSee('Nos animaux');
});

it('can load the pets.show page', function () {
    $response = $this->get(route('pets.show'));
    $response->assertStatus(200);
    $response->assertViewIs('pages.guest.pets.show');
    $response->assertSee('Moka');
});

it('can load the adoption.create page', function () {
    $response = $this->get(route('adoption.create'));
    $response->assertStatus(200);
    $response->assertViewIs('pages.guest.adoption.create');
    $response->assertSee(['Demande','adoption']);
});

it('can load the adoption.confirmation page', function () {
    $response = $this->get(route('adoption.confirmation'));
    $response->assertStatus(200);
    $response->assertViewIs('pages.guest.adoption.confirmation');
    $response->assertSee('Demande envoyée');
});

it('can load the about page', function () {
    $response = $this->get(route('about'));
    $response->assertStatus(200);
    $response->assertViewIs('pages.guest.about.index');
    $response->assertSee('Notre histoire');
});

it('can load the contact page', function () {
    $response = $this->get(route('contact'));
    $response->assertStatus(200);
    $response->assertViewIs('pages.guest.contact.index');
    $response->assertSee('Nous contacter');
});

it('can load the legal page', function () {
    $response = $this->get(route('legal'));
    $response->assertStatus(200);
    $response->assertViewIs('pages.guest.legal.index');
    $response->assertSee('Bienvenue sur la page légale');
});


