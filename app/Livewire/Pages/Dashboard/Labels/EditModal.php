<?php

namespace App\Livewire\Pages\Dashboard\Labels;

use App\Enums\Color;
use App\Livewire\Modal;
use App\Models\Label;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

class EditModal extends Modal
{
    public array $state = [];
    public ?Label $label = null;

    /**
     * Open Edit Modal
     */
    #[On('open-edit')]
    public function openEdit(): void
    {
        $this->label = Label::find($this->id);
        $this->state = $this->label->toArray();
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
                Rule::unique(Label::class, 'name')->ignore($this->label->id),
            ],
            'slug' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Label::class, 'slug')->ignore($this->label->id),
            ],
            'color' => ['required'],
        ])->validate();

        $this->label->update($validated);

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Label updated successfully.');

        $this->reset('state');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.labels.edit-modal', [
            'colors' => Color::cases(),
        ]);
    }
}
