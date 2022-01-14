<?php

namespace App\Http\Livewire\User;

use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Livewire\WithPagination;

class UserMpesa extends Component
{
    use FindGuard, WithPagination;

    public $order_id;
    public $search = '';
    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.user.user-mpesa', [
            'mpesas' => $this->findGuardType()
                ->user()
                ->load('mpesa')
                ->mpesa()
                ->where(function ($query) {
                    $query->orWhere('transaction_number', 'ilike', '%' . $this->search . '%')
                        ->orWhere('reference_number', 'ilike', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'ilike', '%' . $this->search . '%');
                })
                ->paginate(10)
        ]);
    }
}
