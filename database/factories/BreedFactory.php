<?php

namespace Database\Factories;

use App\Enums\PetBreeds;
use App\Enums\PetSpecies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Breed>
 */
class BreedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = fake()->randomElement([PetSpecies::DOG, PetSpecies::CAT]);

        $enumPool = match ($species) {
            PetSpecies::DOG => PetBreeds::dogs(),
            PetSpecies::CAT => PetBreeds::cats(),
        };

        $randomBreedEnum = PetBreeds::random($enumPool);

        return [
            'name' => $randomBreedEnum->value,
            'species' => $species,
        ];
    }
}
