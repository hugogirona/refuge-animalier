<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\AdoptionRequest;
use App\Models\InternalNote;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        User::factory()
            ->has(Pet::factory(
                [
                    'is_published' => true,
                    'published_at' => now(),
                ]
            )
                ->count(10)
                ->has(AdoptionRequest::factory()->count(2), 'adoptionRequests'))
            ->create([
                'first_name' => 'Hugo',
                'last_name' => 'Girona',
                'role' => UserRoles::VOLUNTEER->value,
                'phone' => '+33612345678',
                'email' => 'gironahugo@gmail.com',
                'password' => bcrypt('change_this'),
            ]);

    }

}
