<?php

namespace App\Livewire\Pages\Dashboard\Teams;

use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Agents extends Component
{
    use WithPagination;

    public Team $team;

    /**
     * Initialize component.
     */
    public function mount($id): void
    {
        $this->team = Team::find($id);
    }

    /**
     * Render view page.
     */
    public function render(): View
    {
        $agents = User::where('team_id', $this->team->id)->paginate(10);

        return view('livewire.pages.dashboard.teams.agents', [
            'agents' => $agents,
        ]);
    }
}
