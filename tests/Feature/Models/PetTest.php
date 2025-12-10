<?php

use App\Enums\AdoptionRequestStatus;
use App\Enums\PetBreeds;
use App\Enums\PetSex;
use App\Enums\PetSpecies;
use App\Enums\PetStatus;
use App\Models\AdoptionRequest;
use App\Models\InternalNote;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has fillable attributes', function () {
    $pet = Pet::factory()->create([
        'name' => 'Moka',
        'species' => PetSpecies::DOG,
        'breed' => PetBreeds::LABRADOR_RETRIEVER,
    ]);

    expect($pet->name)->toBe('Moka')
        ->and($pet->species)->toBe(PetSpecies::DOG)
        ->and($pet->breed)->toBe(PetBreeds::LABRADOR_RETRIEVER);
});

it('casts species to enum', function () {
    $pet = Pet::factory()->create(['species' => PetSpecies::CAT]);

    expect($pet->species)->toBeInstanceOf(PetSpecies::class)
        ->and($pet->species)->toBe(PetSpecies::CAT)
        ->and($pet->species->value)->toBe('cat');
});

it('casts sex to enum', function () {
    $pet = Pet::factory()->create(['sex' => PetSex::MALE]);

    expect($pet->sex)->toBeInstanceOf(PetSex::class)
        ->and($pet->sex)->toBe(PetSex::MALE)
        ->and($pet->sex->value)->toBe('male');
});

it('casts status to enum', function () {
    $pet = Pet::factory()->create(['status' => PetStatus::AVAILABLE]);

    expect($pet->status)->toBeInstanceOf(PetStatus::class)
        ->and($pet->status)->toBe(PetStatus::AVAILABLE)
        ->and($pet->status->value)->toBe('available');
});

it('casts breed to enum', function () {
    $pet = Pet::factory()->create(['breed' => PetBreeds::GOLDEN_RETRIEVER]);

    expect($pet->breed)->toBeInstanceOf(PetBreeds::class)
        ->and($pet->breed)->toBe(PetBreeds::GOLDEN_RETRIEVER);
});

it('casts dates correctly', function () {
    $pet = Pet::factory()->create([
        'birth_date' => '2020-01-15',
        'arrived_at' => '2023-06-20',
    ]);

    expect($pet->birth_date)->toBeInstanceOf(\Carbon\Carbon::class)
        ->and($pet->arrived_at)->toBeInstanceOf(\Carbon\Carbon::class)
        ->and($pet->birth_date->format('Y-m-d'))->toBe('2020-01-15')
        ->and($pet->arrived_at->format('Y-m-d'))->toBe('2023-06-20');
});

it('casts is_published to boolean', function () {
    $published = Pet::factory()->create(['is_published' => true]);
    $draft = Pet::factory()->create(['is_published' => false]);

    expect($published->is_published)->toBeTrue()
        ->and($draft->is_published)->toBeFalse();
});


describe('Pet Model - Relationships', function () {
    it('belongs to a creator', function () {
        $user = User::factory()->create();
        $pet = Pet::factory()->create(['created_by' => $user->id]);

        expect($pet->creator)->toBeInstanceOf(User::class)
            ->and($pet->creator->id)->toBe($user->id);
    });

    it('belongs to a publisher', function () {
        $publisher = User::factory()->admin()->create();
        $pet = Pet::factory()->create([
            'published_by' => $publisher->id,
            'is_published' => true,
        ]);

        expect($pet->publisher)->toBeInstanceOf(User::class)
            ->and($pet->publisher->id)->toBe($publisher->id);
    });

    it('can have null publisher when not published', function () {
        $pet = Pet::factory()->create([
            'is_published' => false,
            'published_by' => null,
        ]);

        expect($pet->publisher)->toBeNull();
    });

    it('has many internal notes', function () {
        $pet = Pet::factory()->create();
        $user = User::factory()->create();

        $pet->addInternalNote('Test note 1', $user);
        $pet->addInternalNote('Test note 2', $user);

        expect($pet->internalNotes)->toHaveCount(2);
    });

    it('has many adoption requests', function () {
        $pet = Pet::factory()->create();

        AdoptionRequest::factory()->count(3)->create(['pet_id' => $pet->id]);

        expect($pet->adoptionRequests)->toHaveCount(3);
    });

    it('has one accepted adoption', function () {
        $pet = Pet::factory()->create();

        // 1. La demande acceptée
        AdoptionRequest::factory()->create([
            'pet_id' => $pet->id,
            'status' => AdoptionRequestStatus::ACCEPTED,
        ]);

        // 2. Une autre demande en attente (pour prouver que le filtre marche)
        AdoptionRequest::factory()->create([
            'pet_id' => $pet->id,
            'status' => AdoptionRequestStatus::PENDING,
        ]);

        // On recharge pour être sûr d'avoir les relations à jour
        $pet->refresh();

        // Vérifications
        expect($pet->acceptedRequest)->not->toBeNull()
            ->toBeInstanceOf(AdoptionRequest::class)
            ->and($pet->acceptedRequest->status)->toBe(AdoptionRequestStatus::ACCEPTED->value);
    });
});


it('can filter published pets', function () {
    Pet::factory()->count(4)->create(['is_published' => true]);
    Pet::factory()->count(2)->create(['is_published' => false]);

    $published = Pet::published()->get();

    expect($published)->toHaveCount(4);
});

it('can filter available pets', function () {

    Pet::factory()->create(['is_published' => false]);
    Pet::factory()->create([
        'is_published' => true,
        'status' => PetStatus::IN_CARE
    ]);
    Pet::factory()->create([
        'is_published' => true,
        'status' => PetStatus::AVAILABLE
    ]);

    $availablePets = Pet::available()->get();

    // 3. Vérification (assert)
    expect($availablePets)->toHaveCount(1)
        ->and($availablePets->first()->status)->toBe(PetStatus::AVAILABLE);
});

it('can filter by species', function () {

    Pet::factory()->count(3)->create(['species' => PetSpecies::DOG]);
    Pet::factory()->count(2)->create(['species' => PetSpecies::CAT]);


    $dogs = Pet::ofSpecies(PetSpecies::DOG)->get();

    expect($dogs)->toHaveCount(3);
});

it('can filter by status', function () {

    Pet::factory()->count(2)->create(['status' => PetStatus::AVAILABLE]);
    Pet::factory()->count(3)->create(['status' => PetStatus::IN_CARE]);


    $inCare = Pet::withStatus(PetStatus::IN_CARE)->get();

    expect($inCare)->toHaveCount(3);
});

it('can filter by creator', function () {
    $user = User::factory()->create();
    Pet::factory()->count(3)->create(['created_by' => $user->id]);
    Pet::factory()->count(2)->create();

    $userPets = Pet::createdBy($user)->get();

    expect($userPets)->toHaveCount(3);
});


it('checks if pet is available', function () {

    $available = Pet::factory()->create([
        'status' => PetStatus::AVAILABLE,
        'is_published' => true
    ]);

    $inCare = Pet::factory()->create([
        'status' => PetStatus::IN_CARE
    ]);

    $draft = Pet::factory()->create([
        'status' => PetStatus::AVAILABLE,
        'is_published' => false
    ]);

    expect($available->isAvailable())->toBeTrue()
        ->and($inCare->isAvailable())->toBeFalse()
        ->and($draft->isAvailable())->toBeFalse();
});

it('checks if pet is published', function () {
    // On passe simplement le booléen
    $published = Pet::factory()->create(['is_published' => true]);
    $draft = Pet::factory()->create(['is_published' => false]);

    expect($published->isPublished())->toBeTrue()
        ->and($draft->isPublished())->toBeFalse();
});

it('can publish a pet', function () {
    $pet = Pet::factory()->create(['is_published' => false]);
    $admin = User::factory()->admin()->create();

    expect($pet->is_published)->toBeFalse();

    $pet->publish($admin);

    expect($pet->fresh()->is_published)->toBeTrue()
        ->and($pet->published_by)->toBe($admin->id)
        ->and($pet->published_at)->not->toBeNull();
});


it('can unpublish a pet', function () {

    $pet = Pet::factory()->create(['is_published' => true]);

    expect($pet->is_published)->toBeTrue();

    $pet->unpublish();

    expect($pet->fresh()->is_published)->toBeFalse();
});

it('can add internal note', function () {
    $pet = Pet::factory()->create();
    $user = User::factory()->create();

    $note = $pet->addInternalNote('Test note', $user);

    expect($note)->toBeInstanceOf(InternalNote::class)
        ->and($note->content)->toBe('Test note')
        ->and($note->user_id)->toBe($user->id)
        ->and($pet->internalNotes)->toHaveCount(1);
});

it('calculates age correctly', function () {
    $pet = Pet::factory()->create([
        'birth_date' => now()->subYears(3)->subMonths(6),
    ]);

    expect($pet->age)->toBe(3);
});

it('returns null age when birth_date is null', function () {
    $pet = Pet::factory()->create(['birth_date' => null]);

    expect($pet->age)->toBeNull();
});

it('returns age text for young pet in months', function () {
    $pet = Pet::factory()->create([
        'birth_date' => now()->subMonths(8),
    ]);

    expect($pet->age_text)->toBe('8 mois');
});

it('returns age text for 1 month old pet', function () {
    $pet = Pet::factory()->create([
        'birth_date' => now()->subMonths(1),
    ]);

    expect($pet->age_text)->toBe('1 mois');
});

it('returns age text for adult pet in years', function () {
    $pet = Pet::factory()->create([
        'birth_date' => now()->subYears(3),
    ]);

    expect($pet->age_text)->toBe('3 ans');
});

it('returns age text for 1 year old pet', function () {
    $pet = Pet::factory()->create([
        'birth_date' => now()->subYears(1),
    ]);

    expect($pet->age_text)->toBe('1 an');
});

it('returns age text with years and months', function () {
    $pet = Pet::factory()->create([
        'birth_date' => now()->subYears(3)->subMonths(6),
    ]);

    expect($pet->age_text)->toBe('3 ans et 6 mois');
});

it('returns unknown age text when birth_date is null', function () {
    $pet = Pet::factory()->create(['birth_date' => null]);

    expect($pet->age_text)->toBe('Âge inconnu');
});

it('calculates days at shelter', function () {
    $pet = Pet::factory()->create([
        'arrived_at' => now()->subDays(45),
    ]);

    expect($pet->days_at_shelter)->toBe(45);
});

it('returns null days at shelter when arrived_at is null', function () {
    $pet = Pet::factory()->create(['arrived_at' => null]);

    expect($pet->days_at_shelter)->toBeNull();
});


it('soft deletes a pet', function () {
    $pet = Pet::factory()->create();

    $pet->delete();

    expect(Pet::count())->toBe(0)
        ->and(Pet::withTrashed()->count())->toBe(1);
});

it('can restore a soft deleted pet', function () {
    $pet = Pet::factory()->create();
    $pet->delete();

    $pet->restore();

    expect(Pet::count())->toBe(1)
        ->and($pet->fresh()->deleted_at)->toBeNull();
});

it('can force delete a pet', function () {
    $pet = Pet::factory()->create();

    $pet->forceDelete();

    expect(Pet::withTrashed()->count())->toBe(0);
});


