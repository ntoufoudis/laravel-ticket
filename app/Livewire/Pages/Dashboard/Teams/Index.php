<?php

namespace App\Livewire\Pages\Dashboard\Teams;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $sortDirection = 'ASC';
    public $sortColumn = 'id';

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

    /**
     * Store the current page when updating.
     */
    public function updatingPage(int $page): void
    {
        $this->page = $page ?: 1;
    }

    /**
     * Save the current page to the session.
     */
    public function updatedPage(): void
    {
        session(['page' => $this->page]);
    }

    /**
     * Initialize component with stored page or default values.
     */
    public function mount(): void
    {
        if (session()->has('page')) {
            $this->page = session('page');
        }
    }

    /**
     * Refresh Component
     */
    #[On('force-refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    /**
     * Render the data on the customer table.
     */
    public function render(): View
    {
        $columns = [
            ['label' => 'Id', 'column' => 'id', 'isData' => true],
            ['label' => 'Name', 'column' => 'name', 'isData' => true],
            ['label' => 'Description', 'column' => 'description', 'isData' => true],

            ['label' => 'Actions', 'column' => 'action', 'isData' => false],
        ];

        $teams = Team::search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.pages.dashboard.teams.index', [
            'columns' => $columns,
            'teams' => $teams,
        ]);
    }
}
