<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\History;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetail extends Component
{
    use WithPagination;

    public $order_id;
    public $readyToLoad = false;
    public $search = '';
    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function mount(string $id)
    {
        $this->order_id = $id;
    }

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
        return view('livewire.admin.order.order-detail', [
            'histories' => $this->readyToLoad
                ? History::query()
                    ->with([
                        'order',
                        'product.product_image'
                    ])
                    ->latest()
                    ->whereIn('order_id', [$this->order_id])
                    ->whereIn('product_id', Product::query()
                        ->where(function ($query) {
                            $query->orWhere('name', 'ilike', '%' . $this->search . '%')
                                ->orWhere('slug', 'ilike', '%' . $this->search . '%');
                        })->get('id')->toArray())
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
