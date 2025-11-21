<?php

it('can load the login page', function () {
    $response = $this->get(route('login'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.auth.login');
});

it('can load the forgot password page', function () {
    $response = $this->get(route('password.request'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.auth.forgot-password');
});

it('can load the dashboard page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.dashboard');
});

it('can load the pets index page', function () {
    $response = $this->get(route('admin-pets.index'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.pets.index');
});

it('can load the pets show page', function () {
    $response = $this->get(route('admin-pets.show'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.pets.show');
});

it('can load the adoptions index page', function () {
    $response = $this->get(route('adoptions.index'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.adoptions.index');
});

it('can load the adoptions show page', function () {
    $response = $this->get(route('adoptions.show'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.adoptions.show');
});

it('can load the users index page', function () {
    $response = $this->get(route('users.index'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.users.index');
});

it('can load the users show page', function () {
    $response = $this->get(route('users.show'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.users.show');
});

it('can load the messages index page', function () {
    $response = $this->get(route('messages.index'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.messages.index');
});

it('can load the settings index page', function () {
    $response = $this->get(route('settings.index'));
    $response->assertStatus(200);
    $response->assertViewIs('admin.settings.index');
});
