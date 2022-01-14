<?php

namespace App\Http\Livewire\Admin\Inc;

use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Note\Note;

class Header extends Component
{
    use FindGuard;

    public $readyToLoad = false;
    public $noteCount;

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    protected $listeners = ['noteAdded' => 'incrementNoteCount'];

    public function incrementNoteCount()
    {
        $this->loadData();
    }

    public function markAsRead()
    {
        foreach (Note::latestNotifications(false) as $notification) {
            $notification->status = true;
            $notification->forceDelete();
        }

        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.inc.header', [
            'notifications' => $this->readyToLoad
                ? Note::latestNotifications(false)
                : [],
            'user' => $this->findGuardType()->user()
        ]);
    }
}
