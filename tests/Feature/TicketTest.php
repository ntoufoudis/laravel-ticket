<?php

use App\Models\Ticket;
use App\Models\User;

it('can create a ticket', function () {
    Ticket::factory()->create([
        'title' => 'Ticket 1',
        'message' => 'Message body',
    ]);

    $this->assertDatabaseHas('tickets', [
        'title' => 'Ticket 1',
        'message' => 'Message body',
    ]);

    $this->assertEquals(1, Ticket::count());
});

it('filters tickets by status', function () {
    Ticket::factory(3)->create([
        'status' => 'open',
    ]);

    Ticket::factory(2)->create([
        'status' => 'closed',
    ]);

    Ticket::factory(1)->create([
        'status' => 'archived',
    ]);

    $this->assertEquals(6, Ticket::count());
    $this->assertEquals(3, Ticket::opened()->count());
    $this->assertEquals(2, Ticket::closed()->count());
    $this->assertEquals(1, Ticket::archived()->count());
    $this->assertEquals(5, Ticket::unArchived()->count());
});

it('filters tickets by resolved status', function () {
    Ticket::factory(3)->create([
        'is_resolved' => true,
    ]);

    Ticket::factory(2)->create([
        'is_resolved' => false,
    ]);

    $this->assertEquals(5, Ticket::count());
    $this->assertEquals(3, Ticket::resolved()->count());
    $this->assertEquals(2, Ticket::unresolved()->count());
});

it('filters tickets by locked status', function () {
    Ticket::factory(3)->create([
        'is_locked' => true,
    ]);

    Ticket::factory(2)->create([
        'is_locked' => false,
    ]);

    $this->assertEquals(5, Ticket::count());
    $this->assertEquals(3, Ticket::locked()->count());
    $this->assertEquals(2, Ticket::unLocked()->count());
});

it('filters tickets by priority status', function () {
    Ticket::factory(3)->create([
        'priority' => 'high',
    ]);

    Ticket::factory(2)->create([
        'priority' => 'normal',
    ]);

    Ticket::factory(5)->create([
        'priority' => 'low',
    ]);

    $this->assertEquals(10, Ticket::count());
    $this->assertEquals(3, Ticket::withHighPriority()->count());
    $this->assertEquals(2, Ticket::withNormalPriority()->count());
    $this->assertEquals(5, Ticket::withLowPriority()->count());
});

it('can close the ticket', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $ticket->close();

    $this->assertEquals('closed', $ticket->status);
});

it('can reopen the ticket', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $ticket->reopen();

    $this->assertEquals('open', $ticket->status);
});

it('can check if the ticket is open/closed/archived', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $archivedTicket = Ticket::factory()->create([
        'status' => 'archived',
    ]);

    $closedTicket = Ticket::factory()->create([
        'status' => 'closed',
    ]);

    $this->assertTrue($ticket->isOpen());
    $this->assertTrue($archivedTicket->isArchived());
    $this->assertTrue($closedTicket->isClosed());
});

it('can check if the ticket is resolved or unresolved', function () {
    $ticket = Ticket::factory()->create([
        'is_resolved' => true,
    ]);

    $anotherTicket = Ticket::factory()->create([
        'is_resolved' => false,
    ]);

    $this->assertTrue($ticket->isResolved());
    $this->assertTrue($anotherTicket->isUnResolved());
});

it('can mark a ticket as archived', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $ticket->markAsArchived();

    $this->assertTrue($ticket->isArchived());
});

it('can mark a ticket as resolved', function () {
    $ticket = Ticket::factory()->create([
        'is_resolved' => false,
    ]);

    $ticket->markAsResolved();

    $this->assertTrue($ticket->isResolved());
});

it('can mark a ticket as locked', function () {
    $ticket = Ticket::factory()->create([
        'is_locked' => false,
    ]);

    $ticket->markAsLocked();

    $this->assertTrue($ticket->isLocked());
});

it('can mark a ticket as unlocked', function () {
    $ticket = Ticket::factory()->create([
        'is_locked' => true,
    ]);

    $ticket->markAsUnlocked();

    $this->assertTrue($ticket->isUnlocked());
});

it('can mark a ticket as closed & resolved', function () {
    $ticket = Ticket::factory()->create([
        'is_resolved' => false,
        'status' => 'open',
    ]);

    $ticket->closeAsResolved();

    $this->assertTrue($ticket->isClosed());
    $this->assertTrue($ticket->isResolved());
});

it('can mark a ticket as closed & unresolved', function () {
    $ticket = Ticket::factory()->create([
        'is_resolved' => true,
        'status' => 'open',
    ]);

    $ticket->closeAsUnresolved();

    $this->assertTrue($ticket->isClosed());
    $this->assertTrue($ticket->isUnResolved());
});

it('can mark a ticket as reopened & unresolved', function () {
    $ticket = Ticket::factory()->create([
        'is_resolved' => true,
        'status' => 'closed',
    ]);

    $ticket->reopenAsUnresolved();

    $this->assertTrue($ticket->isOpen());
    $this->assertTrue($ticket->isUnresolved());
});

it('can mark a ticket as locked & unlocked', function () {
    $ticket = Ticket::factory()->create([
        'is_locked' => false,
    ]);

    $lockedTicket = Ticket::factory()->create([
        'is_locked' => true,
    ]);

    $ticket->reopenAsUnresolved();

    $this->assertTrue($ticket->isUnlocked());
    $this->assertTrue($lockedTicket->isLocked());
});

it('ensures ticket methods are chainable', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
        'is_locked' => false,
    ]);

    $ticket->archive()->markAsLocked();

    $this->assertTrue($ticket->isLocked());
    $this->assertTrue($ticket->isArchived());
});

it('can delete a ticket', function () {
    $ticket = Ticket::factory()->create();

    $ticket->delete();

    $this->assertEquals(0, Ticket::count());
});

it('can assign ticket to a user using user model', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->create();

    $ticket->assignTo($agent);

    expect($ticket->assigned_to)->toBe($agent);
});

it('can assign ticket to a user using user id', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->create();

    $ticket->assignTo($agent->id);

    expect($ticket->assigned_to)->toBe($agent->id);
});

it('can mark a ticket priority as low', function () {
    $ticket = Ticket::factory()->create([
        'priority' => 'high',
    ]);

    $ticket->makePriorityAsLow();

    $this->assertEquals('low', $ticket->priority);
});

it('can mark a ticket priority as normal', function () {
    $ticket = Ticket::factory()->create([
        'priority' => 'high',
    ]);

    $ticket->makePriorityAsNormal();

    $this->assertEquals('normal', $ticket->priority);
});

it('can mark a ticket priority as high', function () {
    $ticket = Ticket::factory()->create([
        'priority' => 'low',
    ]);

    $ticket->makePriorityAsHigh();

    $this->assertEquals('high', $ticket->priority);
});
