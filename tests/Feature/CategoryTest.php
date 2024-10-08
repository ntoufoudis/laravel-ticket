<?php

use App\Models\Category;
use App\Models\Ticket;

it('can create a category', function () {
    Category::factory()->create([
        'name' => 'Support',
        'slug' => 'support',
    ]);

    $this->assertDatabaseHas('categories', [
        'name' => 'Support',
        'slug' => 'support',
    ]);

    $this->assertEquals(1, Category::count());
});

it('can get categories by visibility status', function () {
    Category::factory(10)->create([
        'is_visible' => true,
    ]);

    Category::factory(5)->create([
        'is_visible' => false,
    ]);

    $this->assertEquals(15, Category::count());
    $this->assertEquals(10, Category::visible()->count());
    $this->assertEquals(5, Category::hidden()->count());
});

it('can attach category to a ticket', function () {
    $category = Category::factory()->create();
    $ticket = Ticket::factory()->create();

    $category->tickets()->attach($ticket);

    $this->assertEquals(1, $category->tickets()->count());
});

it('can detach category from a ticket', function () {
    $category = Category::factory()->create();
    $ticket = Ticket::factory()->create();

    $ticket->attachCategories($category);

    $this->assertEquals(1, $category->tickets()->count());

    $category->tickets()->detach($ticket);

    $this->assertEquals(0, $category->tickets()->count());
});
