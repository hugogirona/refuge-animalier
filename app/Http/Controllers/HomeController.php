<?php

namespace App\Http\Controllers;

use App\Models\Pet;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            [
                'number' => 127,
                'label' => __('public/home.stats.adoptions'),
                'color' => 'orange',
                'icon' => 'heart'
            ],
            [
                'number' => 12,
                'label' => __('public/home.stats.volunteers'),
                'color' => 'green',
                'icon' => 'users'
            ],
            [
                'number' => 23,
                'label' => __('public/home.stats.animals'),
                'color' => 'blue',
                'icon' => 'paw'
            ],
            [
                'number' => 5,
                'label' => __('public/home.stats.years'),
                'color' => 'purple',
                'icon' => 'calendar'
            ],
        ];
        $random_pets = Pet::query()
            ->available()
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.public.home.index', compact('random_pets', 'stats'));
    }
}
