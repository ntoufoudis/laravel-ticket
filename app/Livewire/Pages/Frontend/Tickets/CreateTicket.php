<?php

namespace App\Livewire\Pages\Frontend\Tickets;

use App\Livewire\Forms\TicketForm;
use App\Livewire\Recaptcha\ValidatesRecaptcha;
use App\Mail\TicketCreated;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.frontend')]
class CreateTicket extends Component
{
    use WithFileUploads;

    public TicketForm $ticket;
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
        $uuid = Str::uuid()->toString();

        $data = $this->validate();

        $ticket = Ticket::create([
            'uuid' => $uuid,
            'user_id' => $this->user->id,
            'category_id' => $data['category'],
            'subject' => $data['subject'],
            'priority' => $data['priority'],
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
        $this->redirectIntended(default: route('home', absolute: false), navigate: true);

        Mail::to($this->user->email)->send(new TicketCreated($ticket));
    }

    public function back(): void
    {
        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.pages.frontend.tickets.create-ticket', [
            'categories' => Category::all(),
        ]);
    }
}
