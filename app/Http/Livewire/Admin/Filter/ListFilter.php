<?php

namespace App\Http\Livewire\Admin\Filter;

use App\Models\Admin;
use App\Models\FilterType;
use Livewire\Component;
use Livewire\WithPagination;
use Note\Note;

class ListFilter extends Component
{
    use WithPagination;

    public $readyToLoad = false;
    public $search = '';
    public $model_id;

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

    public function delete(string $id)
    {
        $this->model_id = $id;
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
        FilterType::query()->findOrFail($this->model_id)->forceDelete();
        Note::createSystemNotification(Admin::class, 'Filter Deletion', 'Filter deleted successfully.');
        $this->emit('noteAdded');
        $this->loadData();
        $this->alert(
            'success',
            'Filter deleted successfully.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.filter.list-filter', [
            'filters' => $this->readyToLoad
                ? FilterType::query()
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhere('name', 'ilike', '%' . $this->search . '%')
                            ->orWhere('type', 'ilike', '%' . $this->search . '%')
                            ->orWhere('slug', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
