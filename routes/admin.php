<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('admin.auth.login');
})->name('login');

Route::get('/forgot-password', function () {
    return view('admin.auth.forgot-password');
})->name('password.request');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/admin/pets', function () {
    return view('admin.pets.index');
})->name('admin-pets.index');

Route::get('/admin/pets/moka', function () {
    return view('admin.pets.show');
})->name('admin-pets.show');

Route::get('/admin/adoptions', function () {
    return view('admin.adoptions.index');
})->name('adoptions.index');

Route::get('/admin/adoptions/1', function () {
    return view('admin.adoptions.show');
})->name('adoptions.show');

Route::get('/admin/users', function () {
    return view('admin.users.index');
})->name('users.index');

Route::get('/admin/users/thomas-martin', function () {
    return view('admin.users.show');
})->name('users.show');

Route::get('/admin/messages', function () {
    return view('admin.messages.index');
})->name('messages.index');

Route::get('/admin/settings', function () {
    return view('admin.settings.index');
})->name('settings.index');

