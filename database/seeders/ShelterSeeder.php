<?php

namespace Database\Seeders;

use App\Models\Shelter;
use Illuminate\Database\Seeder;

class ShelterSeeder extends Seeder {
    public function run (): void
    {
        Shelter::factory()->create();
    }
}
