<?php

use App\Livewire\Site\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class) 
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
