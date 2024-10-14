<?php

use App\Livewire\Pages\Frontend\Tickets\CreateTicket;
use App\Models\Category;
use App\Models\User;
use Database\Factories\TicketFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

it('can render create_ticket_form', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(CreateTicket::class)
        ->assertSeeLivewire('pages.frontend.tickets.create-ticket');
});

it('can assign logged in user', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(CreateTicket::class)
        ->assertSet('user', $user);
});

it('can create a ticket with attachment', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Http::fake([
        'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => true], 200),
    ]);

    $category = Category::factory()->create();

    Storage::fake('public');
    $file = UploadedFile::fake()->create('ticket.pdf');

    Livewire::test(CreateTicket::class)
        ->set('ticket.category', $category->id)
        ->set('ticket.subject', 'Subject')
        ->set('ticket.priority', 'high')
        ->set('ticket.description', 'Description')
        ->set('ticket.attachments', $file)
        ->set('gRecaptchaResponse', 'success')
        ->call('store')
        ->assertHasNoErrors()
        ->assertRedirect(route('home', absolute: false));
});

