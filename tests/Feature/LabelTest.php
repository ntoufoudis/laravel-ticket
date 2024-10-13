<?php

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;

it('can create a label', function () {
    Label::factory()->create([
        'name' => 'Label',
        'slug' => 'label',
    ]);

    $this->assertDatabaseHas('labels', [
        'name' => 'Label',
        'slug' => 'label',
    ]);

    $this->assertEquals(1, Label::count());
});

it('can get labels by visibility status', function () {
    Label::factory(10)->create([
        'is_visible' => true,
    ]);

    Label::factory(5)->create([
        'is_visible' => false,
    ]);

    $this->assertEquals(15, Label::count());
    $this->assertEquals(10, Label::visible()->count());
    $this->assertEquals(5, Label::hidden()->count());
});

it('can attach label to a ticket', function () {
    $category = Category::factory()->create();
    $label = Label::factory()->create();
    $ticket = Ticket::factory()->create([
        'category_id' => $category->id,
    ]);

    $label->tickets()->attach($ticket);

    $this->assertEquals(1, $label->tickets->count());
});

it('can detach label from a ticket', function () {
    $category = Category::factory()->create();
    $label = Label::factory()->create();
    $ticket = Ticket::factory()->create([
        'category_id' => $category->id,
    ]);

    $ticket->attachLabels($label);

    $this->assertEquals(1, $label->tickets()->count());

    $label->tickets()->detach($ticket);

    $this->assertEquals(0, $label->tickets()->count());
});
