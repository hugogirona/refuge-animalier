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

    return view('guest.home', compact('featuredAnimals'));
})->name('home');


Route::get('/pets', function () {
    return view('guest.animals.index');
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
