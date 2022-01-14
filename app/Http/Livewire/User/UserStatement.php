<?php

namespace App\Http\Livewire\User;

use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Livewire\WithPagination;

class UserStatement extends Component
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
        return view('livewire.user.user-statement', [
            'statements' => $this->findGuardType()
                ->user()
                ->load('statement')
                ->statement()
                ->where(function ($query) {
                    $query->orWhere('reference_number', 'ilike', '%' . $this->search . '%')
                        ->orWhere('transaction_number', 'ilike', '%' . $this->search . '%')
                        ->orWhere('transaction_type', 'ilike', '%' . $this->search . '%')
                        ->orWhere('amount', 'ilike', '%' . $this->search . '%');
                })
                ->paginate(10)
        ]);
    }
}
