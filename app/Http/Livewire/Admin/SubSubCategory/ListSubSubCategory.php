<?php

namespace App\Http\Livewire\Admin\SubSubCategory;

use App\Models\Admin;
use App\Models\SubSubCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Note\Note;

class ListSubSubCategory extends Component
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
        SubSubCategory::query()->findOrFail($this->model_id)->forceDelete();
        Note::createSystemNotification(Admin::class, 'Sub-SubCategory Deletion', 'Sub-SubCategory deleted successfully.');
        $this->emit('noteAdded');
        $this->loadData();
        $this->alert(
            'success',
            'Sub-SubCategory deleted successfully.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.sub-sub.list-sub-sub-category', [
            'subcategories' => $this->readyToLoad
                ? SubSubCategory::query()
                    ->with([
                        'product',
                        'category',
                        'sub_category'
                    ])
                    ->orderBy('name')
                    ->where(function ($query) {
                        $query->orWhere('name', 'ilike', '%' . $this->search . '%')
                            ->orWhere('slug', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
