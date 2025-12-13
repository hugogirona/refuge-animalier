<?php

namespace App\Http\Controllers;

use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::query()
            ->available()
            ->latest('published_at')
            ->paginate(9);

        return view('pages.public.pets.index', [
            'pets' => $pets
        ]);
    }

    public function show(Pet $pet)
    {
        $random_pets = Pet::query()
            ->available()
            ->where('id', '!=', $pet->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.public.pets.show',
            ['pet' => $pet, 'random_pets' => $random_pets]);
    }

}
