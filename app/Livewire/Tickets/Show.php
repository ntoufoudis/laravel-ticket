<?php

namespace App\Livewire\Tickets;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.ticket')]
class Show extends Component
{
    public User $user;
    public Ticket $ticket;

    public function mount($id): void
    {
        $this->user = auth()->user();
        $this->ticket = Ticket::find($id);
    }


    public function render(): View
    {
        return view('livewire.tickets.show', [
            'ticket' => $this->ticket,
        ]);
    }
}
