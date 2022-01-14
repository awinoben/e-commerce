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
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Exception;
use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Livewire\WithFileUploads;
use Note\Note;

class EditProduct extends Component
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
    public $weight_unit;
    public $weight_value;
    public $part_number;
    public $data_sheet = [];
    public $is_accessories = false;
    public $readyToLoad = false;
    public $subcategories = [];
    public $subsubcategories = [];
    public $products = [];
    public $product;
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

    public function mount(string $id)
    {
        $this->product = Product::query()->with(['product_image'])->findOrFail($id);
        $this->brand_id = $this->product->brand_id;
        $this->category_id = $this->product->category_id;
        $this->sub_category_id = $this->product->sub_category_id;
        $this->sub_sub_category_id = $this->product->sub_sub_category_id;
        $this->name = $this->product->name;
        $this->model = $this->product->model;
        $this->part_number = $this->product->part_number;
        $this->description = $this->product->description;
        $this->details = $this->product->details;
        $this->buying_price = $this->product->buying_price;
        $this->selling_price = $this->product->selling_price;
        $this->weight_unit = $this->product->weight_unit;
        $this->weight_value = $this->product->weight_value;
        $this->available_quantity = $this->product->available_quantity;
        $this->reordering_level = $this->product->reordering_level;
        $this->size_id = $this->product->sizes;
        $this->color_id = $this->product->colors;
        $this->processor = $this->product->processor;
        $this->hard_drive = $this->product->hard_drive;
        $this->hard_drive_type = $this->product->hard_drive_type;
        $this->memory = $this->product->memory;
        $this->operating_system = $this->product->operating_system;
        $this->triggerData();
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
        'color_id' => 'array|required',
        'product_id' => 'array|nullable',
        'size_id' => 'array|required',
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


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->triggerData();
    }

    public function triggerData()
    {
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

            // sync part names here
            $part_names = SystemController::syncPartNames($this->product_id);

            $product = $this->product;
            $product->fill([
                'brand_id' => $this->brand_id,
                'category_id' => $this->category_id,
                'sub_category_id' => $this->sub_category_id,
                'sub_sub_category_id' => $this->sub_sub_category_id,
                'name' => $this->name,
                'part_number' => $this->part_number,
                'model' => $this->model,
                'description' => $this->description,
                'details' => $this->details,
                'weight_value' => $this->weight_value,
                'weight_unit' => $this->weight_unit,
                'buying_price' => $this->buying_price,
                'selling_price' => $this->selling_price,
                'available_quantity' => $this->available_quantity,
                'reordering_level' => $this->reordering_level,
                'part_name' => json_encode($part_names),
                'colors' => json_encode($this->color_id),
                'sizes' => json_encode($this->size_id),
                'processor' => $this->processor,
                'hard_drive' => $this->hard_drive,
                'hard_drive_type' => $this->hard_drive_type,
                'memory' => $this->memory,
                'operating_system' => $this->operating_system
            ]);

            // pass image params
            if (isset($this->front_image)) {
                $front = SystemController::store_media($this->front_image);
                // store the images here
                $this->product->product_image->update([
                    'front_image' => $front[0],
                    'front_image_url' => $front[1]
                ]);
            }
            if (isset($this->back_image)) {
                $back = SystemController::store_media($this->back_image);
                // store the images here
                $this->product->product_image->update([
                    'back_image' => $back[0],
                    'back_image_url' => $back[1]
                ]);
            }
            if (isset($this->left_image)) {
                $left = SystemController::store_media($this->left_image);
                // store the images here
                $this->product->product_image->update([
                    'left_image' => $left[0],
                    'left_image_url' => $left[1]
                ]);
            }
            if (isset($this->right_image)) {
                $right = SystemController::store_media($this->right_image);
                // store the images here
                $this->product->product_image->update([
                    'right_image' => $right[0],
                    'right_image_url' => $right[1]
                ]);
            }

//        if ($product->isClean()) {
//            $this->alert('warning', 'At least one value must change.');
//            return redirect()->back();
//        }

            $product->save();
            $product->refresh();

            // sync color/size
            SystemController::relationSyncing($this->color_id, $product);
            SystemController::relationSyncing($this->size_id, $product, false);

            // register the upgrade/standard products attached to this product
            if (count($this->product_id)) {
                SystemController::sync_products_options($product->id, $this->product_id);
            }

            // store the data sheets here
            if (count($this->data_sheet))
                dispatch(new StoreDataSheetJob(
                    $product,
                    $this->data_sheet
                ))->onQueue('default')->delay(2);

            SystemController::log([
                'email' => $this->findGuardType()->user()->email,
                'product name' => $this->name
            ], 'success', 'product.edit');

            Note::createSystemNotification(Admin::class, 'Product Update', $this->name . ' updated successfully.');
            $this->emit('noteAdded');
            $this->alert(
                'success',
                'Product successfully updated.'
            );
            return redirect()->back();
        } catch (Exception $exception) {
            $this->alert(
                'error',
                'Please try again. Check all fields are filled.'
            );
        }
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.product.edit-product', [
            'product' => $this->product,
            'categories' => Category::query()
                ->orderBy('name')
                ->get(),
            'brands' => Brand::query()
                ->orderBy('name')
                ->get(),
            'colors' => Color::query()
                ->orderBy('value')
                ->get(),
            'sizes' => Size::query()
                ->orderBy('value')
                ->get(),
            'filters' => collect(FilterType::query()
                ->orderBy('name')
                ->get())->groupBy('type')
        ])->layout('layouts.admin');
    }
}
