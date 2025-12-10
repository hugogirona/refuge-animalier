<?php

namespace Database\Factories;

use App\Enums\AdoptionRequestStatus;
use App\Models\AdoptionRequest;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AdoptionRequest>
 */
class AdoptionRequestFactory extends Factory
    /**
     * @extends Factory<AdoptionRequest>
     */
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pet_id' => Pet::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'zip_code' => fake()->postcode(),


            'accommodation_type' => fake()->randomElement(['house', 'appartement']),
            'has_garden' => fake()->boolean(),


            'has_other_pets' => fake()->sentences(3, true),
            'had_same' => fake()->sentences(3, true),

            // Génération de tableaux pour les champs JSON
            'available_days' => fake()->randomElements(
                ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
                fake()->numberBetween(1, 4)
            ),
            'available_hours' => fake()->randomElements(
                ['morning', 'afternoon', 'evening'],
                fake()->numberBetween(1, 3)
            ),

            'preferred_contact_method' => fake()->randomElement(['email', 'phone']),
            'message' => fake()->paragraph(),
            'newsletter_consent' => fake()->boolean(20),

            'status' => AdoptionRequestStatus::NEW,
            'notified_at' => null,
            'processed_by' => null,
        ];
    }
}

