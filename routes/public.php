<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/pets', [PetController::class, 'index'])->name('pets.index');

Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');

Route::get('/adoption', function () {
    return view('pages.public.adoption.create');
})->name('adoption.create');

Route::get('/adoption/confirmation', function () {
    return view('pages.public.adoption.confirmation');
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

    return view('pages.public.about.index', compact('team_members'));
})->name('about');

Route::get('/contact', function () {
    return view('pages.public.contact.index');
})->name('contact');

Route::get('/legal', function () {
    return view('pages.public.legal.index');
})->name('legal');
