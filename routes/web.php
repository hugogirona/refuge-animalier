<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.home');
});

Route::get('/animals', function () {
    return view('guest.animals.index');
});

Route::get('/animals/moka', function () {
    return view('guest.animals.show');
});

Route::get('/adoption', function () {
    return view('guest.adoption.create');
});

Route::get('/adoption/confirmation', function () {
    return view('guest.adoption.confirmation');
});

Route::get('/about', function () {
    return view('guest.pages.about');
});

Route::get('/contact', function () {
    return view('guest.pages.contact');
});

Route::get('/legal', function () {
    return view('guest.pages.legal');
});
