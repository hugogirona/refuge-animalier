<?php

use App\Models\Pet;
use App\Models\User;
use App\Models\AdoptionRequest;
use App\Models\ContactMessage;
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

describe('Adoption Request Policy', function () {
    it('allows admin to approve adoptions', function () {
        $admin = User::factory()->admin()->create();
        $adoption = AdoptionRequest::factory()->create();

        expect($admin->can('approve', $adoption))->toBeTrue();
    });

    it('denies volunteer from approving adoptions', function () {
        $volunteer = User::factory()->volunteer()->create();
        $adoption = AdoptionRequest::factory()->create();

        expect($volunteer->cannot('approve', $adoption))->toBeTrue();
    });

    it('allows both to view adoptions', function () {
        $admin = User::factory()->admin()->create();
        $volunteer = User::factory()->volunteer()->create();

        expect($admin->can('viewAny', AdoptionRequest::class))->toBeTrue()
            ->and($volunteer->can('viewAny', AdoptionRequest::class))->toBeTrue();
    });
});

describe('Contact Message Policy', function () {
    it('allows admin to reply to messages', function () {
        $admin = User::factory()->admin()->create();
        $message = ContactMessage::factory()->create();

        expect($admin->can('reply', $message))->toBeTrue();
    });

    it('denies volunteer from replying to messages', function () {
        $volunteer = User::factory()->volunteer()->create();
        $message = ContactMessage::factory()->create();

        expect($volunteer->cannot('reply', $message))->toBeTrue();
    });

    it('allows both to view messages', function () {
        $admin = User::factory()->admin()->create();
        $volunteer = User::factory()->volunteer()->create();

        expect($admin->can('viewAny', ContactMessage::class))->toBeTrue()
            ->and($volunteer->can('viewAny', ContactMessage::class))->toBeTrue();
    });
});
