<?php

use App\Models\Team;

it('can render teams view', function () {
    Livewire::test('pages.dashboard.teams.index')
        ->assertHasNoErrors()
        ->assertSee('Teams');
});

it('can sort data', function () {
    $team1 = Team::factory()->create([
        'name' => 'Team 1',
        'description' => 'Team 1 description',
    ]);

    $team2 = Team::factory()->create([
        'name' => 'Team 2',
        'description' => 'Team 2 description',
    ]);

    $component = Livewire::test('pages.dashboard.teams.index')
        ->assertHasNoErrors()
        ->assertSeeInOrder([$team1->name, $team2->name]);

    $component
        ->set('sortColumn', 'name')
        ->set('sortDirection', 'desc')
        ->assertHasNoErrors()
        ->assertSeeInOrder([$team2->name, $team1->name]);

    $component
        ->set('sortColumn', 'name')
        ->set('sortDirection', 'asc')
        ->call('doSort', 'name')
        ->assertHasNoErrors()
        ->assertSeeInOrder([$team1->name, $team2->name]);

    $component
        ->call('doSort', 'description')
        ->assertHasNoErrors()
        ->assertSet('sortColumn', 'description')
        ->assertSet('sortDirection', 'ASC')
        ->assertSeeInOrder([$team1->name, $team2->name]);
});

it('can initialize component with stored page', function () {
    session()->put('page', 2);

    Livewire::test('pages.dashboard.teams.index')
        ->assertSet('page', 2);
});

it('can save current page to session', function () {
    Livewire::test('pages.dashboard.teams.index')
        ->set('page', 3);

    $this->assertEquals(3, session('page'));
});

it('can show all teams', function () {
    Team::factory(10)->create();

    Livewire::test('pages.dashboard.teams.index')
        ->assertViewHas('teams', function ($teams) {
            return count($teams) === 10;
        });
});

it('can reset page', function () {
    Livewire::test('pages.dashboard.teams.index')
        ->dispatch('force-refresh')
        ->assertHasNoErrors();
});

it('can create new team', function () {
    Livewire::test('pages.dashboard.teams.create-modal')
        ->set('state.name', 'Team 1')
        ->set('state.description', 'Team 1 description')
        ->call('store')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.teams.index')
        ->assertSee('Team 1');

    $this->assertEquals(1, Team::count());

    $this->assertDatabaseHas('teams', [
        'name' => 'Team 1',
        'description' => 'Team 1 description',
    ]);
});

it('can close create modal', function () {
    Livewire::test('pages.dashboard.teams.create-modal')
        ->set('state.name', 'Team 1')
        ->call('closeModal')
        ->assertDispatched('close-modal')
        ->assertSet('state.name', '');
});

it('can show edit modal', function () {
    $team = Team::factory()->create();

    Livewire::test('pages.dashboard.teams.edit-modal')
        ->set('id', $team->id)
        ->call('openEdit')
        ->assertSet('state', $team->toArray())
        ->assertSet('showEdit', true);

});

it('can update team', function () {
    $team = Team::factory()->create([
        'name' => 'Team 1',
        'description' => 'Team 1 description',
    ]);

    Livewire::test('pages.dashboard.teams.edit-modal')
        ->set('team', $team)
        ->set('state', $team->toArray())
        ->set('state.name', 'Team Updated')
        ->call('edit')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.teams.index')
        ->assertSee('Team Updated');

    $this->assertDatabaseHas('teams', [
        'name' => 'Team Updated',
    ]);
});

it('can show delete modal', function () {
    $team = Team::factory()->create();

    Livewire::test('pages.dashboard.teams.delete-modal')
        ->set('id', $team->id)
        ->call('openDelete')
        ->assertSet('showDelete', true);
});

it('can delete team', function () {
    $team = Team::factory()->create([
        'name' => 'Team 1',
        'description' => 'Team 1 description',
    ]);

    Livewire::test('pages.dashboard.teams.delete-modal')
        ->set('team', $team)
        ->call('delete')
        ->assertHasNoErrors();

    Livewire::test('pages.dashboard.teams.index')
        ->assertDontSee('Team 1');
});
