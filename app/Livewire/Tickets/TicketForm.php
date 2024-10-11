<?php

namespace App\Livewire\Tickets;

use App\Livewire\Forms\TicketForm as Form;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.ticket')] class TicketForm extends Component
{
    use WithFileUploads;

    public Form $ticket;

    public array $photos = [];

    /**
     * Handle Creating new Ticket
     */
    public function store(): void
    {
        $data = $this->validate();

        if (! User::where('email', $this->ticket->email)->exists()) {
            $user = User::create([
                'name' => $this->ticket->name,
                'email' => $this->ticket->email,
                'password' => Hash::make('changeMe'),
            ]);

        } else {
            $user = User::where('email', $this->ticket->email)->first();
        }

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'subject' => $data['subject'],
            'message' => $data['description'],
            'priority' => $data['priority'],
        ]);

        Message::create([
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'message' => $data['description'],
        ]);

        $ticket->attachCategories($data['category']);

        if (isset($data['attachments'])) {
            foreach ($data['attachments'] as $attachment) {
                $attachment->store('/attachments/'.$attachment->getClientOriginalName());

                Attachment::create([
                    'user_id' => $user->id,
                    'ticket_id' => $ticket->id,
                    'name' => $attachment->getClientOriginalName(),
                    'size' => $attachment->getSize(),
                    'type' => $attachment->getMimeType(),
                    'path' => $attachment->getRealPath(),
                ]);
            }
        }

        flash()->success('Ticket created.');
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.tickets.ticket-form', [
            'categories' => Category::all(),
        ]);
    }
}
