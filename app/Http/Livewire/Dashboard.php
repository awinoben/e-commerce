<?php

namespace App\Http\Livewire;

use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;

class Dashboard extends Component
{
    use FindGuard;

    public function render()
    {
        return view('livewire.dashboard', [
            'user' => $this->findGuardType()->user()
                ->load(
                    'order',
                    'history',
                    'wallet'
                )
        ]);
    }
}
