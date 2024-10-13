<?php

namespace App\Livewire\Pages\Dashboard\Tickets;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Edit extends Component
{
    public Ticket $ticket;

    public function mount($id): void
    {
        $this->ticket = Ticket::find($id);
    }

    public function render(): View
    {
        return view('livewire.pages.dashboard.tickets.edit', [
            'ticket' => $this->ticket,
        ]);
    }
}
