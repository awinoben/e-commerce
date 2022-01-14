<div>
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{ route('dashboard') }}">Home</a></h1>
                            </li>
                            <li>Purchase List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-account-area mt-50">
        <div class="container">
            <div class="row">
                @livewire('user.inc.dash-nav')

                <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                @include('inc.alert')
                <!-- Tab panes -->
                    <div class="tab-content dashboard-content mb-20">
                        <div class="tab-pane fade active show">
                            <h3 class="last-title">Purchases</h3>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" aria-label="Small" wire:model="search"
                                       type="search" placeholder="Search..."
                                       aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm"><span
                                                class="fa fa-search"></span></span>
                                </div>
                            </div>
                            @if(count($wishlists))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="product-image">#</th>
                                            <th class="product-image">Avatar</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-stock">Stock Status</th>
                                            <th class="product-remove">Delete</th>
                                            <th class="product-cart">Action</th>
                                            <th class="product-cart">Date/Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($wishlists as $wishlist)
                                            @php($product = $wishlist->product)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <a href="{{ route('product.page',['id'=>$product->id]) }}">
                                                        @if(isset($product->product_image->front_image))
                                                            <img
                                                                src="{{ asset('storage/photos/'.$product->product_image->front_image) }}"
                                                                alt="image" width="100">
                                                        @elseif(isset($product->product_image->back_image))
                                                            <img
                                                                src="{{ asset('storage/photos/'.$product->product_image->back_image) }}"
                                                                alt="image" width="100">
                                                        @elseif(isset($product->product_image->left_image))
                                                            <img
                                                                src="{{ asset('storage/photos/'.$product->product_image->left_image) }}"
                                                                alt="image" width="100">
                                                        @elseif(isset($product->product_image->right_image))
                                                            <img
                                                                src="{{ asset('storage/photos/'.$product->product_image->right_image) }}"
                                                                alt="image" width="100">
                                                        @else
                                                            <img
                                                                src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                                alt="image" width="100">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td><a
                                                        href="{{ route('product.page',['id'=>$product->id]) }}">{{ $product->name }}</a>
                                                </td>
                                                <td>{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($product->selling_price,2) }}</td>
                                                <td>
                                                    @if ($product->available_quantity > 0)
                                                        In Stock
                                                    @else
                                                        Out Of Stock
                                                    @endif
                                                </td>
                                                <td>
                                                    <button wire:click="remove('{{ $wishlist->id }}')"
                                                            class="btn btn-danger btn-sm"><span
                                                            class="fa fa-trash-o"></span></button>
                                                </td>
                                                <td>
                                                    <button class="btn-primary btn btn-sm" type="button"
                                                            wire:click="$emit('add','{{ $product->id }}','shopping')">
                                                        <span class="fa fa-cart-plus"></span>
                                                    </button>
                                                </td>
                                                <td>{{ date('F d, Y h:i a', strtotime($wishlist->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation example">
                                        {{ $wishlists->links() }}
                                    </nav>
                                </div>
                            @else
                                <center>
                                    <hr>
                                    <a href="{{ route('shop') }}" class="btn btn-outline-success btn-sm"><span
                                            class="fa fa-shopping-basket"></span> Shop</a>
                                    <hr>
                                </center>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
