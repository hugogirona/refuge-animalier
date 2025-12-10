<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('denies volunteer from accessing admin-only routes by displaying a 403', function () {
    $volunteer = User::factory()->volunteer()->create();

    $response = $this->actingAs($volunteer)->get('/admin/users');

    $response->assertStatus(403);
});

it('redirects guest to login', function () {
    $response = $this->get('/admin/dashboard');

    $response->assertRedirect('/login');
});

it('allows volunteer to access volunteer routes', function () {
    $volunteer = User::factory()->volunteer()->create();

    $response = $this->actingAs($volunteer)->get('/admin/dashboard');

    $response->assertStatus(200);
});

it('middleware accepts multiple roles', function () {
    $admin = User::factory()->admin()->create();
    $volunteer = User::factory()->volunteer()->create();

    // Route accessible par admin ET volunteer
    $adminResponse = $this->actingAs($admin)->get('/admin/pets');
    $volunteerResponse = $this->actingAs($volunteer)->get('/admin/pets');

    $adminResponse->assertStatus(200);
    $volunteerResponse->assertStatus(200);
});
