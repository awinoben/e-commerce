<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Admin;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;
use Note\Note;

class ProductReview extends Component
{
    use WithPagination;

    public $readyToLoad = false;
    public $search = '';
    public $model_id;
    public $product_id;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount(string $id)
    {
        $this->product_id = $id;
    }

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
        Review::query()->findOrFail($this->model_id)->forceDelete();
        Note::createSystemNotification(Admin::class, 'Review Deletion', 'Review deleted successfully.');
        $this->emit('noteAdded');
        $this->loadData();
        $this->alert(
            'success',
            'Review deleted successfully.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.product.product-review', [
            'reviews' => $this->readyToLoad
                ? Review::query()
                    ->with([
                        'user',
                        'product'
                    ])
                    ->latest()
                    ->where('product_id', $this->product_id)
                    ->where(function ($query) {
                        $query->orWhere('description', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
