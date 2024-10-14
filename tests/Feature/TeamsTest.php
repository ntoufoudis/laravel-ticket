<?php

use App\Models\Team;
use App\Models\User;

it('can render teams view', function () {
    Livewire::test('pages.dashboard.teams.index')
        ->assertHasNoErrors()
        ->assertSee('Teams');
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
    $t = Team::factory()->create();

    $team = $t::with('agents')->first();

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

it('can show agents from a specific team', function () {
    Team::factory(5)->create();

    $agents = User::factory(20)->create();

    foreach ($agents as $agent) {
        $agent->team()->associate(rand(1, 5))->save();
    }

    $agentCount = User::where('team_id', 1)->count();

    Livewire::test('pages.dashboard.teams.agents', ['id' => 1])
        ->assertViewHas('agents', function ($agents) use ($agentCount) {
            return count($agents) === $agentCount;
        });
});
