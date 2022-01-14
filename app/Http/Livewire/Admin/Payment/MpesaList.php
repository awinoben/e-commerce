<?php

namespace App\Http\Livewire\Admin\Payment;

use App\Models\Mpesa;
use Livewire\Component;
use Livewire\WithPagination;

class MpesaList extends Component
{
    use WithPagination;

    public $readyToLoad = false;
    public $search = '';
    public $user_id;

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
        return view('livewire.admin.payment.mpesa-list', [
            'mpesas' => $this->readyToLoad
                ? Mpesa::query()
                    ->with([
                        'order'
                    ])
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhere('reference_number', 'ilike', '%' . $this->search . '%')
                            ->orWhere('transaction_number', 'ilike', '%' . $this->search . '%')
                            ->orWhere('phone_number', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
