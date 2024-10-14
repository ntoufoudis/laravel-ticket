<?php

namespace App\Livewire\Pages\Dashboard\Labels;

use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Tickets extends Component
{
    use WithPagination;

    public Label $label;

    /**
     * Initialize component.
     */
    public function mount($id): void
    {
        $this->label = Label::find($id);
    }

    /**
     * Render view page.
     */
    public function render(): View
    {
        $tickets = Ticket::where('label_id', $this->label->id)->paginate(10);

        return view('livewire.pages.dashboard.labels.tickets', [
            'tickets' => $tickets,
        ]);
    }
}
