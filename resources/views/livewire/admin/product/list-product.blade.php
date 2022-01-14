<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Product List</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div wire:poll.60000ms>
                        <div class="card-body">
                            <div wire:loading>
                                @include('inc.loader-effect')
                            </div>
                            <input class="form-control" wire:model="search" type="search" placeholder="Search...">
                        </div>
                        <div wire:init="loadData">
                            <div class="table-responsive">
                                @if(count($products))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Data Sheets</th>
                                            <th>Products</th>
                                            <th>Name</th>
                                            <th>SKU</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Sub SubCategory</th>
                                            <th>Available Qty</th>
                                            <th>B.Price
                                                <b>({{ \App\Http\Controllers\SystemController::defaultCurrency() }})</b>
                                            </th>
                                            <th>S.Price
                                                <b>({{ \App\Http\Controllers\SystemController::defaultCurrency() }})</b>
                                            </th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    @if(isset($product->product_image->front_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->front_image) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @elseif(isset($product->product_image->back_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->back_image) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @elseif(isset($product->product_image->left_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->left_image) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @elseif(isset($product->product_image->right_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->right_image) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @else
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @endif
                                                </td>
                                                <td>{{ number_format(count($product->product_data_sheet)) }}</td>
                                                <td>
                                                    @if(isset($product->option))
                                                        @foreach($product->option->product_option as $option)
                                                            {{ $option->product->name }},<br>
                                                        @endforeach
                                                    @else
                                                        None
                                                    @endif
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>{{ $product->brand->name }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ isset($product->sub_category) ? $product->sub_category->name : 'None' }}</td>
                                                <td>{{ isset($product->sub_sub_category) ? $product->sub_sub_category->name : 'None' }}</td>
                                                <td>{{ number_format($product->available_quantity) }}</td>
                                                <td>{{ number_format($product->buying_price,2) }}</td>
                                                <td>{{ number_format($product->selling_price,2) }}</td>
                                                <td>{{ date('F d, Y h:i a', strtotime($product->updated_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.list.product.reviews',['id'=> $product->id]) }}"
                                                       class="btn btn-warning">Review(s)</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.edit.product',['id'=>$product->id]) }}"
                                                       class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    @if (!count($product->history))
                                                        <button type="button"
                                                                wire:click="delete('{{ $product->id }}')"
                                                                class="btn btn-danger">
                                                            Delete
                                                        </button>
                                                    @else
                                                        <button class="btn btn-danger disabled">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Data Sheets</th>
                                            <th>Products</th>
                                            <th>Name</th>
                                            <th>SKU</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Sub SubCategory</th>
                                            <th>Available Qty</th>
                                            <th>B.Price
                                                <b>({{ \App\Http\Controllers\SystemController::defaultCurrency() }})</b>
                                            </th>
                                            <th>S.Price
                                                <b>({{ \App\Http\Controllers\SystemController::defaultCurrency() }})</b>
                                            </th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No products were found...</p>
                                @endif

                                @if(count($products))
                                    <ul class="pagination justify-content-end">
                                        {{ $products->links() }}
                                    </ul>
                                @endif
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
