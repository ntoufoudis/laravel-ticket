<?php

use App\Livewire\Tickets\TicketForm;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('can render the create ticket form', function () {
    $response = $this->get(route('tickets.create'));

    $response
        ->assertOK()
        ->assertSeeLivewire('tickets.ticket-form');
});

it('can upload file', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('avatar.jpg');

    Livewire::test(TicketForm::class)
        ->set('photos', $file)
        ->call('upload');

    Storage::disk('public')->assertExists('avatar.jpg');
});

it('can upload multiple files', function () {
    Storage::fake('public');

    $file1 = UploadedFile::fake()->image('avatar1.jpg');
    $file2 = UploadedFile::fake()->image('avatar2.jpg');

    Livewire::test(TicketForm::class)
        ->set('photos', [$file1, $file2])
        ->call('upload');

    Storage::disk('public')->assertExists('avatar1.jpg');
    Storage::disk('public')->assertExists('avatar2.jpg');

});
