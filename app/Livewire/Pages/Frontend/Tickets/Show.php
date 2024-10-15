<?php

namespace App\Livewire\Pages\Frontend\Tickets;

use App\Models\Attachment;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.frontend')]
class Show extends Component
{
    use WithFileUploads;

    public User $user;

    public $ticket;

    #[Validate('nullable|string|max:255')]
    public string $newMessage = '';

    #[Validate([
        'newAttachments' => 'nullable',
        'newAttachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docs,txt|max:10240',
    ])]
    public $newAttachments;

    public function mount($id): void
    {
        $this->user = auth()->user();
        $this->ticket = Ticket::find($id);
    }

    #[Computed]
    public function attachments(): Collection
    {
        return Attachment::where('ticket_id', $this->ticket->id)->get();
    }

    #[Computed]
    public function ticketMessages(): Collection
    {
        return Message::where('ticket_id', $this->ticket->id)->get();
    }

    public function send(): void
    {
        $this->validate();

        if ($this->newMessage > 11) {
            Message::create([
                'user_id' => $this->user->id,
                'ticket_id' => $this->ticket->id,
                'message' => $this->newMessage,
            ]);
            flash()->success('Message sent!');

            unset($this->ticketMessages);
            $this->reset('newMessage');
        }

        if (isset($this->newAttachments)) {
            foreach ($this->newAttachments as $attachment) {
                $path = $attachment->store(path: 'attachments');

                Attachment::create([
                    'user_id' => $this->user->id,
                    'ticket_id' => $this->ticket->id,
                    'name' => $attachment->getClientOriginalName(),
                    'size' => $attachment->getSize(),
                    'type' => $attachment->getMimeType(),
                    'path' => $path,
                ]);
            }

            Message::create([
                'user_id' => $this->user->id,
                'ticket_id' => $this->ticket->id,
                'message' => 'Files uploaded successfully.',
            ]);

            $this->reset('newAttachments');

            flash()->success('File(s) uploaded.');
        }
    }

    public function render(): View
    {
        return view('livewire.pages.frontend.tickets.show', [
            'ticket' => $this->ticket,
        ]);
    }
}
