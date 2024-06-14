<?php

use App\Livewire\Site\Dashboard;
use Illuminate\Support\Facades\Route;

// Route::get('/', Dashboard::class)
//     ->name('dashboard');

// Route::get('about', App\Livewire\Site\About::class)
//     ->name('about');

// Route::get('contact', \App\Livewire\Site\Contact::class)
//     ->name('contact');

// Route::get('termos-de-uso', \App\Livewire\Site\Terms::class)
//     ->name('terms');

// Route::get('politica-de-privacidade', \App\Livewire\Site\Policy::class)
//     ->name('policy');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
