<?php

namespace Database\Seeders;

use App\Enums\PetBreeds;
use App\Models\Breed;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    public function run(): void
    {
        foreach (PetBreeds::dogs() as $breedEnum) {
            Breed::firstOrCreate([
                'name' => $breedEnum->value,
                'species' => 'dog',
            ]);
        }
        foreach (PetBreeds::cats() as $breedEnum) {
            Breed::firstOrCreate([
                'name' => $breedEnum->value,
                'species' => 'cat',
            ]);
        }
    }
}
