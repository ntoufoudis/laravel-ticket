<?php

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;

it('can render labels view', function () {
    Livewire::test('pages.dashboard.labels.index')
        ->assertHasNoErrors()
        ->assertSee('Labels');
});

it('can initialize component with stored page', function () {
    session()->put('page', 2);

    Livewire::test('pages.dashboard.labels.index')
        ->assertSet('page', 2);
});

it('can save current page to session', function () {
    Livewire::test('pages.dashboard.labels.index')
        ->set('page', 3);

    $this->assertEquals(3, session('page'));
});

it('can show all labels', function () {
    Label::factory(10)->create();

    Livewire::test('pages.dashboard.labels.index')
        ->assertViewHas('labels', function ($labels) {
            return count($labels) === 10;
        });
});

it('can reset page', function () {
    Livewire::test('pages.dashboard.labels.index')
        ->dispatch('force-refresh')
        ->assertHasNoErrors();
});

it('can create new label', function () {
    Livewire::test('pages.dashboard.labels.create-modal')
        ->set('state.name', 'Label 1')
        ->set('state.slug', 'label-1')
        ->set('state.color', 'bg-gray-500')
        ->call('store')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.labels.index')
        ->assertSee('Label 1');

    $this->assertEquals(1, Label::count());

    $this->assertDatabaseHas('labels', [
        'name' => 'Label 1',
        'slug' => 'label-1',
    ]);
});

it('can close create modal', function () {
    Livewire::test('pages.dashboard.labels.create-modal')
        ->set('state.name', 'Label 1')
        ->call('closeModal')
        ->assertDispatched('close-modal')
        ->assertSet('state.name', '');
});

it('can show edit modal', function () {
    $label = Label::factory()->create([
        'color' => 'bg-gray-500',
    ]);

    Livewire::test('pages.dashboard.labels.edit-modal')
        ->set('id', $label->id)
        ->call('openEdit')
        ->assertSet('state', $label->toArray())
        ->assertSet('showEdit', true);

});

it('can update label', function () {
    $label = Label::factory()->create([
        'name' => 'Label 1',
        'slug' => 'label-1',
        'color' => 'bg-gray-500',
    ]);

    Livewire::test('pages.dashboard.labels.edit-modal')
        ->set('label', $label)
        ->set('state', $label->toArray())
        ->set('state.name', 'Label Updated')
        ->call('edit')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.labels.index')
        ->assertSee('Label Updated');

    $this->assertDatabaseHas('labels', [
        'name' => 'Label Updated',
        'slug' => 'label-1',
    ]);
});

it('can show delete modal', function () {
    $label = Label::factory()->create();

    Livewire::test('pages.dashboard.labels.delete-modal')
        ->set('id', $label->id)
        ->call('openDelete')
        ->assertSet('showDelete', true);
});

it('can delete label', function () {
    $label = Label::factory()->create([
        'name' => 'Label 1',
        'slug' => 'label-1',
        'color' => 'bg-gray-500',
    ]);

    Livewire::test('pages.dashboard.labels.delete-modal')
        ->set('label', $label)
        ->call('delete')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.labels.index')
        ->assertDontSee('Label 1');
});

it('can show tickets from a specific label', function () {
    Label::factory(5)->create();
    $category = Category::factory()->create();

    $tickets = Ticket::factory(20)->create([
        'category_id' => $category->id,
        'label_id' => 1,
    ]);

    foreach ($tickets as $ticket) {
        $ticket->label()->associate(rand(1, 5))->save();
    }

    $ticketCount = Ticket::where('label_id', 1)->count();

    Livewire::test('pages.dashboard.labels.tickets', ['id' => 1])
        ->assertViewHas('tickets', function ($tickets) use ($ticketCount) {
            return count($tickets) === $ticketCount;
        });
});
