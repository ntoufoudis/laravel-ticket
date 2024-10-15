<?php

namespace App\Livewire\Pages\Frontend;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.frontend')]
class Home extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';

    public function render(): View
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)
            ->with('category')
            ->search($this->search)
            ->orderBy('id')
            ->paginate(10);

        return view('livewire.pages.frontend.home', [
            'tickets' => $tickets,
        ]);
    }
}
