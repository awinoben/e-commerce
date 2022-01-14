<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Add Product</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Overview</h6>
                        <div wire:init="loadData">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('inc.alert')
                                    <form wire:submit.prevent="submit">
                                        <div class="form-group">
                                            <label for="brand_id">Brand <span class="font-italic text-info text-sm">(Brand of the item/product you are adding)</span></label>
                                            <select name="brand_id" id="brand_id"
                                                    class="form-control {{ $errors->has('brand_id') ? 'is-invalid' : '' }}"
                                                    wire:model="brand_id">
                                                <option>Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category <span
                                                    class="font-italic text-info text-sm">(Category of the item/product you are adding)</span></label>
                                            <select name="category_id" id="category_id"
                                                    class="select2-example form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                                    wire:model="category_id">
                                                <option>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" {{ count($subcategories) ? '' : 'hidden' }}>
                                            <label for="sub_category_id">Sub Category <span
                                                    class="font-italic text-info text-sm">(Sub Category of the item/product you are adding)</span></label>
                                            <select name="sub_category_id" id="sub_category_id"
                                                    class="select2-example form-control {{ $errors->has('sub_category_id') ? 'is-invalid' : '' }}"
                                                    wire:model="sub_category_id">
                                                <option>Select Sub Category</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('sub_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" {{ count($subsubcategories) ? '' : 'hidden' }}>
                                            <label for="sub_sub_category_id">Sub SubCategory <span
                                                    class="font-italic text-info text-sm">(Sub SubCategory of the item/product you are adding)</span></label>
                                            <select name="sub_sub_category_id" id="sub_sub_category_id"
                                                    class="form-control {{ $errors->has('sub_sub_category_id') ? 'is-invalid' : '' }}"
                                                    wire:model="sub_sub_category_id">
                                                <option>Select Sub Category</option>
                                                @foreach ($subsubcategories as $subsubcategory)
                                                    <option
                                                        value="{{ $subsubcategory->id }}">{{ $subsubcategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('sub_sub_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" {{ $is_accessories ? '' : 'hidden' }}>
                                            <label for="access_category_id">Select Attaching Category <span
                                                    class="font-italic text-warning text-sm">(Category of the item/product you are attaching to)</span></label>
                                            <select name="access_category_id[]" id="access_category_id"
                                                    class="select2-example form-control {{ $errors->has('access_category_id') ? 'is-invalid' : '' }}"
                                                    wire:model="access_category_id">
                                                <option>Select Category</option>
                                                @foreach ($categories as $category)
                                                    @if ($category->id != $category_id)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('access_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" {{ $is_accessories ? '' : 'hidden' }}>
                                            <label for="product_id">Select Attaching Product <span
                                                    class="font-italic text-warning text-sm">(Name of the item/product you are attaching to)</span></label>
                                            <select name="product_id[]" id="product_id"
                                                    class="select2-example form-control {{ $errors->has('product_id') ? 'is-invalid' : '' }}"
                                                    wire:model="product_id" multiple="multiple">
                                                <option>Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="model">Model <span class="font-italic text-info text-sm">(Model of the item/product you are adding)</span></label>
                                            <input type="text"
                                                   class="form-control {{ $errors->has('model') ? 'is-invalid' : '' }}"
                                                   id="model" placeholder="Enter model" wire:model="model">
                                            @error('model')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="part_number">Part Number <span
                                                    class="font-italic text-info text-sm">(Part Number of the item/product you are adding)</span></label>
                                            <input type="text"
                                                   class="form-control {{ $errors->has('part_number') ? 'is-invalid' : '' }}"
                                                   id="part_number" placeholder="Enter Part Number"
                                                   wire:model="part_number">
                                            @error('part_number')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="color_id">Color <span class="font-italic text-info text-sm">(Color of the item/product you are adding)</span></label>
                                            <select name="color_id[]" id="color_id"
                                                    class="select2-example form-control {{ $errors->has('color_id') ? 'is-invalid' : '' }}"
                                                    wire:model="color_id" multiple="multiple">
                                                <option disabled>Select Color</option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->value }}</option>
                                                @endforeach
                                            </select>
                                            @error('color_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="size_id">Size <span class="font-italic text-info text-sm">(Size of the item/product you are adding)</span></label>
                                            <select name="size_id[]" id="size_id"
                                                    class="select2-example form-control {{ $errors->has('size_id') ? 'is-invalid' : '' }}"
                                                    wire:model="size_id" multiple="multiple">
                                                <option disabled>Select Color</option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->value }}</option>
                                                @endforeach
                                            </select>
                                            @error('size_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name <span class="font-italic text-info text-sm">(Name of the item/product you are adding)</span></label>
                                            <input type="text"
                                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                   id="name" placeholder="Enter name" wire:model="name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="buying_price">Buying Price <i
                                                    class="text-info">{{ \App\Http\Controllers\SystemController::defaultCurrency() }}</i></label>
                                            <input type="number"
                                                   class="form-control {{ $errors->has('buying_price') ? 'is-invalid' : '' }}"
                                                   value="0" id="buying_price" placeholder="Enter cost"
                                                   wire:model="buying_price">
                                            @error('buying_price')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="selling_price">Selling Price <i
                                                    class="text-info">{{ \App\Http\Controllers\SystemController::defaultCurrency() }}</i></label>
                                            <input type="number"
                                                   class="form-control {{ $errors->has('selling_price') ? 'is-invalid' : '' }}"
                                                   value="0" id="selling_price" placeholder="Enter cost"
                                                   wire:model="selling_price">
                                            @error('selling_price')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="available_quantity">Quantity</label>
                                            <input type="number"
                                                   class="form-control {{ $errors->has('available_quantity') ? 'is-invalid' : '' }}"
                                                   value="0" id="available_quantity" placeholder="Enter quantity"
                                                   wire:model="available_quantity">
                                            @error('available_quantity')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="reordering_level">Re-Order Level</label>
                                            <input type="number"
                                                   class="form-control {{ $errors->has('reordering_level') ? 'is-invalid' : '' }}"
                                                   value="0" id="reordering_level"
                                                   placeholder="Enter re-ordering level..."
                                                   wire:model="reordering_level">
                                            @error('reordering_level')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="mb-4" wire:model.debounce.365ms="details" wire:ignore>
                                                <label class="block text-gray-700 text-sm text-xl font-bold mb-2"
                                                       for="details">
                                                    General Specifications
                                                </label>
                                                <input id="details"
                                                       value="{{  $details }}"
                                                       type="hidden" name="details">
                                                <trix-editor
                                                    input="details"></trix-editor>
                                                @error('details')
                                                <p class="text-red-700 font-semibold mt-2">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="mb-4" wire:model.debounce.365ms="description" wire:ignore>
                                                <label class="block text-gray-700 text-sm text-xl font-bold mb-2"
                                                       for="description">
                                                    Technical(Particular) Specifications
                                                </label>
                                                <input id="description"
                                                       value="{{ $description }}"
                                                       type="hidden"
                                                       name="details">
                                                <trix-editor
                                                    input="description"></trix-editor>
                                                @error('description')
                                                <p class="text-red-700 font-semibold mt-2">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="weight_value">Weight</label>
                                                <input type="number" step="any"
                                                       class="form-control {{ $errors->has('weight_value') ? 'is-invalid' : '' }}"
                                                       value="0" id="weight_value"
                                                       placeholder="Enter weight..."
                                                       wire:model="weight_value">
                                                @error('weight_value')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="weight_unit">Units</label>
                                                <select
                                                    class="form-control {{ $errors->has('weight_unit') ? 'is-invalid' : '' }}"
                                                    id="weight_unit"
                                                    placeholder="Enter weight unit..."
                                                    wire:model="weight_unit">
                                                    <option value="" selected disabled>Select Unit Type</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit }}">{{ $unit }}</option>
                                                    @endforeach
                                                </select>
                                                @error('weight_unit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group" {{ $is_laptop ? '' : 'hidden' }}>
                                            <label for="processor">Select Processor Type</label>
                                            <select name="processor" id="processor"
                                                    class="select2-example form-control {{ $errors->has('processor') ? 'is-invalid' : '' }}"
                                                    wire:model="processor">
                                                @if (count($filters))
                                                    @foreach ($filters['Processor'] as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                    <option value="">None</option>
                                                @endif
                                            </select>
                                            @error('processor')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" {{ $is_laptop ? '' : 'hidden' }}>
                                            <label for="hard_drive">Select Hard Drive</label>
                                            <select name="hard_drive" id="hard_drive"
                                                    class="select2-example form-control {{ $errors->has('hard_drive') ? 'is-invalid' : '' }}"
                                                    wire:model="hard_drive">
                                                @if (count($filters))
                                                    @foreach ($filters['Hard Drive'] as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                    <option value="">None</option>
                                                @endif
                                            </select>
                                            @error('hard_drive')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" {{ $is_laptop ? '' : 'hidden' }}>
                                            <label for="hard_drive_type">Select Hard Drive Type</label>
                                            <select name="hard_drive_type" id="hard_drive_type"
                                                    class="select2-example form-control {{ $errors->has('hard_drive_type') ? 'is-invalid' : '' }}"
                                                    wire:model="hard_drive_type">
                                                @if (count($filters))
                                                    @foreach ($filters['Hard Drive Type'] as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                    <option value="">None</option>
                                                @endif
                                            </select>
                                            @error('hard_drive_type')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" {{ $is_laptop ? '' : 'hidden' }}>
                                            <label for="memory">Select Memory Size</label>
                                            <select name="memory" id="memory"
                                                    class="select2-example form-control {{ $errors->has('memory') ? 'is-invalid' : '' }}"
                                                    wire:model="memory">
                                                @if (count($filters))
                                                    @foreach ($filters['Memory'] as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                    <option value="">None</option>
                                                @endif
                                            </select>
                                            @error('memory')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" {{ $is_laptop ? '' : 'hidden' }}>
                                            <label for="operating_system">Select Operating System Type</label>
                                            <select name="operating_system" id="operating_system"
                                                    class="select2-example form-control {{ $errors->has('operating_system') ? 'is-invalid' : '' }}"
                                                    wire:model="operating_system">
                                                @if (count($filters))
                                                    @foreach ($filters['Operating System'] as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                    <option value="">None</option>
                                                @endif
                                            </select>
                                            @error('operating_system')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @if ($available)
                                            @php($product = $available)
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <center>
                                                            @if(isset($product->product_image->front_image))
                                                                <img
                                                                    src="{{ asset('storage/photos/'.$product->product_image->front_image) }}"
                                                                    alt="image" width="200">
                                                                <h5 class="text-center">Front Image</h5>
                                                            @else
                                                                <img
                                                                    src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                                    alt="image" width="200">
                                                                <h5 class="text-center">Front Image</h5>
                                                            @endif
                                                        </center>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <center>
                                                            @if(isset($product->product_image->back_image))
                                                                <img
                                                                    src="{{ asset('storage/photos/'.$product->product_image->back_image) }}"
                                                                    alt="image" width="200">
                                                                <h5 class="text-center">Back Image</h5>
                                                            @else
                                                                <img
                                                                    src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                                    alt="image" width="200">
                                                                <h5 class="text-center">Back Image</h5>
                                                            @endif
                                                        </center>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <center>
                                                            @if(isset($product->product_image->right_image))
                                                                <img
                                                                    src="{{ asset('storage/photos/'.$product->product_image->right_image) }}"
                                                                    alt="image" width="200">
                                                                <h5 class="text-center">Right Image</h5>
                                                            @else
                                                                <img
                                                                    src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                                    alt="image" width="200">
                                                                <h5 class="text-center">Right Image</h5>
                                                            @endif
                                                        </center>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <center>
                                                            @if(isset($product->product_image->left_image))
                                                                <img
                                                                    src="{{ asset('storage/photos/'.$product->product_image->left_image) }}"
                                                                    alt="image" width="200">
                                                                <h5 class="text-center">Left Image</h5>
                                                            @else
                                                                <img
                                                                    src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                                    alt="image" width="200">
                                                                <h5 class="text-center">Left Image</h5>
                                                            @endif
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="data_sheet">Data Sheet <i
                                                    class="text-primary"><b>Optional</b></i></label>
                                            <input type="file" multiple
                                                   class="form-control {{ $errors->has('data_sheet') ? 'is-invalid' : '' }}"
                                                   id="data_sheet" placeholder="Choose document..."
                                                   wire:model="data_sheet">
                                            @error('data_sheet')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="front_image">Front Image <i
                                                    class="text-primary"><b>Optional</b></i></label>
                                            <input type="file"
                                                   class="form-control {{ $errors->has('front_image') ? 'is-invalid' : '' }}"
                                                   id="front_image" placeholder="Choose image..."
                                                   wire:model="front_image">
                                            @error('front_image')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="back_image">Back Image <i
                                                    class="text-primary"><b>Optional</b></i></label>
                                            <input type="file"
                                                   class="form-control {{ $errors->has('back_image') ? 'is-invalid' : '' }}"
                                                   id="back_image" placeholder="Choose image..."
                                                   wire:model="back_image">
                                            @error('back_image')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="left_image">Left Image <i
                                                    class="text-primary"><b>Optional</b></i></label>
                                            <input type="file"
                                                   class="form-control {{ $errors->has('left_image') ? 'is-invalid' : '' }}"
                                                   id="left_image" placeholder="Choose image..."
                                                   wire:model="left_image">
                                            @error('left_image')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="right_image">Right Image <i
                                                    class="text-primary"><b>Optional</b></i></label>
                                            <input type="file"
                                                   class="form-control {{ $errors->has('right_image') ? 'is-invalid' : '' }}"
                                                   id="right_image" placeholder="Choose image..."
                                                   wire:model="right_image">
                                            @error('right_image')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-primary float-right"
                                                wire:loading.class="disabled" wire:offline.attr="disabled"><span
                                                wire:loading.class="spinner-border spinner-border-sm"></span> Save
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ./ Content -->

    <!-- Footer -->
    @livewire('admin.inc.footer')
    <!-- ./ Footer -->
</div>
