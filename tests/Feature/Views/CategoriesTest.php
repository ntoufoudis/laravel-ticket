<?php

use App\Models\Category;
use Livewire\Livewire;

it('can show create modal', function () {
    $component = Livewire::test('categories')
        ->set('showCreateModal', true);

    $component
        ->assertHasNoErrors()
        ->assertSee('Create new Category');
});

it('can show edit modal', function () {
    $category = Category::factory()->create([
        'name' => 'Test Category',
    ]);

    $component = Livewire::test('categories');

    $component->call('openEditModal', $category->id);

    $component
        ->assertHasNoErrors()
        ->assertSee('Update')
        ->assertSee($category->name);
});

it('can show delete modal', function () {
    $category = Category::factory()->create();

    $component = Livewire::test('categories');
    $component->call('confirmDelete', $category->id);

    $component
        ->assertHasNoErrors()
        ->assertSee('Delete')
        ->assertSee($category->name);
});

it('can close modals', function () {
    $category = Category::factory()->create();

    $component = Livewire::test('categories')
        ->set('updateMode', true)
        ->set('showCreateModal', true)
        ->set('showConfirmDeleteModal', true)
        ->set('state', $category->toArray());

    $component
        ->call('closeModals')
        ->assertSet('updateMode', false)
        ->assertSet('showCreateModal', false)
        ->assertSet('showConfirmDeleteModal', false)
        ->assertSet('state', []);
});

it('can show all categories', function () {
    Category::factory(10)->create();

    Livewire::test('categories')
        ->assertViewHas('categories', function ($categories) {
            return count($categories) === 10;
        });
});

it('can paginate data', function () {
    Category::factory(15)->create();

    Livewire::withQueryParams(['page' => 2])
        ->test('categories')
        ->assertViewHas('categories', function ($categories) {
            return count($categories) === 5;
        });
});

it('can search categories', function () {
    Category::factory()->create([
        'name' => 'Category 1',
    ]);

    Category::factory()->create([
        'name' => 'Category 2',
    ]);

    Livewire::test('categories')
        ->set('search', 'Category 1')
        ->assertSee('Category 1')
        ->assertDontSee('Category 2');
});

it('can sort data', function () {
    $category1 = Category::factory()->create([
        'name' => 'Category 1',
    ]);
    $category2 = Category::factory()->create([
        'name' => 'Category 2',
    ]);

    $component = Livewire::test('categories');

    $component
        ->assertHasNoErrors()
        ->assertSeeInOrder([$category1->name, $category2->name]);

    $component
        ->set('sortColumn', 'name')
        ->set('sortDirection', 'desc');

    $component
        ->assertHasNoErrors()
        ->assertSeeInOrder([$category2->name, $category1->name]);
});

it('can create new category', function () {
    $category = Category::factory()->create();

    Livewire::test('categories')
        ->set('state', $category->toArray())
        ->call('store')
        ->assertSee($category->name);

    $this->assertDatabaseHas('categories', [
        'name' => $category->name,
    ]);
});

it('can update category', function () {
    $category = Category::factory()->create([
        'name' => 'Category 1',
    ]);

    Livewire::test('categories')
        ->set('state', $category->toArray())
        ->set('state.name', 'Category 2')
        ->call('edit')
        ->assertSee('Category 2');

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Category 2',
    ]);
});

it('can delete category', function () {
    $category = Category::factory()->create();

    Livewire::test('categories')
        ->set('state', $category->toArray())
        ->call('delete')
        ->assertDontSee($category->name);

    $this->assertDatabaseMissing('categories', $category->toArray());
});
