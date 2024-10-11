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
