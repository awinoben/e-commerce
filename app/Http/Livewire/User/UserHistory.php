<?php

namespace App\Http\Livewire\User;

use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Livewire\WithPagination;

class UserHistory extends Component
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
        return view('livewire.user.user-history', [
            'histories' => $this->findGuardType()
                ->user()
                ->load('history.product')
                ->history()
                ->where(function ($query) {
                    $query->orWhereIn('order_id', $this->findGuardType()
                        ->user()
                        ->load('order')
                        ->order()
                        ->where(function ($query) {
                            $query->orWhere('order_number', 'ilike', '%' . $this->search . '%');
                        })
                        ->get('id')
                        ->toArray()
                    );
                })
                ->paginate(10)
        ]);
    }
}
