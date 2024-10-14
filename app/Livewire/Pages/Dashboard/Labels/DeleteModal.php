<?php

namespace App\Livewire\Pages\Dashboard\Labels;

use App\Livewire\Modal;
use App\Models\Label;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

class DeleteModal extends Modal
{
    public ?Label $label = null;

    /**
     * Open Delete Modal
     */
    #[On('open-delete')]
    public function openDelete(): void
    {
        $this->label = Label::find($this->id);
        $this->showDelete = true;
    }

    /**
     * Handle deleting a Team
     */
    public function delete(): void
    {
        $this->label->delete();

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Label successfully deleted.');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.labels.delete-modal');
    }
}
