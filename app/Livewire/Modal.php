<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public bool $showCreate = false;
    public bool $showEdit = false;
    public bool $showDelete = false;
    public bool $showAssign = false;
    public int $id;

    #[On('show-create-modal')]
    public function showCreate(): void
    {
        $this->showCreate = true;
    }

    #[On('show-edit-modal')]
    public function showEdit(int $id): void
    {
        $this->id = $id;
        $this->dispatch('open-edit');
    }

    #[On('show-delete-modal')]
    public function showDelete(int $id): void
    {
        $this->id = $id;
        $this->dispatch('open-delete');
    }

    #[On('show-assign-modal')]
    public function showAssign(int $id): void
    {
        $this->id = $id;
        $this->dispatch('open-assign');
    }

    #[On('close-modal')]
    public function close(): void
    {
        $this->showCreate = false;
        $this->showEdit = false;
        $this->showDelete = false;
        $this->showAssign = false;
    }
}
