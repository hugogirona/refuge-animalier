<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;


Route::get('/',
    [HomeController::class, 'index'])->name('home');

Route::get('/pets',
    [PetController::class, 'index'])->name('pets.index');

Route::get('/pets/{pet}',
    [PetController::class, 'show'])->name('pets.show');

Route::get('/adoption/{pet}',
    [AdoptionRequestController::class, 'create'])->name('adoption.create');

Route::post('/adoption',
    [AdoptionRequestController::class, 'store'])->name('adoption.store');

Route::get('/adoption/confirmation/{adoption_request}',
    [AdoptionRequestController::class, 'confirm'])->name('adoption.confirmation');

Route::get('/about',
    [AboutController::class, 'index'])->name('about');

Route::get('/contact',
    [ContactMessageController::class, 'create'])->name('contact.create');

Route::post('/contact',
    [ContactMessageController::class, 'store'])->name('contact.store');

Route::get('/legal', function () {
    return view('pages.public.legal.index');
})->name('legal');
