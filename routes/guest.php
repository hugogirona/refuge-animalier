<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $featured_pets = [
        [
            'name' => 'Moka',
            'breed' => 'Caniche',
            'age' => 5,
            'sex' => 'Mâle',
            'trait' => 'Affectueux',
            'image' => 'moka',
            'slug' => 'moka',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Luna',
            'breed' => 'Berger Australien',
            'age' => 3,
            'sex' => 'Femelle',
            'trait' => 'Affectueux',
            'image' => 'luna',
            'slug' => 'luna',
            'status' => 'Indisponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Disponible'
        ],
    ];
    $stats = [
        [
            'number' => 127,
            'label' => __('guest/home.stats.adoptions'),
            'color' => 'orange',
            'icon' => 'heart'
        ],
        [
            'number' => 12,
            'label' => __('guest/home.stats.volunteers'),
            'color' => 'green',
            'icon' => 'users'
        ],
        [
            'number' => 23,
            'label' => __('guest/home.stats.animals'),
            'color' => 'blue',
            'icon' => 'paw'
        ],
        [
            'number' => 5,
            'label' => __('guest/home.stats.years'),
            'color' => 'purple',
            'icon' => 'calendar'
        ],
    ];

    return view('pages.guest.home.index', compact('featured_pets', 'stats'));
})->name('home');

Route::get('/pets', function () {

    $featured_pets = [
        [
            'name' => 'Moka',
            'breed' => 'Caniche',
            'age' => 5,
            'sex' => 'Mâle',
            'trait' => 'Affectueux',
            'image' => 'moka',
            'slug' => 'moka',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Luna',
            'breed' => 'Berger Australien',
            'age' => 3,
            'sex' => 'Femelle',
            'trait' => 'Affectueux',
            'image' => 'luna',
            'slug' => 'luna',
            'status' => 'Indisponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Indisponible'
        ],
    ];
    return view('pages.guest.pets.index', compact('featured_pets'));
})->name('pets.index');

Route::get('/pets/moka', function () {

    $featured_pets = [
        [
            'name' => 'Moka',
            'breed' => 'Caniche',
            'age' => 5,
            'sex' => 'Mâle',
            'trait' => 'Affectueux',
            'image' => 'moka',
            'slug' => 'moka',
            'status' => 'Disponible'
        ],
        [
            'name' => 'Luna',
            'breed' => 'Berger Australien',
            'age' => 3,
            'sex' => 'Femelle',
            'trait' => 'Affectueux',
            'image' => 'luna',
            'slug' => 'luna',
            'status' => 'Indisponible'
        ],
        [
            'name' => 'Rex',
            'breed' => 'Berger Allemand',
            'age' => 4,
            'sex' => 'Mâle',
            'trait' => 'Joueur',
            'image' => 'rex',
            'slug' => 'rex',
            'status' => 'Disponible'
        ],
    ];

    return view('pages.guest.pets.show', compact('featured_pets'));
})->name('pets.show');

Route::get('/adoption', function () {
    return view('pages.guest.adoption.create');
})->name('adoption.create');

Route::get('/adoption/confirmation', function () {
    return view('pages.guest.adoption.confirmation');
})->name('adoption.confirmation');

Route::get('/about', function () {
    $team_members = [
        ['name' => 'Élise Dubois', 'role' => 'Fondatrice', 'image' => 'elise'],
        ['name' => 'Thomas Martin', 'role' => 'Étudiant vétérinaire', 'image' => 'thomas'],
        ['name' => 'Sophie Leroux', 'role' => 'Éducatrice canine', 'image' => 'sophie'],
        ['name' => 'Marc Durand', 'role' => 'Retraité', 'image' => 'marc'],
        ['name' => 'Julie Bernard', 'role' => 'Toiletteuse', 'image' => 'julie'],
        ['name' => 'David Petit', 'role' => 'Photographe', 'image' => 'david'],
        ['name' => 'Lucas Moreau', 'role' => 'Étudiant', 'image' => 'lucas'],
        ['name' => 'Emma Rousseau', 'role' => 'Enseignante', 'image' => 'emma'],
    ];

    return view('pages.guest.about.index', compact('team_members'));
})->name('about');

Route::get('/contact', function () {
    return view('pages.guest.contact.index');
})->name('contact');

Route::get('/legal', function () {
    return view('pages.guest.legal.index');
})->name('legal');
