<?php

namespace App\Livewire\Pages\Frontend;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Home extends Component
{
    use WithPagination;

    public $sortDirection = 'ASC';
    public $sortColumn = 'id';
    public $page = 1;
    public $search = '';

    /**
     * Toggle sort direction when column header is clicked.
     */
    public function doSort(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = ($this->sortDirection === 'ASC') ? 'DESC' : 'ASC';

            return;
        }

        $this->sortColumn = $column;
        $this->sortDirection = 'ASC';
    }

    public function render(): View
    {
        $columns = [
            ['label' => 'Id', 'column' => 'id', 'isData' => true],
            ['label' => 'Subject', 'column' => 'subject', 'isData' => true],
            ['label' => 'Priority', 'column' => 'priority', 'isData' => true],
            ['label' => 'Category', 'column' => 'category->name', 'isData' => true],
            ['label' => 'Status', 'column' => 'status', 'isData' => true],

            ['label' => 'Actions', 'column' => 'action', 'isData' => false],
        ];

        $tickets = Ticket::where('user_id', auth()->user()->id)
            ->with('category')
            ->search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.home', [
            'columns' => $columns,
            'tickets' => $tickets,
        ]);
    }
}
