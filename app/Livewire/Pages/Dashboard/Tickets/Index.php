<?php

namespace App\Livewire\Pages\Dashboard\Tickets;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    /**
     * Refresh Component
     */
    #[On('force-refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $tickets = Ticket::with('category')
            ->search($this->search)
            ->orderBy('id')
            ->paginate(10);

        return view('livewire.pages.dashboard.tickets.index', [
            'tickets' => $tickets,
        ]);
    }
}
