<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Hugo',
            'last_name' => 'Girona',
            'role' => UserRoles::ADMIN->value,
            'phone' => '+33612345678',
            'email' => 'gironahugo@gmail.com',
            'password' => bcrypt('change_this'),
        ]);
    }
}
