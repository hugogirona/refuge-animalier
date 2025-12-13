<?php

use App\Enums\AdoptionRequestStatus;
use App\Models\AdoptionRequest;
use App\Models\InternalNote;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('AdoptionRequest Attributes', function () {
    it('can create an adoption request with casted attributes', function () {
        $request = AdoptionRequest::factory()->create([
            'has_garden' => true,
            'available_days' => ['monday', 'tuesday'],
            'available_hours' => ['morning'],
        ]);

        expect($request)
            ->has_garden->toBeTrue()
            ->available_days->toBeArray()->toBe(['monday', 'tuesday'])
            ->available_hours->toBeArray()->toBe(['morning']);
    });

    it('generates the full name attribute correctly', function () {
        $request = AdoptionRequest::factory()->create([
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
        ]);

        expect($request->full_name)->toBe('Jean Dupont');
    });
});

describe('AdoptionRequest Relationships', function () {
    it('belongs to a pet', function () {
        $pet = Pet::factory()->create();
        $request = AdoptionRequest::factory()->create(['pet_id' => $pet->id]);

        expect($request->pet)->toBeInstanceOf(Pet::class)
            ->and($request->pet->id)->toBe($pet->id);
    });

    it('can belong to a processor (user)', function () {
        $user = User::factory()->create();
        $request = AdoptionRequest::factory()->create(['processed_by' => $user->id]);

        expect($request->processor)->toBeInstanceOf(User::class)
            ->and($request->processor->id)->toBe($user->id);
    });
});

describe('AdoptionRequest Scopes', function () {
    it('can filter pending (new) requests', function () {
        AdoptionRequest::factory()->create(['status' => AdoptionRequestStatus::NEW]);
        AdoptionRequest::factory()->create(['status' => AdoptionRequestStatus::NEW]);
        AdoptionRequest::factory()->create(['status' => AdoptionRequestStatus::PENDING]); // En cours

        $pendingRequests = AdoptionRequest::pending()->get();

        expect($pendingRequests)->toHaveCount(1)
            ->and($pendingRequests->first()->status)->toBe(AdoptionRequestStatus::PENDING->value);
    });

    it('can filter in progress requests', function () {
        AdoptionRequest::factory()->create(['status' => AdoptionRequestStatus::NEW]);
        AdoptionRequest::factory()->create(['status' => AdoptionRequestStatus::PENDING]);
        AdoptionRequest::factory()->create(['status' => AdoptionRequestStatus::ACCEPTED]);

        $inProgressRequests = AdoptionRequest::pending()->get();

        expect($inProgressRequests)->toHaveCount(1)
            ->and($inProgressRequests->first()->status)->toBe(AdoptionRequestStatus::PENDING->value);
    });
});

describe('AdoptionRequest Internal Notes', function () {
    it('can add an internal note', function () {
        $user = User::factory()->create();
        $request = AdoptionRequest::factory()->create();

        $note = $request->addInternalNote('Ceci est une note importante.', $user);

        expect($note)->toBeInstanceOf(InternalNote::class)
            ->content->toBe('Ceci est une note importante.')
            ->user_id->toBe($user->id)
            ->and($request->internalNotes)->toHaveCount(1)
            ->and($request->internalNotes->first()->content)->toBe('Ceci est une note importante.');


        $this->assertDatabaseHas('internal_notes', [
            'notable_id' => $request->id,
            'notable_type' => AdoptionRequest::class,
            'content' => 'Ceci est une note importante.',
        ]);
    });

    it('retrieves internal notes in latest order', function () {
        $request = AdoptionRequest::factory()->create();
        $user = User::factory()->create();

        $note1 = $request->addInternalNote('Note ancienne', $user);
        $this->travel(1)->hour();
        $note2 = $request->addInternalNote('Note récente', $user);

        expect($request->internalNotes->first()->id)->toBe($note2->id)
            ->and($request->internalNotes->last()->id)->toBe($note1->id);
    });
});
