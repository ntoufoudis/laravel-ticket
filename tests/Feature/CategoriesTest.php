<?php

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;

it('can render categories view', function () {
    Livewire::test('pages.dashboard.categories.index')
        ->assertHasNoErrors()
        ->assertSee('Categories');
});

it('can initialize component with stored page', function () {
    session()->put('page', 2);

    Livewire::test('pages.dashboard.categories.index')
        ->assertSet('page', 2);
});

it('can save current page to session', function () {
    Livewire::test('pages.dashboard.categories.index')
        ->set('page', 3);

    $this->assertEquals(3, session('page'));
});

it('can show all categories', function () {
    Category::factory(10)->create();

    Livewire::test('pages.dashboard.categories.index')
        ->assertViewHas('categories', function ($categories) {
            return count($categories) === 10;
        });
});

it('can reset page', function () {
    Livewire::test('pages.dashboard.categories.index')
        ->dispatch('force-refresh')
        ->assertHasNoErrors();
});

it('can create new category', function () {
    Livewire::test('pages.dashboard.categories.create-modal')
        ->set('state.name', 'Category 1')
        ->set('state.slug', 'category-1')
        ->call('store')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.categories.index')
        ->assertSee('Category 1');

    $this->assertEquals(1, Category::count());

    $this->assertDatabaseHas('categories', [
        'name' => 'Category 1',
        'slug' => 'category-1',
    ]);
});

it('can close create modal', function () {
    Livewire::test('pages.dashboard.categories.create-modal')
        ->set('state.name', 'Category 1')
        ->call('closeModal')
        ->assertDispatched('close-modal')
        ->assertSet('state.name', '');
});

it('can show edit modal', function () {
    $category = Category::factory()->create();

    Livewire::test('pages.dashboard.categories.edit-modal')
        ->set('id', $category->id)
        ->call('openEdit')
        ->assertSet('state', $category->toArray())
        ->assertSet('showEdit', true);

});

it('can update category', function () {
    $category = Category::factory()->create([
        'name' => 'Category 1',
        'slug' => 'category-1',
    ]);


    Livewire::test('pages.dashboard.categories.edit-modal')
        ->set('category', $category)
        ->set('state', $category->toArray())
        ->set('state.name', 'Category Updated')
        ->call('edit')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.categories.index')
        ->assertSee('Category Updated');

    $this->assertDatabaseHas('categories', [
        'name' => 'Category Updated',
        'slug' => 'category-1',
    ]);
});

it('can show delete modal', function () {
    $category = Category::factory()->create();

    Livewire::test('pages.dashboard.categories.delete-modal')
        ->set('id', $category->id)
        ->call('openDelete')
        ->assertSet('showDelete', true);
});

it('can delete category', function () {
    $category = Category::factory()->create([
        'name' => 'Category 1',
        'slug' => 'category-1',
    ]);

    Livewire::test('pages.dashboard.categories.delete-modal')
        ->set('category', $category)
        ->call('delete')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.categories.index')
        ->assertDontSee('Category 1');
});

it('can show tickets from a specific category', function () {
    Category::factory(5)->create();
    $label = Label::factory()->create();

    $tickets = Ticket::factory(20)->create([
        'category_id' => 1,
        'label_id' => $label->id,
    ]);

    foreach ($tickets as $ticket) {
        $ticket->category()->associate(rand(1, 5))->save();
    }

    $ticketCount = Ticket::where('category_id', 1)->count();

    Livewire::test('pages.dashboard.categories.tickets', ['id' => 1])
        ->assertViewHas('tickets', function ($tickets) use ($ticketCount) {
            return count($tickets) === $ticketCount;
        });
});
