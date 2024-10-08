<?php

use App\Models\Category;

it('can store a category', function () {
   $category = Category::factory()->create([
       'name' => 'Support',
       'slug' => 'support',
   ]);

   $this->assertDatabaseHas('categories', [
       'name' => 'Support',
       'slug' => 'support',
   ]);

   $this->assertEquals(Category::count(), 1);
});
