<?php

use App\Livewire\Categories;
use App\Livewire\Home;
use App\Livewire\Labels;
use App\Livewire\Tickets\TicketForm;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tickets', TicketForm::class)->name('tickets.create');
    Route::get('/home', Home::class)->name('home');
    Route::prefix('dashboard')->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');
        Route::get('/labels', Labels::class)->name('labels.index');
        Route::get('/categories', Categories::class)->name('labels.index');
    });
});

