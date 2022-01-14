<?php

namespace App\Http\Livewire\Page;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $limit;
    public $brandsArray;
    public $amount;
    public $categoriesArray;
    public $search = '';
    public $category_id;
    protected $queryString = ['search'];

    protected $listeners = [
        'filterAmount'
    ];

    public function mount(string $category_id = null, string $name = null)
    {
        $this->limit = 15;
        $this->brandsArray = [];
        $this->categoriesArray = [];
        $this->category_id = $category_id;
        $this->search = $name;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->limit += $this->limit;
    }

    public function filterCategory(string $id)
    {
        array_push($this->categoriesArray, $id);
    }

    public function filterBrand(string $id)
    {
        array_push($this->brandsArray, $id);
    }

    public function filterAmount($amount)
    {
        $this->amount = $amount;
    }

    public function render()
    {
        return view('livewire.page.shop', [
            'categories' => Category::query()
                ->with([
                    'sub_category.sub_sub_category'
                ])
                ->orderBy('name')
                ->get(),
            'brands' => Brand::query()
                ->orderBy('name')
                ->get(),
            'products' => is_null($this->category_id) ? Product::query()
                ->with([
                    'brand',
                    'product_image'
                ])
                ->latest()
                ->orWhereIn('brand_id',
                    Brand::query()
                        ->where(function ($query) {
                            $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                ->orWhere('name', 'ilike', '%' . $this->search . '%');
                        })
                        ->get('id')
                        ->toArray()
                )
                ->orWhereIn('sub_category_id',
                    SubCategory::query()
                        ->where(function ($query) {
                            $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                ->orWhere('name', 'ilike', '%' . $this->search . '%');
                        })
                        ->get('id')
                        ->toArray()
                )->orWhereIn('category_id',
                    Category::query()
                        ->where(function ($query) {
                            $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                ->orWhere('name', 'ilike', '%' . $this->search . '%');
                        })
                        ->get('id')
                        ->toArray()
                )
                ->orWhere(function ($query) {
                    $query->orWhere('name', 'ilike', '%' . $this->search . '%')
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
                ->orWhereJsonContains('part_names', Str::lower($this->search))
                ->limit($this->limit)
                ->get() :
                Product::query()
                    ->with([
                        'brand',
                        'product_image'
                    ])
                    ->latest()
                    ->orWhereIn('brand_id',
                        Brand::query()
                            ->where(function ($query) {
                                $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                    ->orWhere('name', 'ilike', '%' . $this->search . '%');
                            })
                            ->get('id')
                            ->toArray()
                    )->orWhereIn('sub_category_id',
                        SubCategory::query()
                            ->where(function ($query) {
                                $query->orWhere('slug', 'ilike', '%' . Str::slug($this->search) . '%')
                                    ->orWhere('name', 'ilike', '%' . $this->search . '%');
                            })
                            ->get('id')
                            ->toArray()
                    )->orWhere(function ($query) {
                        $query->orWhere('name', 'ilike', '%' . $this->search . '%')
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
                    ->orWhereJsonContains('part_names', Str::lower($this->search))
                    ->where('category_id', $this->category_id)
                    ->limit($this->limit)
                    ->get(),
            'slide' => Slide::query()->inRandomOrder()->limit(2)->get()
        ]);
    }
}
