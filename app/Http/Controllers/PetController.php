<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::query()->available()->with('breed');

        $filters = [
            [
                'id' => '',
                'label' => 'Tous',
                'count' => Pet::query()->available()->count()
            ],
            [
                'id' => 'dog',
                'label' => 'Chiens',
                'count' => Pet::query()->available()->where('species', 'dog')->count()
            ],
            [
                'id' => 'cat',
                'label' => 'Chats',
                'count' => Pet::query()->available()->where('species', 'cat')->count()

        ],
        ];

        $availableBreeds = Pet::query()
            ->available()
            ->when($request->species, function ($q) use ($request) {
                $q->where('pets.species', $request->species);
            })
            ->join('breeds', 'pets.breed_id', '=', 'breeds.id')
            ->select('breeds.id', 'breeds.name')
            ->distinct()
            ->orderBy('breeds.name')
            ->pluck('name', 'id')
            ->toArray();


        if ($species = $request->input('species')) {
            $query->where('species', $species);
        }

        if ($breedId = $request->input('breed')) {
            $query->where('breed_id', $breedId);
        }

        if ($sex = $request->input('sex')) {
            $query->where('sex', $sex);
        }

        if ($ageGroup = $request->input('age')) {
            $now = now();
            match ($ageGroup) {
                'junior' => $query->where('birth_date', '>=', $now->copy()->subYear()),
                'adult'  => $query->whereBetween('birth_date', [
                    $now->copy()->subYears(8),
                    $now->copy()->subYear()
                ]),
                'senior' => $query->where('birth_date', '<', $now->copy()->subYears(8)),
                default  => null,
            };
        }

        $pets = $query->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('pages.public.pets.index', compact('pets', 'filters', 'availableBreeds'));
    }

    public function show(Pet $pet)
    {
        if (! $pet->isAvailable()) {
            abort(404);
        }

        $expectedUrl = route('pets.show', $pet);
        if (request()->url() !== $expectedUrl) {
            return redirect($expectedUrl, 301);
        }

        $random_pets = Pet::query()
            ->available()
            ->where('id', '!=', $pet->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.public.pets.show', compact('pet', 'random_pets'));
    }
}
