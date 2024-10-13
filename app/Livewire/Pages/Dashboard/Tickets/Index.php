<?php

namespace App\Livewire\Pages\Dashboard\Tickets;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $page = 1;
    public string $search = '';
    public string $sortDirection = 'desc';
    public string $sortColumn = 'id';
    public string $status = '';
    public bool $showModal = false;
    public ?Ticket $ticket = null;
    public array $state = [];
    public $agents = [];

    /**
     * Open Modal to Assign Agent
     */
    public function openModal(int $id): void
    {
        $this->agents = User::role('agent')->get();
        $ticket = Ticket::find($id);

        $this->state = $ticket->toArray();

        $this->showModal = true;
    }

    /**
     * Assign Agent to Ticket
     */
    public function assign(): void
    {
        $ticket = Ticket::find($this->state['id']);

        $validated = Validator::make($this->state, [
            'assigned_to' => 'required|exists:users,id',
        ])->validate();

        $ticket->update($validated);

        $this->closeModals();

        flash()->success('Agent assigned successfully.');
    }

    /**
     * Close Modals
     */
    public function closeModals(): void
    {
        $this->showModal = false;
        $this->reset('state');
    }

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
            ['label' => 'Category', 'column' => 'category', 'column2' => 'name', 'isData' => true],
            ['label' => 'Priority', 'column' => 'priority', 'isData' => true],
            ['label' => 'Status', 'column' => 'status', 'isData' => true],
            ['label' => 'Agent', 'column' => 'assigned_to', 'isData' => true],

            ['label' => 'Actions', 'column' => 'action', 'isData' => false],
        ];

        $tickets = Ticket::with('category')
            ->search($this->search)
            ->status($this->status)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.pages.dashboard.tickets.index', [
            'filters' => [
                [
                    'name' => 'Open',
                    'value' => 'open',
                ],
                [
                    'name' => 'Closed',
                    'value' => 'closed',
                ],
            ],
            'columns' => $columns,
            'tickets' => $tickets,
        ]);
    }
}
