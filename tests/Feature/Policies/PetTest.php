<?php

use App\Models\Pet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Pet Policy', function () {

    it('allows admin to publish pets', function () {
        $admin = User::factory()->admin()->create();
        $pet = Pet::factory()->create();

        expect($admin->can('publish', $pet))->toBeTrue();
    });

    it('denies volunteer from publishing pets', function () {
        $volunteer = User::factory()->volunteer()->create();
        $pet = Pet::factory()->create();

        expect($volunteer->cannot('publish', $pet))->toBeTrue();
    });

    it('allows volunteer to create pet', function () {
        $volunteer = User::factory()->volunteer()->create();

        expect($volunteer->can('create', Pet::class))->toBeTrue();
    });

    it('allows admin to delete pets', function () {
        $admin = User::factory()->admin()->create();
        $pet = Pet::factory()->create();

        expect($admin->can('delete', $pet))->toBeTrue();
    });

    it('denies volunteer from deleting pets', function () {
        $volunteer = User::factory()->volunteer()->create();
        $pet = Pet::factory()->create();

        expect($volunteer->cannot('delete', $pet))->toBeTrue();
    });
});
