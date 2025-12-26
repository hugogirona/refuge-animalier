<?php

namespace Database\Factories;

use App\Models\Shelter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShelterFactory extends Factory
{
    protected $model = Shelter::class;

    public function definition(): array
    {
        return [
            'name' => 'Les Pattes Heureuses',
            'address' => '123 rue des Animaux',
            'zip_code' => '1000',
            'city' => 'Bruxelles',
            'phone' => '+32 212 34 56 78',
            'email' => 'contact@lespattesheureuses.com',
        ];
    }
}
