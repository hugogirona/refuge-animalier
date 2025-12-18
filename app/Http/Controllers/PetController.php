<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(Request $request)
    {
        // Requête de base
        $query = Pet::query()->available();

        // Ici je clone pour ne pas altérer la requête principale
        $statsQuery = clone $query;

        $filters = [
            [
                'id' => '',
                'label' => 'Tous',
                'count' => $statsQuery->count()
            ],
            [
                'id' => 'dog',
                'label' => 'Chiens',
                'count' => (clone $statsQuery)->where('species', 'dog')->count()
            ],
            [
                'id' => 'cat',
                'label' => 'Chats',
                'count' => (clone $statsQuery)->where('species', 'cat')->count()
            ],
        ];

        // clone ici aussi pour la même raison
        $breedsQuery = clone $query;

        // Si déja cliqué sur chat, alors on voit pas les races de chiens
        if ($request->has('species') && $request->species) {
            $breedsQuery->where('species', $request->species);
        }

        $availableBreeds = $breedsQuery
            ->select('breed')
            ->distinct() // pas de doublon
            ->pluck('breed')
            ->mapWithKeys(function ($breedValue) {
                return [$breedValue->value => $breedValue->value];
            })
            ->sort()
            ->toArray();

        //Ici, j'applique les filtres sur la requête principale

        if ($species = $request->input('species')) {
            $query->where('species', $species);
        }

        if ($breed = $request->input('breed')) {
            $query->where('breed', $breed);
        }

        if ($sex = $request->input('sex')) {
            $query->where('sex', $sex);
        }

        if ($ageGroup = $request->input('age')) {
            $now = now();
            match ($ageGroup) {
                'junior' => $query->where('birth_date', '>=', $now->copy()->subYear()),
                'adult' => $query->whereBetween('birth_date', [
                    $now->copy()->subYears(8),
                    $now->copy()->subYear()
                ]),
                'senior' => $query->where('birth_date', '<', $now->copy()->subYears(8)),
                default => null,
            };
        }

        $pets = $query->latest('published_at')->paginate(9)->withQueryString();

        return view('pages.public.pets.index', compact('pets', 'filters', 'availableBreeds', 'query'));
    }


    public function show(Pet $pet)
    {
        $random_pets = Pet::query()
            ->available()
            ->where('id', '!=', $pet->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.public.pets.show', compact('pet', 'random_pets'));
    }

}
