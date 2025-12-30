<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {


    Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::get(LaravelLocalization::transRoute('routes.pets'), [PetController::class, 'index'])
        ->name('pets.index');


    Route::get(LaravelLocalization::transRoute('routes.pets_show'), [PetController::class, 'show'])
        ->name('pets.show');


    Route::get(LaravelLocalization::transRoute('routes.adoption_create'), [AdoptionRequestController::class, 'create'])
        ->name('adoption.create');

    Route::post(LaravelLocalization::transRoute('routes.adoption_store'), [AdoptionRequestController::class, 'store'])
        ->name('adoption.store');

    Route::get(LaravelLocalization::transRoute('routes.adoption_confirmation'), [AdoptionRequestController::class, 'confirm'])
        ->name('adoption.confirmation');


    Route::get(LaravelLocalization::transRoute('routes.about'), [AboutController::class, 'index'])
        ->name('about');


    Route::get(LaravelLocalization::transRoute('routes.contact'), [ContactMessageController::class, 'create'])
        ->name('contact.create');

    Route::post(LaravelLocalization::transRoute('routes.contact'), [ContactMessageController::class, 'store'])
        ->name('contact.store');

});
