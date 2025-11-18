<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredAnimals = [
        [
            'name' => 'Moka',
            'breed' => 'Caniche',
            'age' => 5,
            'sex' => 'Mâle',
            'trait' => 'Affectueux',
            'image' => 'moka',
            'slug' => 'moka',
            'status' =>'Disponible'
        ],
        [
            'name' => 'Luna',
            'breed' => 'Berger Australien',
            'age' => 3,
            'sex' => 'Femelle',
            'trait' => 'Affectueux',
            'image' => 'luna',
            'slug' => 'luna',
            'status' =>'Indisponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' =>'Disponible'
        ],
    ];
    $stats = [
        [
            'number' => 127,
            'label' => 'Adoptions réussies',
            'color' => 'orange',
            'icon' => 'heart'
        ],
        [
            'number' => 12,
            'label' => 'Bénévoles actifs',
            'color' => 'green',
            'icon' => 'users'
        ],
        [
            'number' => 23,
            'label' => 'Animaux au refuge',
            'color' => 'blue',
            'icon' => 'paw'
        ],
        [
            'number' => 5,
            'label' => 'Années d\'existence',
            'color' => 'purple',
            'icon' => 'calendar'
        ],
    ];

    return view('guest.home', compact('featuredAnimals', 'stats'));
})->name('home');


Route::get('/pets', function () {

    $featuredAnimals = [
        [
            'name' => 'Moka',
            'breed' => 'Caniche',
            'age' => 5,
            'sex' => 'Mâle',
            'trait' => 'Affectueux',
            'image' => 'moka',
            'slug' => 'moka',
            'status' =>'Disponible'
        ],
        [
            'name' => 'Luna',
            'breed' => 'Berger Australien',
            'age' => 3,
            'sex' => 'Femelle',
            'trait' => 'Affectueux',
            'image' => 'luna',
            'slug' => 'luna',
            'status' =>'Indisponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' =>'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' =>'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' =>'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' =>'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' =>'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' =>'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' =>'Disponible'
        ],
    ];
    return view('guest.animals.index', compact('featuredAnimals'));
})->name('pets.index');

Route::get('/pets/moka', function () {
    return view('guest.animals.show');
})->name('pets.show');

Route::get('/adoption', function () {
    return view('guest.adoption.create');
})->name('adoption.create');

Route::get('/adoption/confirmation', function () {
    return view('guest.adoption.confirmation');
})->name('adoption.confirmation');

Route::get('/about', function () {
    return view('guest.pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('guest.pages.contact');
})->name('contact');

Route::get('/legal', function () {
    return view('guest.pages.legal');
});
