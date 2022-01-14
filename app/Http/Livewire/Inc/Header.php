<?php

namespace App\Http\Livewire\Inc;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class Header extends Component
{
    public $readyToLoad = false;
    public $limit = 10;
    public $category_id;
    public $name;
    public $products = [];

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function searchBar()
    {
        try {
            if (is_null($this->category_id) || $this->category_id === 'all') {
                $this->alert('error', 'Select category for search...');
            } elseif (is_null($this->name)) {
                $this->alert('error', 'Enter a product detail for search...');
            } else {
                $this->products = Product::query()
                    ->where(function ($query) {
                        $query->orWhere('name', 'ilike', '%' . $this->name . '%')
                            ->orWhere('slug', 'ilike', '%' . Str::slug($this->name) . '%')
                            ->orWhere('model', 'ilike', '%' . $this->name . '%')
                            ->orWhere('part_number', 'ilike', '%' . $this->name . '%')
                            ->orWhere('selling_price', 'ilike', '%' . $this->name . '%');
                    })->orWhereIn('brand_id',
                        Brand::query()
                            ->where(function ($query) {
                                $query->orWhere('slug', 'ilike', '%' . Str::slug($this->name) . '%')
                                    ->orWhere('name', 'ilike', '%' . $this->name . '%');
                            })
                            ->get('id')
                            ->toArray()
                    )
                    ->where('category_id', $this->category_id)
                    ->get();

                if (count($this->products)) {
                    return redirect()->route('shop', ['category_id' => $this->category_id, 'name' => $this->name]);
                }

                $this->alert('info', 'No product was found as ' . $this->name);
            }
        } catch (Exception $exception) {
            Log::alert($exception->getMessage());
            $this->alert('error', 'Sorry..Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.inc.header', [
            'categories' => Category::query()
                ->with([
                    'sub_category.product.brand'
                ])
                ->orderBy('name')
                ->limit($this->limit)
                ->get()
        ]);
    }
}
