<?php

namespace App\Livewire\Pages\Dashboard\Categories;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Tickets extends Component
{
    use WithPagination;

    public Category $category;

    /**
     * Initialize component.
     */
    public function mount($id): void
    {
        $this->category = Category::find($id);
    }

    /**
     * Render view page.
     */
    public function render(): View
    {
        $tickets = Ticket::where('category_id', $this->category->id)->paginate(10);

        return view('livewire.pages.dashboard.categories.tickets', [
            'tickets' => $tickets,
        ]);
    }
}
