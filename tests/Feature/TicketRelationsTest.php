<?php

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\User;

it('creates a ticket with associated user', function () {
    $user = User::factory()->create();

    Ticket::factory()->create([
        'subject' => 'Title',
        'user_id' => $user->id,
    ]);

    $this->assertEquals(1, $user->tickets()->count());
    $this->assertEquals('Title', $user->tickets()->first()->subject);
});

it('associates labels to a ticket', function () {
    $labels = Label::factory(5)->create();
    $ticket = Ticket::factory()->create();

    $ticket->attachLabels($labels->pluck('id'));

    $this->assertEquals(5, $ticket->labels()->count());
});

it('sync labels to a ticket', function () {
    $labels = Label::factory(5)->create();
    $ticket = Ticket::factory()->create();

    $ticket->syncLabels($labels->pluck('id'));

    $this->assertEquals(5, $ticket->labels()->count());
});

it('sync labels to a ticket without detaching', function () {
    $labels = Label::factory(5)->create();
    $ticket = Ticket::factory()->create();
    $ticket->attachLabels($labels->pluck('id'));

    $modeLabels = Label::factory(3)->create();

    $ticket->syncLabels($modeLabels->pluck('id'), false);

    $this->assertEquals(8, $ticket->labels()->count());
});

it('associates category to a ticket', function () {
    $category = Category::factory(5)->create([
        'name' => 'Category 1',
    ]);

    $ticket = Ticket::factory()->create();

    $ticket->attachCategory($category->pluck('id'));

    $this->assertEquals('Category 1', $ticket->category()->name);
});

it('sync categories to a ticket', function () {
    $categories = Category::factory(5)->create();
    $ticket = Ticket::factory()->create();

    $ticket->syncCategories($categories->pluck('id'));

    $this->assertEquals(5, $ticket->categories()->count());
});

it('sync categories to a ticket without detaching', function () {
    $categories = Category::factory(5)->create();
    $ticket = Ticket::factory()->create();
    $ticket->attachCategories($categories->pluck('id'));

    $moreCategories = Category::factory(3)->create();

    $ticket->syncCategories($moreCategories->pluck('id'), false);

    $this->assertEquals(8, $ticket->categories()->count());
});

it('can create a message inside the ticket by authenticated user', function () {
    $this->actingAs(User::factory()->create());

    $ticket = Ticket::factory()->create();

    $ticket->message('How are you?');

    $this->assertEquals(1, $ticket->messages()->count());
});

it('can create a message inside the ticket by another user', function () {
    $this->actingAs(User::factory()->create());
    $anotherUser = User::factory()->create();

    $ticket = Ticket::factory()->create();

    $ticket->messageAsUser($anotherUser, 'How are you?');

    $this->assertEquals(1, $ticket->messages()->count());
    $this->assertEquals($anotherUser->id, $ticket->messages()->first()->user_id);
});

it('associate a comment ticket to the current user, if no user is defined', function () {
    $this->actingAs($user = User::factory()->create());

    $ticket = Ticket::factory()->create();

    $ticket->messageAsUser(null, 'How are you?');

    $this->assertEquals(1, $ticket->messages()->count());
    $this->assertEquals($user->id, $ticket->messages()->first()->user_id);
});
