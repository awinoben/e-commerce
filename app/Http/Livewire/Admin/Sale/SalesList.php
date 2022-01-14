<?php

namespace App\Http\Livewire\Admin\Sale;

use App\Models\History;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SalesList extends Component
{
    use WithPagination;

    public $readyToLoad = false;
    public $search = '';
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
        return view('livewire.admin.sale.sales-list', [
            'histories' => $this->readyToLoad
                ? History::query()
                    ->with([
                        'order',
                        'product.product_image'
                    ])
                    ->latest()
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
