<?php

namespace App\Livewire\Pages\Dashboard\Teams;

use App\Livewire\Modal;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

class DeleteModal extends Modal
{
    public ?Team $team = null;

    /**
     * Open Delete Modal
     */
    #[On('open-delete')]
    public function openDelete(): void
    {
        $this->team = Team::find($this->id);
        $this->showDelete = true;
    }

    /**
     * Handle deleting a Team
     */
    public function delete(): void
    {
        $this->team->delete();

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Team successfully deleted.');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.teams.delete-modal');
    }
}
