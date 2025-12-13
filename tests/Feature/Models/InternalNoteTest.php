<?php

use App\Models\AdoptionRequest;
use App\Models\InternalNote;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('InternalNote Attributes & Relationships', function () {
    it('has fillable attributes', function () {
        $note = InternalNote::factory()->create([
            'content' => 'Note test',
        ]);

        expect($note->content)->toBe('Note test');
    });

    it('belongs to a user', function () {
        $user = User::factory()->create();
        $note = InternalNote::factory()->create(['user_id' => $user->id]);

        expect($note->user)->toBeInstanceOf(User::class)
            ->and($note->user->id)->toBe($user->id);
    });

    it('morphs to a pet', function () {
        $pet = Pet::factory()->create();
        $note = InternalNote::factory()->create([
            'notable_type' => Pet::class,
            'notable_id' => $pet->id,
        ]);

        expect($note->notable)->toBeInstanceOf(Pet::class)
            ->and($note->notable->id)->toBe($pet->id);
    });

    it('morphs to an adoption request', function () {
        $request = AdoptionRequest::factory()->create();
        $note = InternalNote::factory()->create([
            'notable_type' => AdoptionRequest::class,
            'notable_id' => $request->id,
        ]);

        expect($note->notable)->toBeInstanceOf(AdoptionRequest::class)
            ->and($note->notable->id)->toBe($request->id);
    });
});

describe('InternalNote Scopes & Accessors', function () {
    it('can filter notes for a specific model', function () {
        $pet1 = Pet::factory()->create();
        $pet2 = Pet::factory()->create();

        InternalNote::factory()->count(2)->create([
            'notable_type' => Pet::class,
            'notable_id' => $pet1->id
        ]);
        InternalNote::factory()->create([
            'notable_type' => Pet::class,
            'notable_id' => $pet2->id
        ]);

        $notesForPet1 = InternalNote::for($pet1)->get();

        expect($notesForPet1)->toHaveCount(2);
    });

    it('returns formatted date', function () {
        $date = now()->setYear(2023)->setMonth(12)->setDay(25)->setHour(10)->setMinute(0);
        $note = InternalNote::factory()->create(['created_at' => $date]);

        expect($note->formatted_date)->toBe('25/12/2023 à 10:00');
    });

    it('returns author name', function () {
        $user = User::factory()->create([
            'first_name' => 'Hugo',
            'last_name' => 'Girona'
        ]);

        $note = InternalNote::factory()->create(['user_id' => $user->id]);

        // Adaptez selon comment votre accesseur User::full_name est défini
        // Si vous n'avez pas full_name sur User, le test vérifiera la concaténation
        expect($note->author_name)->toContain('Hugo');
    });
});
