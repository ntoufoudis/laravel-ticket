<?php

namespace App\Livewire\Pages\Dashboard\Teams;

use App\Livewire\Modal;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

class EditModal extends Modal
{
    public array $state = [];
    public ?Team $team = null;

    /**
     * Open Edit Modal
     */
    #[On('open-edit')]
    public function openEdit(): void
    {
        $this->team = Team::find($this->id);
        $this->state = $this->team->toArray();
        $this->showEdit = true;
    }

    /**
     * Handle updating a Team
     */
    public function edit(): void
    {
        $validated = Validator::make($this->state, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Team::class, 'name')->ignore($this->team->id),
            ],
            'description' => [
                'required',
                'string',
                'max:50',
            ],
        ])->validate();

        $this->team->update($validated);

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Team updated successfully.');

        $this->reset('state');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.teams.edit-modal');
    }
}
