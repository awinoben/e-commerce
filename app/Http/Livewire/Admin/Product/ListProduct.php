<?php

namespace App\Http\Livewire\Admin\Product;

use App\Jobs\UnLinkProductMedia;
use App\Models\Admin;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Note\Note;

class ListProduct extends Component
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
        $product = Product::query()->with(['product_image', 'product_data_sheet'])->findOrFail($this->model_id);
        dispatch(new UnLinkProductMedia(
            $product->product_image,
            $product->product_data_sheet,
        ))->onQueue('default')->delay(2);

        $product->forceDelete();
        Note::createSystemNotification(Admin::class, 'Product Deletion', 'Product deleted successfully.');
        $this->emit('noteAdded');
        $this->loadData();
        $this->alert(
            'success',
            'Product deleted successfully.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.product.list-product', [
            'products' => $this->readyToLoad
                ? Product::query()
                    ->with([
                        'category',
                        'sub_category',
                        'sub_sub_category',
                        'product_image',
                        'option.product_option.product',
                        'history'
                    ])
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhere('name', 'ilike', '%' . $this->search . '%')
                            ->orWhere('slug', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : []
        ])->layout('layouts.admin');
    }
}
