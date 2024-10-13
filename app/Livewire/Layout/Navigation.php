<?php

namespace App\Livewire\Layout;

use App\Livewire\Actions\Logout;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Navigation extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.layout.navigation');
    }
}
