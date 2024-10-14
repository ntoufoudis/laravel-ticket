<?php

namespace App\Livewire\Pages\Dashboard\Labels;

use App\Models\Label;
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
        $labels = Label::with('tickets')->search($this->search)
            ->orderBy('id')
            ->paginate(10);

        return view('livewire.pages.dashboard.labels.index', [
            'labels' => $labels,
        ]);
    }
}
