<?php

namespace Database\Seeders;

use App\Enums\AdoptionRequestStatus;
use App\Enums\PetBreeds;
use App\Enums\PetStatus;
use App\Enums\UserRoles;
use App\Models\AdoptionRequest;
use App\Models\Breed;
use App\Models\ContactMessage;
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
        $this->call(ShelterSeeder::class);

        User::factory(6)->create();
        User::factory()->create(
            [
                'first_name' => 'Thomas',
                'last_name' => 'Martin',
                'role' => UserRoles::VOLUNTEER->value,
                'email' => 'volunteer@refuge.be',
                'password' => 'change_this'
            ]
        );

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
                    ->has(AdoptionRequest::factory(
                        [
                            'status' => AdoptionRequestStatus::NEW,
                        ]
                    )->count(1), 'adoptionRequests')
                    ->has(InternalNote::factory()->count(rand(1, 2)), 'internalNotes')
            )
            ->create([
                'first_name' => 'Elise',
                'last_name' => 'Dubois',
                'role' => UserRoles::ADMIN->value,
                'email' => 'admin@refuge.be',
                'password' => bcrypt('change_this'),
            ]);

        ContactMessage::factory(10)->create();
    }

}
