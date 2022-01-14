<?php

namespace App\Http\Livewire\Admin\Size;

use App\Models\Admin;
use App\Models\Color;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
use Note\Note;

class ListSize extends Component
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
        Size::query()->findOrFail($this->model_id)->forceDelete();
        Note::createSystemNotification(Admin::class, 'Size Deletion', 'Size deleted successfully.');
        $this->emit('noteAdded');
        $this->loadData();
        $this->alert(
            'success',
            'Size deleted successfully.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.size.list-size', [
            'sizes' => $this->readyToLoad
                ? Size::query()
                    ->with([
                        'products'
                    ])
                    ->orderBy('value')
                    ->where(function ($query) {
                        $query->orWhere('value', 'ilike', '%' . $this->search . '%')
                            ->orWhere('slug', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
