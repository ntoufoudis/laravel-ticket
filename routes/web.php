<?php

use App\Livewire\Pages\Dashboard\Categories\Index as CategoriesIndex;
use App\Livewire\Pages\Dashboard\Labels\Index as LabelsIndex;
use App\Livewire\Pages\Dashboard\Teams\Index as TeamsIndex;
use App\Livewire\Pages\Dashboard\Tickets\Index as TicketsIndex;
use App\Livewire\Pages\Frontend\Home;
use App\Livewire\Pages\Frontend\Tickets\Show;
use App\Livewire\Pages\Frontend\Tickets\TicketForm;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tickets', TicketForm::class)->name('tickets.create');
    Route::get('/ticket/{id}', Show::class)->name('tickets.show');
    Route::get('/home', Home::class)->name('home');
    Route::prefix('dashboard')->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');
        Route::get('/tickets', TicketsIndex::class)->name('tickets.index');
        Route::get('/labels', LabelsIndex::class)->name('labels.index');
        Route::get('/categories', CategoriesIndex::class)->name('categories.index');
        Route::get('/teams', TeamsIndex::class)->name('teams.index');
    });
});

