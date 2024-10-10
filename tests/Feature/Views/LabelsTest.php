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
    ]);
    $label2 = Label::factory()->create([
        'name' => 'Label 2',
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
});

it('can create new label', function () {
    $label = Label::factory()->create();

    Livewire::test('labels')
        ->set('state', $label->toArray())
        ->call('store')
        ->assertSee($label->name);

    $this->assertDatabaseHas('labels', [
        'name' => $label->name,
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
