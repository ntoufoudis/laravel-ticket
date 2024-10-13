<?php

namespace App\Livewire\Pages\Dashboard\Teams;

use App\Livewire\Modal;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;

class CreateModal extends Modal
{
    public array $state = [];

    /**
     * Close modal
     */
    #[On('closeModal')]
    public function closeModal(): void
    {
        $this->dispatch('close-modal');
        $this->reset('state');

    }

    /**
     * Handle creating new Team
     */
    public function store(): void
    {
        $validated = Validator::make($this->state, [
            'name' => ['required', 'string', 'max:50', 'unique:'.Team::class],
            'description' => ['required', 'string', 'max:50'],
        ])->validate();

        Team::create($validated);

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Team successfully added.');

        $this->reset('state');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.teams.create-modal');
    }
}
