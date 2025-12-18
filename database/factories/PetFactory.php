<?php

namespace Database\Factories;

use App\Enums\PetStatus;
use App\Models\Breed; // <-- Import du modèle Breed
use App\Models\Pet;
use App\Enums\PetSex;
use App\Enums\PetSpecies;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    public function definition(): array
    {
        $species = fake()->randomElement([PetSpecies::DOG, PetSpecies::CAT]);

        return [
            'name' => fake()->firstName(),
            'species' => $species,
            'breed_id' => function () use ($species) {
                $existingBreed = Breed::where('species', $species)->inRandomOrder()->first();
                return $existingBreed?->id ?? Breed::factory()->create(['species' => $species])->id;
            },
            'sex' => fake()->randomElement([PetSex::MALE, PetSex::FEMALE]),
            'coat_color' => fake()->randomElement([
                'Noir', 'Blanc', 'Marron', 'Gris', 'Roux',
                'Tigré', 'Tricolore', 'Beige', 'Crème', 'Chocolat'
            ]),
            'birth_date' => fake()->dateTimeBetween('-10 years', '-6 months'),
            'last_vet_visit' => fake()->dateTimeBetween('-6 months', '-1 week'),
            'vaccinations' => fake()->boolean(80)
                ? 'Vaccins à jour'
                : 'Vaccins incomplets - à mettre à jour',
            'sterilized' => fake()->boolean(80),
            'personality' => fake()->paragraph(2),
            'story' => fake()->paragraph(2),
            'status' => PetStatus::AVAILABLE,
            'photo_path' => null,
            'is_published' => false,
            'created_by' => User::factory(),
            'published_by' => null,
            'published_at' => null,
            'arrived_at' => fake()->dateTimeBetween('-3 years', 'now'),
        ];
    }
}
