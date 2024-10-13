<?php

namespace App\Livewire\Pages\Dashboard\Teams;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Teams extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $sortDirection = 'ASC';
    public $sortColumn = 'id';
    public $confirmDeleteId;
    public bool $showCreateModal = false;
    public bool $showConfirmDeleteModal = false;
    public bool $updateMode = false;
    public ?Team $team = null;
    public array $state = [];

    /**
     * Open Create Modal
     */
    public function openCreateModal(): void
    {
        $this->showCreateModal = false;
    }

    /**
     * Open Edit Modal
     */
    public function openEditModal(int $id): void
    {
        $this->updateMode = true;

        $team = Team::find($id);

        $this->state = $team->toArray();

        $this->showCreateModal = true;
    }

    /**
     * Open Delete Modal
     */
    public function confirmDelete(int $id): void
    {
        $team = Team::find($id);

        $this->state = $team->toArray();

        $this->showConfirmDeleteModal = true;
    }

    /**
     * Close Modals
     */
    public function closeModals(): void
    {
        $this->updateMode = false;
        $this->showCreateModal = false;
        $this->showConfirmDeleteModal = false;
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
     * Handle creating new Label
     */
    public function store(): void
    {
        $validated = Validator::make($this->state, [
            'name' => ['required', 'string', 'max:50', 'unique:'.Team::class],
            'description' => ['required', 'string', 'max:50'],
        ])->validate();

        Team::create($validated);

        $this->closeModals();

        flash()->success('Team successfully added.');
    }

    /**
     * Handle updating a Label
     */
    public function edit(): void
    {
        $team = Team::find($this->state['id']);

        $validated = Validator::make($this->state, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Team::class, 'name')->ignore($team->id),
            ],
            'description' => [
                'required',
                'string',
                'max:50',
            ],
        ])->validate();

        $team->update($validated);

        $this->closeModals();

        flash()->success('Team updated successfully.');
    }

    /**
     * Handle Deleting a Label
     */
    public function delete(): void
    {
        $team = Team::findOrFail($this->state['id']);

        $team->delete();

        $this->closeModals();

        flash()->success('Team successfully deleted.');
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

        return view('livewire.pages.dashboard.teams.teams', [
            'columns' => $columns,
            'teams' => $teams,
        ]);
    }
}
