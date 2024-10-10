<?php

use App\Livewire\Categories;
use App\Livewire\Labels;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');
        Route::get('/labels', Labels::class)->name('labels.index');
        Route::get('/categories', Categories::class)->name('labels.index');
    });
});
