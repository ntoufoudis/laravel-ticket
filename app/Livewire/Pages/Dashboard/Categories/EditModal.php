<?php

namespace App\Livewire\Pages\Dashboard\Categories;

use App\Livewire\Modal;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

class EditModal extends Modal
{
    public array $state = [];
    public ?Category $category = null;

    /**
     * Open Edit Modal
     */
    #[On('open-edit')]
    public function openEdit(): void
    {
        $this->category = Category::find($this->id);
        $this->state = $this->category->toArray();
        $this->showEdit = true;
    }

    /**
     * Handle updating a Team
     */
    public function edit(): void
    {
        $validated = Validator::make($this->state, [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Category::class, 'name')->ignore($this->category->id),
            ],
            'slug' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Category::class, 'slug')->ignore($this->category->id),
            ],
        ])->validate();

        $this->category->update($validated);

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Category updated successfully.');

        $this->reset('state');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.categories.edit-modal');
    }
}
