<?php

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;

it('can create a message', function () {
    Message::factory()->create([
        'message' => 'Message body',
    ]);

    $this->assertDatabaseHas('messages', [
        'message' => 'Message body',
    ]);

    $this->assertEquals(1, Message::count());
});

it('can attach message to a ticket', function () {
    $message = Message::factory()->create();
    $ticket = Ticket::factory()->create([
        'title' => 'Can you create a message?',
    ]);

    $message->ticket()->associate($ticket);

    $this->assertEquals('Can you create a message?', $message->ticket->title);
});

it('can be associated to a user', function () {
    $user = User::factory()->create([
        'name' => 'John Doe',
    ]);

    $message = Message::factory()->create();

    $message->user()->associate($user);

    $this->assertEquals('John Doe', $message->user->name);
});
