<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Categories extends Component
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
    public ?Category $category = null;
    public array $state = [];
    public string $visibility = '';

    /**
     * Open Edit Modal
     */
    public function openEditModal(int $id): void
    {
        $this->updateMode = true;

        $category = Category::find($id);

        $this->state = $category->toArray();

        if ($category->is_visible === 'Yes') {
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
        $category = Category::find($id);

        $this->state = $category->toArray();

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
     * Handle creating new Category
     */
    public function store(): void
    {
        $validated = Validator::make($this->state, [
            'name' => ['required', 'string', 'max:50', 'unique:'.Category::class],
            'slug' => ['required', 'string', 'max:50', 'unique:'.Category::class],
        ])->validate();

        Category::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'is_visible' => isset($this->state['is_visible']) ? 1 : 0,
        ]);

        $this->closeModals();

        flash()->success('Category successfully added.');
    }

    /**
     * Handle updating a Category
     */
    public function edit(): void
    {
        $category = Category::find($this->state['id']);

        $validated = Validator::make($this->state, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Category::class, 'name')->ignore($category->id),
            ],
            'slug' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Category::class, 'slug')->ignore($category->id),
            ],
        ])->validate();

        $category->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'is_visible' => $this->state['is_visible'],
        ]);

        $this->closeModals();

        flash()->success('Category updated successfully.');
    }

    /**
     * Handle Deleting a Category
     */
    public function delete(): void
    {
        $category = Category::findOrFail($this->state['id']);

        $category->delete();

        $this->closeModals();

        flash()->success('Category successfully deleted.');
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

            ['label' => 'Actions', 'column' => 'action', 'isData' => false],
        ];

        $categories = Category::search($this->search)
            ->visibility($this->visibility)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.categories', [
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
            'columns' => $columns,
            'categories' => $categories,
        ]);
    }
}
