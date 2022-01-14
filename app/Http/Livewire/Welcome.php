<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\SubSubCategory;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Welcome extends Component
{
    public $search = '';
    public $category;
    public $category_id;
    public $cartItems;
    public $filter_sub_category_id;
    protected $queryString = ['search'];

    protected $listeners = [
        'addCart'
    ];

    public function mount()
    {
        $queryCategory = new Category();

        $this->category = $queryCategory->with(['sub_category'])->firstWhere('is_special', true);
        $this->category_id = $this->category->id;
        $this->cartItems = [];
    }

    public function addCart(string $id, string $instance, int $quantity = 1)
    {
        $product = Product::query()->findOrFail($id);
        if ($instance === 'shopping') {
            $found = false;
            if (count(Cart::instance($instance)->content())) {
                foreach (Cart::instance($instance)->content() as $cart) {
                    if ($cart->model->id === $product->id) {
                        if ($cart->qty >= $product->available_quantity) {
                            $found = true;
                            $this->cartItems = Cart::instance($instance)->content();
                            $this->alert('warning', 'We are sorry that no more stock is available for ' . $product->name);
                            break;
                        }
                    }
                }

                if (!$found) {
                    Cart::instance($instance)->add($product->id, $product->name, $quantity, $product->selling_price)->associate(Product::class);
                    $this->cartItems = Cart::instance($instance)->content();
                    $this->alert('success', $product->name . ' added to ' . $instance . ' cart...');
                }

            } else {
                Cart::instance($instance)->add($product->id, $product->name, $quantity, $product->selling_price)->associate(Product::class);
                $this->cartItems = Cart::instance($instance)->content();
                $this->alert('success', $product->name . ' added to ' . $instance . ' cart...');
            }
        } else {
            Cart::instance($instance)->add($product->id, $product->name, $quantity, $product->selling_price)->associate(Product::class);
            $this->cartItems = Cart::instance($instance)->content();
            $this->alert('success', $product->name . ' added to ' . $instance . ' cart...');
        }
    }

    public function render()
    {
        return view('livewire.welcome', [
            'products' => !is_null($this->search) && $this->search != ""
                ? Product::query()
                    ->with([
                        'brand',
                        'product_image'
                    ])
                    ->latest()
                    ->whereIn('category_id', [
                        $this->category_id
                    ])->where(function ($query) {
                        $query->orWhereIn('id',
                            ProductOption::query()
                                ->whereIn('product_id',
                                    Product::query()
                                        ->orWhereIn('category_id',
                                            Category::query()
                                                ->where(function ($query) {
                                                    $query
                                                        ->orWhere('name', 'ilike', '%' . $this->search . '%');
                                                })->get('id')->toArray()
                                        )
                                        ->orWhere(function ($query) {
                                            $query
                                                ->orWhere('name', 'ilike', '%' . $this->search . '%');
                                        })->get('id')->toArray()
                                )
                                ->get('product_id')
                                ->toArray()
                        )->orWhereIn('brand_id',
                            Brand::query()
                                ->where(function ($query) {
                                    $query->orWhere('name', 'ilike', '%' . $this->search . '%');
                                })
                                ->get('id')
                                ->toArray()
                        )->orWhereIn('sub_sub_category_id',
                            SubSubCategory::query()
                                ->where('sub_category_id', $this->filter_sub_category_id)
                                ->where(function ($query) {
                                    $query
                                        ->orWhere('name', 'ilike', '%' . $this->search . '%');
                                })
                                ->get('id')
                                ->toArray()
                        )->orWhere('name', 'ilike', '%' . $this->search)
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
                            ->orWhere('selling_price', 'ilike', '%' . $this->search . '%');
                    })
                    ->get()
                : [],
            'sub_categories' => $this->category->sub_category
        ]);
        // ORIGINAL CODE
        // return view('livewire.welcome', [
        //     'products' => !is_null($this->search) && $this->search != ""
        //         ? Product::query()
        //             ->with([
        //                 'brand',
        //                 'product_image'
        //             ])
        //             ->latest()
        //             ->whereIn('category_id', [
        //                 $this->category_id
        //             ])->whereIn('sub_category_id', [
        //                 $this->filter_sub_category_id
        //             ])->where(function ($query) {
        //                 $query->orWhereIn('id',
        //                     ProductOption::query()
        //                         ->whereIn('product_id',
        //                             Product::query()
        //                                 ->orWhereIn('category_id',
        //                                     Category::query()
        //                                         ->where(function ($query) {
        //                                             $query
        //                                                 ->orWhere('name', 'ilike', '%' . $this->search . '%');
        //                                         })->get('id')->toArray()
        //                                 )
        //                                 ->orWhere(function ($query) {
        //                                     $query
        //                                         ->orWhere('name', 'ilike', '%' . $this->search . '%');
        //                                 })->get('id')->toArray()
        //                         )
        //                         ->get('product_id')
        //                         ->toArray()
        //                 )->orWhereIn('brand_id',
        //                     Brand::query()
        //                         ->where(function ($query) {
        //                             $query
        //                                 ->orWhere('name', 'ilike', '%' . $this->search . '%');
        //                         })
        //                         ->get('id')
        //                         ->toArray()
        //                 )->orWhereIn('sub_sub_category_id',
        //                     SubSubCategory::query()
        //                         ->where('sub_category_id', $this->filter_sub_category_id)
        //                         ->where(function ($query) {
        //                             $query
        //                                 ->orWhere('name', 'ilike', '%' . $this->search . '%');
        //                         })
        //                         ->get('id')
        //                         ->toArray()
        //                 )->orWhere('name', 'ilike', '%' . $this->search . '%')
        //
        //                     ->orWhere('model', 'ilike', '%' . $this->search . '%')
        //                     ->orWhere('part_number', 'ilike', '%' . $this->search . '%')
        //                     ->orWhere('selling_price', 'ilike', '%' . $this->search . '%');
        //             })
        //             ->get()
        //         : [],
        //     'sub_categories' => $this->category->sub_category
        // ]);
    }
}
