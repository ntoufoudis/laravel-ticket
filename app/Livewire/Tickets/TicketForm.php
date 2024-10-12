<?php

namespace App\Livewire\Tickets;

use App\Livewire\Forms\TicketForm as Form;
use App\Livewire\Recaptcha\ValidatesRecaptcha;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.ticket')] class TicketForm extends Component
{
    use WithFileUploads;

    public Form $ticket;

    public array $photos = [];

    public string $gRecaptchaResponse;

    public User $user;

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    /**
     * Handle Creating new Ticket
     */
    #[ValidatesRecaptcha]
    public function store(): void
    {
        $data = $this->validate();

        $ticket = Ticket::create([
            'user_id' => $this->user->id,
            'category_id' => $data['category'],
            'subject' => $data['subject'],
            'message' => $data['description'],
            'priority' => $data['priority'],
            'pin' => rand(0001, 9999),
        ]);

        Message::create([
            'user_id' => $this->user->id,
            'ticket_id' => $ticket->id,
            'message' => $data['description'],
        ]);

        if (isset($data['attachments'])) {
            foreach ($data['attachments'] as $attachment) {
                $path = $attachment->store(path: 'attachments');

                Attachment::create([
                    'user_id' => $this->user->id,
                    'ticket_id' => $ticket->id,
                    'name' => $attachment->getClientOriginalName(),
                    'size' => $attachment->getSize(),
                    'type' => $attachment->getMimeType(),
                    'path' => $path,
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
