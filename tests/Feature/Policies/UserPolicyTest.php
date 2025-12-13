<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User Policy', function () {

    it('allows admin to create users', function () {
        $admin = User::factory()->admin()->create();

        expect($admin->can('create', User::class))->toBeTrue();
    });

    it('denies volunteer from creating users', function () {
        $volunteer = User::factory()->volunteer()->create();

        expect($volunteer->cannot('create', User::class))->toBeTrue();
    });

    it('allows admin to view all users', function () {
        $admin = User::factory()->admin()->create();

        expect($admin->can('viewAny', User::class))->toBeTrue();
    });

    it('denies volunteer from viewing all users', function () {
        $volunteer = User::factory()->volunteer()->create();

        expect($volunteer->cannot('viewAny', User::class))->toBeTrue();
    });

    it('allows volunteer to view their own profile', function () {
        $volunteer = User::factory()->volunteer()->create();

        expect($volunteer->can('view', $volunteer))->toBeTrue();
    });

    it('denies volunteer from viewing other users', function () {
        $volunteer = User::factory()->volunteer()->create();
        $otherUser = User::factory()->create();

        expect($volunteer->cannot('view', $otherUser))->toBeTrue();
    });

    it('prevents admin from deleting themselves', function () {
        $admin = User::factory()->admin()->create();

        expect($admin->cannot('delete', $admin))->toBeTrue();
    });
});
