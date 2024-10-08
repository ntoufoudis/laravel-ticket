<?php

use App\Models\Label;

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
