<?php

namespace App\Http\Livewire\Admin\Product;

use App\Http\Controllers\SystemController;
use App\Jobs\StoreDataSheetJob;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\FilterType;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Exception;
use Illuminate\Support\Str;
use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Livewire\WithFileUploads;
use Note\Note;

class AddProduct extends Component
{
    use FindGuard, WithFileUploads;

    public $name;
    public $brand_id;
    public $category_id;
    public $access_category_id;
    public $sub_category_id;
    public $sub_sub_category_id;
    public $description;
    public $details;
    public $buying_price;
    public $selling_price;
    public $available_quantity;
    public $reordering_level;
    public $color_id = [];
    public $size_id = [];
    public $tags = [];
    public $product_id = [];
    public $front_image;
    public $back_image;
    public $left_image;
    public $right_image;
    public $model;
    public $available;
    public $weight_unit;
    public $weight_value;
    public $data_sheet = [];
    public $part_number;
    public $is_accessories = false;
    public $readyToLoad = false;
    public $subcategories = [];
    public $subsubcategories = [];
    public $products = [];
    public $units = [
        'Kilograms',
        'Grams'
    ];
    public $is_laptop = false;
    public $processor;
    public $hard_drive;
    public $hard_drive_type;
    public $memory;
    public $operating_system;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    protected array $rules = [
        'sub_sub_category_id' => 'string|nullable|max:255|exists:sub_sub_categories,id',
        'brand_id' => 'string|required|max:255|exists:brands,id',
        'category_id' => 'string|required|max:255|exists:categories,id',
        'access_category_id' => 'string|nullable|max:255|exists:categories,id',
        'sub_category_id' => 'string|nullable|max:255|exists:sub_categories,id',
        'name' => 'string|required|max:255',
        'model' => 'string|nullable|max:255',
        'part_number' => 'string|nullable|max:255',
        'description' => 'string|nullable',
        'details' => 'string|nullable',
        'buying_price' => 'numeric|required',
        'selling_price' => 'numeric|required',
        'available_quantity' => 'integer|required',
        'reordering_level' => 'integer|required',
        'weight_value' => 'numeric|nullable',
        'weight_unit' => 'string|nullable|max:255',
        'color_id' => 'array|nullable',
        'product_id' => 'array|nullable',
        'size_id' => 'array|nullable',
        'processor' => 'string|nullable',
        'hard_drive' => 'string|nullable',
        'hard_drive_type' => 'string|nullable',
        'memory' => 'string|nullable',
        'operating_system' => 'string|nullable',
        'front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],// max 3M
        'back_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],// max 3M
        'left_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],// max 3M
        'right_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],// max 3M
        'data_sheet.*' => ['mimes:doc,docx,pdf,zip', 'max:5000|nullable'], // 5MB Max
    ];

    protected $messages = [
        'category_id.required' => 'The category cannot be empty.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if (isset($this->category_id) && !is_null($this->category_id)) {
            $this->subcategories = SubCategory::query()
                ->orderBy('name')
                ->where('category_id', $this->category_id)
                ->get();
        }
        if (isset($this->sub_category_id) && !is_null($this->sub_category_id)) {
            $this->subsubcategories = SubSubCategory::query()
                ->orderBy('name')
                ->where('sub_category_id', $this->sub_category_id)
                ->get();
        }

        if (isset($this->category_id) && !is_null($this->category_id)) {
            $category = Category::query()->findOrFail($this->category_id);
            if ($category->slug === 'laptops') {
                $this->is_laptop = true;
            } else {
                $this->is_laptop = false;
            }

            if ($category->is_special) {
                $this->is_accessories = true;

                $this->products = Product::query()
                    ->latest()
                    ->where('category_id', $this->access_category_id)
                    ->get();
            } else {
                $this->is_accessories = false;
                $this->products = [];
                $this->product_id = [];
            }
        }

        // do query
        $query = new Product();

        // check if the part number exists here
        if (!is_null($this->part_number)) {
            $this->available = $query->with(['product_image'])->firstWhere('part_number', $this->part_number);

            if ($this->available) {
//                $this->size_id = [];
//                $this->color_id = [];
                $this->available_quantity = $this->available->available_quantity;
                $this->reordering_level = $this->available->reordering_level;
                $this->buying_price = $this->available->buying_price;
                $this->selling_price = $this->available->selling_price;
                $this->description = $this->available->description;
                $this->details = $this->available->details;
                $this->name = $this->available->name;
                $this->processor = $this->available->processor;
                $this->hard_drive = $this->available->hard_drive;
                $this->hard_drive_type = $this->available->hard_drive_type;
                $this->memory = $this->available->memory;
                $this->operating_system = $this->available->operating_system;

                $this->addError('part_number', 'The part number is available, some records have been pooled for it. Check for any editing then proceed.');
            } else {
//            $this->size_id = [];
//            $this->color_id = [];
//            $this->available_quantity;
//            $this->reordering_level;
//            $this->buying_price;
//            $this->selling_price;
//            $this->description;
//            $this->details;
//            $this->name;

                $this->resetErrorBag('part_number');
            }
        }
    }

    public function submit()
    {
        $this->validate();
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
        try {
            $this->validate();

            if ($this->available) {
                // register the upgrade/standard products attached to this product
                if (count($this->product_id)) {
                    SystemController::sync_products_options($this->available->id, $this->product_id);
                }

                $this->endProcess();
                return redirect()->back();
            } else {
                $nameExist = Product::query()
                    ->orWhere('name', $this->name)
                    ->orWhere('slug', Str::slug($this->name))
                    ->first();

                if ($nameExist) {
                    $this->addError('name', 'The name already exists.');
                } else {
                    // sync part names here
                    $part_names = SystemController::syncPartNames($this->product_id);

                    // store product
                    $product = Product::query()->create([
                        'product_id' => $this->findGuardType()->id(),
                        'product_type' => Admin::class,
                        'brand_id' => $this->brand_id,
                        'category_id' => $this->category_id,
                        'sub_category_id' => $this->sub_category_id,
                        'sub_sub_category_id' => $this->sub_sub_category_id,
                        'name' => $this->name,
                        'part_number' => $this->part_number,
                        'model' => $this->model,
                        'description' => $this->description,
                        'weight_value' => $this->weight_value,
                        'weight_unit' => $this->weight_unit,
                        'details' => $this->details,
                        'buying_price' => $this->buying_price,
                        'selling_price' => $this->selling_price,
                        'available_quantity' => $this->available_quantity,
                        'reordering_level' => $this->reordering_level,
                        'part_names' => json_encode($part_names),
                        'colors' => $this->color_id,
                        'sizes' => $this->size_id,
                        'processor' => $this->processor,
                        'hard_drive' => $this->hard_drive,
                        'hard_drive_type' => $this->hard_drive_type,
                        'memory' => $this->memory,
                        'operating_system' => $this->operating_system
                    ]);

                    // sync color/size
                    SystemController::relationSyncing($this->color_id, $product);
                    SystemController::relationSyncing($this->size_id, $product, false);

                    // pass image params
                    $front = SystemController::store_media($this->front_image);
                    $back = SystemController::store_media($this->back_image);
                    $left = SystemController::store_media($this->left_image);
                    $right = SystemController::store_media($this->right_image);

                    // store the images here
                    ProductImage::query()->create([
                        'product_id' => $product->id,
                        'front_image' => $front[0],
                        'front_image_url' => $front[1],
                        'back_image' => $back[0],
                        'back_image_url' => $back[1],
                        'left_image' => $left[0],
                        'left_image_url' => $left[1],
                        'right_image' => $right[0],
                        'right_image_url' => $right[1]
                    ]);

                    // store the data sheets here
                    if (count($this->data_sheet))
                        dispatch(new StoreDataSheetJob(
                            $product,
                            $this->data_sheet
                        ))->onQueue('default')->delay(2);


                    // register the upgrade/standard products attached to this product
                    if (count($this->product_id)) {
                        SystemController::sync_products_options($product->id, $this->product_id);
                    }

                    $this->endProcess();
                    return redirect()->back();
                }
            }

            $this->alert(
                'error',
                'Sorry! Please check all fields and try again.'
            );
        } catch (Exception $exception) {
            $this->alert(
                'error',
                'Please try again. Check all fields are filled.'
            );
        }
    }

    private function endProcess()
    {
        SystemController::log([
            'email' => $this->findGuardType()->user()->email,
            'product name' => $this->name
        ], 'success', 'product.upload');

        Note::createSystemNotification(Admin::class, 'New Product', $this->name . ' added successfully.');
        $this->emit('noteAdded');
        $this->reset();
        $this->loadData();
        $this->alert(
            'success',
            'Product successfully saved.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.product.add-product', [
            'categories' => $this->readyToLoad
                ? Category::query()
                    ->orderBy('name')
                    ->get()
                : [],
            'brands' => $this->readyToLoad
                ? Brand::query()
                    ->orderBy('name')
                    ->get()
                : [],
            'colors' => $this->readyToLoad
                ? Color::query()
                    ->orderBy('value')
                    ->get()
                : [],
            'sizes' => $this->readyToLoad
                ? Size::query()
                    ->orderBy('value')
                    ->get()
                : [],
            'filters' => $this->readyToLoad
                ? collect(FilterType::query()
                    ->orderBy('name')
                    ->get())->groupBy('type')
                : []
        ])->layout('layouts.admin');
    }
}
