<?php

namespace App\Livewire\Pages\Dashboard\Labels;

use App\Enums\Color;
use App\Livewire\Modal;
use App\Models\Label;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;

class CreateModal extends Modal
{
    public array $state = [];

    /**
     * Close modal
     */
    #[On('closeModal')]
    public function closeModal(): void
    {
        $this->dispatch('close-modal');
        $this->reset('state');

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

        Label::create($validated);

        $this->dispatch('close-modal');

        $this->dispatch('force-refresh');

        flash()->success('Label successfully added.');

        $this->reset('state');
    }

    /**
     * Render view page
     */
    public function render(): View
    {
        return view('livewire.pages.dashboard.labels.create-modal', [
            'colors' => Color::cases(),
        ]);
    }
}
