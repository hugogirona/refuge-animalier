<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::livewire('/admin/dashboard', 'pages::admin/dashboard.index')->name('dashboard.index');
    Route::livewire('/admin/pets', 'pages::admin/pets.index',)->name('admin-pets.index');
    Route::livewire('/admin/pets/moka', 'pages::admin/pets.show')->name('admin-pets.show');
    Route::livewire('/admin/adoptions', 'pages::admin/adoptions.index')->name('adoptions.index');
    Route::livewire('/admin/adoptions/1', 'pages::admin/adoptions.show')->name('adoptions.show');
    Route::livewire('/admin/users', 'pages::admin/users.index')->name('users.index');
    Route::livewire('/admin/users/thomas-martin', 'pages::admin/users.show')->name('users.show');
    Route::livewire('/admin/messages', 'pages::admin/messages.index')->name('messages.index');
    Route::livewire('/admin/settings', 'pages::admin/settings.index')->name('settings.index');
});


