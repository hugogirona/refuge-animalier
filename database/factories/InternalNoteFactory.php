<?php

namespace Database\Factories;

use App\Models\AdoptionRequest;
use App\Models\InternalNote;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InternalNote>
 */
class InternalNoteFactory extends Factory
{
    public function definition(): array
    {

        $targetClass = fake()->randomElement([
            Pet::class,
            AdoptionRequest::class,
        ]);

        return [
            'content' => fake()->paragraph(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),

            'notable_type' => (new $targetClass)->getMorphClass(),

            'notable_id' => $targetClass::factory(),
        ];
    }

}
