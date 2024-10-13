<?php

namespace App\Livewire;

use App\Enums\Color;
use App\Models\Label;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Labels extends Component
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
    public ?Label $label = null;
    public array $state = [];
    public string $visibility = '';

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

        $label = Label::find($id);

        $this->state = $label->toArray();

        if ($label->is_visible === 'Yes') {
            $this->state['is_visible'] = true;
        } else {
            $this->state['is_visible'] = false;
        }

        $this->showCreateModal = true;
    }

    /**
     * Open Delete Modal
     */
    public function confirmDelete(int $id): void
    {
        $label = Label::find($id);

        $this->state = $label->toArray();

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
            'name' => ['required', 'string', 'max:50', 'unique:'.Label::class],
            'slug' => ['required', 'string', 'max:50', 'unique:'.Label::class],
            'color' => ['required'],
        ])->validate();

        Label::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'color' => $validated['color'],
            'is_visible' => isset($this->state['is_visible']) ? 1 : 0,
        ]);

        $this->closeModals();

        flash()->success('Label successfully added.');
    }

    /**
     * Handle updating a Label
     */
    public function edit(): void
    {
        $label = Label::find($this->state['id']);

        $validated = Validator::make($this->state, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Label::class, 'name')->ignore($label->id),
            ],
            'slug' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Label::class, 'slug')->ignore($label->id),
            ],
            'color' => [
                'required',
            ],
        ])->validate();

        $label->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'color' => $validated['color'],
            'is_visible' => $this->state['is_visible'],
        ]);

        $this->closeModals();

        flash()->success('Label updated successfully.');
    }

    /**
     * Handle Deleting a Label
     */
    public function delete(): void
    {
        $label = Label::findOrFail($this->state['id']);

        $label->delete();

        $this->closeModals();

        flash()->success('Label successfully deleted.');
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
            ['label' => 'Slug', 'column' => 'slug', 'isData' => true],
            ['label' => 'Visible', 'column' => 'is_visible', 'isData' => true],
            ['label' => 'Color', 'column' => 'color', 'customClass' => 'bgColor', 'isData' => true],

            ['label' => 'Actions', 'column' => 'action', 'isData' => false],
        ];

        $labels = Label::search($this->search)
            ->visibility($this->visibility)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.labels', [
            'filters' => [
                [
                    'name' => 'Visible',
                    'value' => 1,
                ],
                [
                    'name' => 'Not Visible',
                    'value' => 0,
                ],
            ],
            'colors' => Color::cases(),
            'columns' => $columns,
            'labels' => $labels,
        ]);
    }
}
