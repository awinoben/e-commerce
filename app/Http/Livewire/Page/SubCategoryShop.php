<?php

namespace App\Http\Livewire\Page;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Str;
use Livewire\Component;

class SubCategoryShop extends Component
{
    public $search = '';
    public $brand_id;
    public $limit = 10;
    public $sub_category;
    public $sub_category_id;
    protected $queryString = ['search'];

    public function mount(string $id)
    {
        $query = new SubCategory();

        $this->sub_category = $query->with(['sub_sub_category'])->findOrFail($id);
        $this->sub_category_id = $id;
        $this->brand_id = 'all';
    }

    public function render()
    {
        return view('livewire.page.sub-category-shop', [
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
                ->whereIn('sub_category_id', [
                    $this->sub_category_id
                ])->whereIn('brand_id',
                    $this->brand_id != 'all' ? [$this->brand_id] : Brand::query()->get('id')->toArray()
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
                    )->orWhereIn('sub_sub_category_id',
                        SubSubCategory::query()
                            ->where('sub_category_id', $this->sub_category_id)
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
                        ->orWhere('selling_price', 'ilike', '%' . $this->search . '%');
                })
                ->get(),
            'brands' => Brand::query()->get(),
            'sub_sub_categories' => $this->sub_category->sub_sub_category
        ]);
    }
}
