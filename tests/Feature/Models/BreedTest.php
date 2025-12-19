<?php

use App\Models\Breed;
use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Breed Model', function () {

    it('has fillable attributes', function () {
        $breed = Breed::create([
            'name' => 'Golden Retriever',
            'species' => 'dog',
        ]);

        expect($breed)
            ->name->toBe('Golden Retriever')
            ->species->toBe('dog');
    });

    it('has many pets', function () {
        $breed = Breed::factory()->create();

        Pet::factory()->count(3)->create(['breed_id' => $breed->id]);

        expect($breed->pets)->toHaveCount(3)
            ->and($breed->pets->first())->toBeInstanceOf(Pet::class);
    });

    it('can count associated pets', function () {
        $breed = Breed::factory()->create();
        Pet::factory()->count(5)->create(['breed_id' => $breed->id]);
        $breed->loadCount('pets');

        expect($breed->pets_count)->toBe(5);
    });
});
