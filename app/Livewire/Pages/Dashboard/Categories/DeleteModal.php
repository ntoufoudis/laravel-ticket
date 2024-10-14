<?php

namespace App\Livewire\Pages\Dashboard\Categories;

use App\Livewire\Modal;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

class DeleteModal extends Modal
{
    public ?Category $category = null;

    /**
     * Open Delete Modal
     */
    #[On('open-delete')]
    public function openDelete(): void
    {
        $this->category = Category::find($this->id);
        $this->showDelete = true;
    }

    /**
     * Handle deleting a Team
     */
    public function delete(): void
    {
        $this->category->delete();

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Category successfully deleted.');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.categories.delete-modal');
    }
}
