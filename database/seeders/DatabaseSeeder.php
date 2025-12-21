<?php

namespace Database\Seeders;

use App\Enums\PetBreeds;
use App\Enums\PetStatus;
use App\Enums\UserRoles;
use App\Models\AdoptionRequest;
use App\Models\Breed;
use App\Models\InternalNote;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Random\RandomException;

class DatabaseSeeder extends Seeder
{
    /*
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BreedSeeder::class);

        User::factory()
            ->has(
                Pet::factory()
                    ->count(15)
                    ->state(fn (array $attributes, User $user) => [
                        'status' => fake()->randomElement([
                            PetStatus::AVAILABLE,
                            PetStatus::IN_CARE,
                            PetStatus::ADOPTED,
                            PetStatus::ADOPTION_PENDING,
                        ]),
                        'is_published' => fake()->boolean(),
                        'published_at' => now(),
                    ])
                    ->has(AdoptionRequest::factory()->count(2), 'adoptionRequests')
                    ->has(InternalNote::factory()->count(rand(1, 2)), 'internalNotes')
            )
            ->create([
                'first_name' => 'Hugo',
                'last_name' => 'Girona',
                'role' => UserRoles::ADMIN->value,
                'phone' => '+33612345678',
                'email' => 'gironahugo@gmail.com',
                'password' => bcrypt('change_this'),
            ]);

    }

}
