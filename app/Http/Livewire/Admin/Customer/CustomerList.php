<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Admin;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Note\Note;

class CustomerList extends Component
{
    use WithPagination;

    public $readyToLoad = false;
    public $search = '';
    public $user_id;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function changeStatus(string $id)
    {
        $this->user_id = $id;
        $this->confirm('Are you sure you want to proceed?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, I am sure!',
            'cancelButtonText' => 'No, cancel it!',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        $user = User::query()->findOrFail($this->user_id);
        if ($user->is_active) {
            $user->is_active = false;
        } else {
            $user->is_active = true;
        }

        $user->save();
        Note::createSystemNotification(Admin::class, 'Customer ', $user->name . ' account status changed.');
        $this->emit('noteAdded');
        $this->loadData();
        $this->alert(
            'success',
            $user->name . ' account status has been changed.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.customer.customer-list', [
            'users' => $this->readyToLoad
                ? User::query()
                    ->with([
                        'role',
                        'country'
                    ])
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhere('name', 'ilike', '%' . $this->search . '%')
                            ->orWhere('slug', 'ilike', '%' . $this->search . '%')
                            ->orWhere('email', 'ilike', '%' . $this->search . '%')
                            ->orWhere('phone_number', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
