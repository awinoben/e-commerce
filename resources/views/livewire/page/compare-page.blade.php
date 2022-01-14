<div>
    <!--=====================
Breadcrumb Aera Start
=========================-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{ route('home') }}">Home</a></h1>
                            </li>
                            <li>Compare</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->

    <!--======================
    Compare area Start
    ==========================-->
    <div class="compare-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" wire:poll.keep-alive>
                @if(count($cartItems))
                    <!-- Compare Title Start -->
                        <div class="cart-title">
                            <h5 class="last-title mt-45 mb-20">Compare</h5>
                        </div>
                        <!-- Compare Title End -->
                        <!-- Compare Table Area Start -->
                        <div class="compare-table">
                            <div class="table table-responsive">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="first-column">Product Image</td>
                                        @foreach ($cartItems as $cartItem)
                                            @php($product = $cartItem->model)
                                            <td class="product-image-title">
                                                <a href="{{ route('product.page',['id'=>$product->id]) }}"
                                                   class="image">
                                                    @if(isset($product->product_image->front_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->front_image) }}"
                                                            alt="image" width="150">
                                                    @elseif(isset($product->product_image->back_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->back_image) }}"
                                                            alt="image" width="150">
                                                    @elseif(isset($product->product_image->left_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->left_image) }}"
                                                            alt="image" width="150">
                                                    @elseif(isset($product->product_image->right_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->right_image) }}"
                                                            alt="image" width="150">
                                                    @else
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                            alt="image" width="150">
                                                    @endif
                                                </a>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Product Name</td>
                                        @foreach ($cartItems as $cartItem)
                                            @php($product = $cartItem->model)
                                            <td class="product-image-title">
                                                <a href="{{ route('product.page',['id'=>$product->id]) }}"
                                                   class="category">{{ $product->name }}</a>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Description</td>
                                        @foreach ($cartItems as $cartItem)
                                            @php($product = $cartItem->model)
                                            <td class="pro-desc">
                                                <p>{{ $product->description }}</p>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Price</td>
                                        @foreach ($cartItems as $cartItem)
                                            @php($product = $cartItem->model)
                                            <td class="pro-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($product->selling_price,2) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Color</td>
                                        @foreach ($cartItems as $cartItem)
                                            @php($product = $cartItem->model)
                                            <td class="pro-color">
                                                @foreach ($product->color as $color)
                                                    {{ $color->value }} ,
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Stock</td>
                                        @foreach ($cartItems as $cartItem)
                                            @php($product = $cartItem->model)
                                            <td class="pro-stock">
                                                @if ($product->available_quantity > 0)
                                                    In Stock
                                                @else
                                                    Out Of Stock
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Add to cart</td>
                                        @foreach ($cartItems as $cartItem)
                                            @php($product = $cartItem->model)
                                            <td class="pro-addtocart"><a
                                                    wire:click="$emit('add','{{ $product->id }}','shopping')"
                                                    class="btn-secondary"
                                                    tabindex="0"><span>ADD TO CART</span></a>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Delete</td>
                                        @foreach ($cartItems as $cartItem)
                                            @php($product = $cartItem->model)
                                            <td class="pro-remove">
                                                <button  wire:click="$emit('remove','{{ $cartItem->rowId }}','compare')"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Compare Table Area End -->
                    @else
                        <center>
                            <hr>
                            <a href="{{ route('shop') }}" class="btn btn-lg btn-outline-success"><span
                                    class="fa fa-shopping-basket"></span></a>
                            <hr>
                        </center>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--======================
    Compare area End
    ==========================-->
</div>
