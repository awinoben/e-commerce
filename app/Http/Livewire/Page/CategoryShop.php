<?php

namespace App\Http\Livewire\Page;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\SubSubCategory;
use Illuminate\Support\Str;
use Livewire\Component;

class CategoryShop extends Component
{
    public $limit;
    public $search = '';
    public $category;
    public $category_id;
    public $amount;
    public $filter_sub_category_id;
    protected $queryString = ['search'];

    protected $listeners = [
        'filterAmount'
    ];

    public function mount(string $slug)
    {
        $this->limit = 12;
        $query = new Category();

        $this->category = $query->with(['sub_category'])->firstWhere('slug', $slug);
        $this->category_id = $this->category->id;
        $this->filter_sub_category_id = 'all';
    }

    public function loadMore()
    {
        $this->limit += $this->limit;
    }

    public function filterAmount($amount)
    {
        $this->amount = $amount;
    }

    public function render()
    {
        return view('livewire.page.category-shop', [
            'categories' => Category::query()
                ->with([
                    'sub_category.product.brand'
                ])
                ->orderBy('name')
                ->limit($this->limit)
                ->get(),
            'products' => Product::query()
                ->with([
                    'brand',
                    'product_image'
                ])
                ->latest()
                ->whereIn('category_id', [
                    $this->category_id
                ])->whereIn('sub_category_id',
                    $this->filter_sub_category_id != 'all' ? [$this->filter_sub_category_id] : $this->category->sub_category()->get('id')->toArray()
                )->where(function ($query) {
                    $query->orWhereIn('id',
                        ProductOption::query()
                            ->whereIn('product_id',
                                Product::query()
                                    ->orWhereIn('category_id',
                                        Category::query()
                                            ->where(function ($query) {
                                                $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                                    ->orWhere('name', 'ilike', '%' . $this->search . '%');
                                            })->get('id')->toArray()
                                    )
                                    ->where(function ($query) {
                                        $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                            ->orWhere('name', 'ilike', '%' . $this->search . '%');
                                    })->get('id')->toArray()
                            )
                            ->get('product_id')
                            ->toArray()
                    )->orWhereIn('brand_id',
                        Brand::query()
                            ->where(function ($query) {
                                $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                    ->orWhere('name', 'ilike', '%' . $this->search . '%');
                            })
                            ->get('id')
                            ->toArray()
                    )->orWhereIn('sub_sub_category_id',
                        SubSubCategory::query()
                            ->whereIn('sub_category_id',
                                $this->filter_sub_category_id != 'all' ? [$this->filter_sub_category_id] : $this->category->sub_category()->get('id')->toArray()
                            )
                            ->where(function ($query) {
                                $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                    ->orWhere('name', 'ilike', '%' . $this->search . '%');
                            })
                            ->get('id')
                            ->toArray()
                    )->orWhere('name', 'ilike', '%' . $this->search . '%')
                        ->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                        ->orWhere('model', 'ilike', '%' . $this->search . '%')
                        ->orWhere('part_number', 'ilike', '%' . $this->search . '%')
                        ->orWhere('description', 'ilike', '%' . $this->search . '%')
                        ->orWhere('details', 'ilike', '%' . $this->search . '%')
                        ->orWhere('weight_value', 'ilike', '%' . $this->search . '%')
                        ->orWhere('weight_unit', 'ilike', '%' . $this->search . '%')
                        ->orWhere('processor', 'ilike', '%' . $this->search . '%')
                        ->orWhere('hard_drive', 'ilike', '%' . $this->search . '%')
                        ->orWhere('hard_drive_type', 'ilike', '%' . $this->search . '%')
                        ->orWhere('memory', 'ilike', '%' . $this->search . '%')
                        ->orWhere('operating_system', 'ilike', '%' . $this->search . '%')
                        ->orWhere('selling_price', 'ilike', '%' . $this->search . '%')
                        ->orWhereBetween('selling_price', [0, $this->amount]);
                })
                ->limit($this->limit)
                ->get(),
            'sub_categories' => $this->category->sub_category
        ]);
    }
}
