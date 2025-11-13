<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.home');
})->name('home');

Route::get('/animals', function () {
    return view('guest.animals.index');
})->name('animals.index');

Route::get('/animals/moka', function () {
    return view('guest.animals.show');
})->name('animals.show');

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
