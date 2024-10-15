<?php

namespace App\Livewire\Pages\Frontend\Tickets;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.frontend')]
class Show extends Component
{
    public User $user;
    public Ticket $ticket;

    #[Validate('required|string|max:1000')]
    public string $message = '';

    public function mount($id): void
    {
        $this->user = auth()->user();
        $this->ticket = Ticket::find($id);
    }

    public function send(): void
    {
        $validated = $this->validate([
            'message' => ['required', 'string', 'max:255'],
        ]);
        dd($validated['message']);

        Message::create([
            'user_id' => $this->user->id,
            'ticket_id' => $this->ticket->id,
            'message' => $validated['message'],
        ]);

        flash()->success('Message sent!');
    }


    public function render(): View
    {
        return view('livewire.pages.frontend.tickets.show', [
            'ticket' => $this->ticket,
        ]);
    }
}
