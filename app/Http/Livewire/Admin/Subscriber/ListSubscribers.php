<?php

namespace App\Http\Livewire\Admin\Subscriber;

use App\Models\Subscriber;
use Livewire\Component;
use Livewire\WithPagination;

class ListSubscribers extends Component
{
    use WithPagination;

    public $search = '';

    public $readyToLoad = false;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.subscriber.list-subscribers', [
            'subscribers' => $this->readyToLoad
                ? Subscriber::query()
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhere('email', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
