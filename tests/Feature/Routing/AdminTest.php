<?php

use App\Models\User;


beforeEach(function () {
    // Exécuté AVANT CHAQUE test
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});


it('can load the dashboard page', function () {
    $response = $this->get(route('dashboard.index'));
    $response->assertStatus(200);
});

it('can load the pets index page', function () {
    $response = $this->get(route('admin-pets.index'));
    $response->assertStatus(200);
});

it('can load the pets show page', function () {
    $response = $this->get(route('admin-pets.show'));
    $response->assertStatus(200);
});

it('can load the adoptions index page', function () {
    $response = $this->get(route('adoptions.index'));
    $response->assertStatus(200);
});

it('can load the adoptions show page', function () {
    $response = $this->get(route('adoptions.show'));
    $response->assertStatus(200);
});

it('can load the users index page', function () {
    $response = $this->get(route('users.index'));
    $response->assertStatus(200);
});

it('can load the messages index page', function () {
    $response = $this->get(route('messages.index'));
    $response->assertStatus(200);
});

it('can load the settings index page', function () {
    $response = $this->get(route('settings.index'));
    $response->assertStatus(200);
});
