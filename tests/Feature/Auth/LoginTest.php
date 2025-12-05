<?php

use App\Models\User;

it('allows users to view login page', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

it('allows users to login with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'hugogirona@test.com',
        'password' => bcrypt('change_this'),
    ]);

    $response = $this->post('/login', [
        'email' => 'hugogirona@test.com',
        'password' => 'change_this',
    ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect('/admin/dashboard');
});

it('prevents users from logging in with invalid password', function () {
    User::factory()->create([
        'email' => 'hugogirona@test.com',
        'password' => bcrypt('change_this'),
    ]);

    $response = $this->post('/login', [
        'email' => 'hugogirona@test.com',
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors();
});

it('prevents users from logging in with invalid email', function () {
    $response = $this->post('/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'change_this',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors();
});

it('allows authenticated users to logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

it('validates required fields on login form', function () {
    $response = $this->post('/login', [
        'email' => '',
        'password' => '',
    ]);

    $response->assertSessionHasErrors(['email', 'password']);
});

it('validates email format on login form', function () {
    $response = $this->post('/login', [
        'email' => 'not-an-email',
        'password' => 'change_this',
    ]);

    $response->assertSessionHasErrors(['email']);
});
