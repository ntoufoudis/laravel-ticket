<?php

use App\Models\Label;
use Livewire\Livewire;

it('can show create modal', function () {
    $component = Livewire::test('labels')
        ->set('showCreateModal', true);

    $component
        ->assertHasNoErrors()
        ->assertSee('Create new Label');
});

it('can show edit modal', function () {
    $label = Label::factory()->create([
        'name' => 'Test Label',
    ]);

    $component = Livewire::test('labels');

    $component->call('openEditModal', $label->id);

    $component
        ->assertHasNoErrors()
        ->assertSee('Update')
        ->assertSee($label->name);
});

it('can show visibility on update modal', function () {
    $label = Label::factory()->create([
        'name' => 'Test Label',
        'is_visible' => true,
    ]);

    $label2 = Label::factory()->create([
        'name' => 'Test Label 2',
        'is_visible' => false,
    ]);

    Livewire::test('labels')
        ->call('openEditModal', $label->id)
        ->assertSet('state.is_visible', true)
        ->assertNotSet('state.is_visible', false);

    Livewire::test('labels')
        ->call('openEditModal', $label2->id)
        ->assertSet('state.is_visible', false)
        ->assertNotSet('state.is_visible', true);
});

it('can show delete modal', function () {
    $label = Label::factory()->create();

    $component = Livewire::test('labels');
    $component->call('confirmDelete', $label->id);

    $component
        ->assertHasNoErrors()
        ->assertSee('Delete')
        ->assertSee($label->name);
});

it('can close modals', function () {
    $label = Label::factory()->create();

    $component = Livewire::test('labels')
        ->set('updateMode', true)
        ->set('showCreateModal', true)
        ->set('showConfirmDeleteModal', true)
        ->set('state', $label->toArray());

    $component
        ->call('closeModals')
        ->assertSet('updateMode', false)
        ->assertSet('showCreateModal', false)
        ->assertSet('showConfirmDeleteModal', false)
        ->assertSet('state', []);
});

it('can show all labels', function () {
    Label::factory(10)->create();

    Livewire::test('labels')
        ->assertViewHas('labels', function ($labels) {
            return count($labels) === 10;
        });
});

it('can paginate data', function () {
    Label::factory(15)->create();

    Livewire::withQueryParams(['page' => 2])
        ->test('labels')
        ->assertViewHas('labels', function ($labels) {
            return count($labels) === 5;
        });
});

it('can search labels', function () {
    Label::factory()->create([
        'name' => 'Label 1',
    ]);

    Label::factory()->create([
        'name' => 'Label 2',
    ]);

    Livewire::test('labels')
        ->set('search', 'Label 1')
        ->assertSee('Label 1')
        ->assertDontSee('Label 2');
});

it('can sort data', function () {
    $label1 = Label::factory()->create([
        'name' => 'Label 1',
        'slug' => 'Label 1',
    ]);

    $label2 = Label::factory()->create([
        'name' => 'Label 2',
        'slug' => 'Label 2',
    ]);

    $component = Livewire::test('labels');

    $component
        ->assertHasNoErrors()
        ->assertSeeInOrder([$label1->name, $label2->name]);

    $component
        ->set('sortColumn', 'name')
        ->set('sortDirection', 'desc');

    $component
        ->assertHasNoErrors()
        ->assertSeeInOrder([$label2->name, $label1->name]);

    $component
        ->set('sortColumn', 'name')
        ->set('sortDirection', 'asc')
        ->call('doSort', 'name')
        ->assertHasNoErrors()
        ->assertSeeInOrder([$label1->name, $label2->name]);

    $component
        ->call('doSort', 'slug')
        ->assertHasNoErrors()
        ->assertSet('sortColumn', 'slug')
        ->assertSet('sortDirection', 'ASC')
        ->assertSeeInOrder([$label1->name, $label2->name]);
});

it('can create new label', function () {
    Livewire::test('labels')
        ->set('state.name', 'Label 1')
        ->set('state.slug', 'label-1')
        ->set('state.color', 'bg-gray-500')
        ->call('store')
        ->assertSee('Label 1');

    $this->assertEquals('label-1', Label::first()->slug);

    $this->assertDatabaseHas('labels', [
        'name' => 'Label 1',
    ]);
});

it('can update label', function () {
    $label = Label::factory()->create([
        'name' => 'Label 1',
    ]);

    Livewire::test('labels')
        ->set('state', $label->toArray())
        ->set('state.name', 'Label 2')
        ->call('edit')
        ->assertSee('Label 2');

    $this->assertDatabaseHas('labels', [
        'id' => $label->id,
        'name' => 'Label 2',
    ]);
});

it('can delete label', function () {
    $label = Label::factory()->create();

    Livewire::test('labels')
        ->set('state', $label->toArray())
        ->call('delete')
        ->assertDontSee($label->name);

    $this->assertDatabaseMissing('labels', $label->toArray());
});

it('can initialize component with stored page', function () {
    session()->put('page', 2);

    Livewire::test('labels')
        ->assertSet('page', 2);
});

it('can save current page to session', function () {
    Livewire::test('labels')
        ->set('page', 3);

    $this->assertEquals(3, session('page'));
});
