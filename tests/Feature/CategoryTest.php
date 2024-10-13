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
