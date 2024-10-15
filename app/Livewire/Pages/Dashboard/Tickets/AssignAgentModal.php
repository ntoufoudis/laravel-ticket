<?php

namespace App\Livewire\Pages\Dashboard\Tickets;

use App\Livewire\Modal;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class AssignAgentModal extends Modal
{
    public ?Ticket $ticket = null;

    #[Validate('required|int|exists:users,id')]
    public int $agentId;

    /**
     * Open Modal
     */
    #[On('open-assign')]
    public function openEdit(): void
    {
        $this->ticket = Ticket::find($this->id);
        $this->showAssign = true;
    }

    /**
     * Handle Assigning an Agent
     */
    public function assign(): void
    {
        $this->validate();

        $this->ticket->update([
            'assigned_to' => $this->agentId,
        ]);

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Ticket assigned to agent successfully.');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.tickets.assign-agent-modal', [
            'agents' => User::role('agent')->get(),
        ]);
    }
}
