<?php

namespace Database\Factories;

use App\Enums\PetStatus;
use App\Models\Pet;
use App\Enums\PetSex;
use App\Enums\PetBreeds;
use App\Enums\PetSpecies;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = fake()->randomElement([PetSpecies::DOG, PetSpecies::CAT]);

        $breedList = match ($species) {
            PetSpecies::DOG => PetBreeds::dogs(),
            PetSpecies::CAT => PetBreeds::cats(),
        };
        return [
            'name' => fake()->firstName(),
            'species' => $species->value,
            'breed' => PetBreeds::random($breedList)->value,
            'sex' => fake()->randomElement([PetSex::MALE, PetSex::FEMALE]),
            'coat_color' => fake()->randomElement([
                'Noir', 'Blanc', 'Marron', 'Gris', 'Roux',
                'Tigré', 'Tricolore', 'Beige', 'Crème', 'Chocolat'
            ]),
            'birth_date' => fake()->dateTimeBetween('-10 years', '-6 months'),
            'vaccinations' => fake()->boolean(80)
                ? 'Vaccins à jour (rage, maladie de Carré, parvovirose)'
                : 'Vaccins incomplets - à mettre à jour',
            'personality' => fake()->paragraph(2),
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
