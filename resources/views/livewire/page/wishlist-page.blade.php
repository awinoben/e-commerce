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
                            <li>Wishlist</li>
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
    wishlist area Start
    ==========================-->
    <div class="wishlist-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" wire:poll.keep-alive>
                @if(count($cartItems))
                    <!-- Wishlist Title Start -->
                        <div class="wishlist-title">
                            <h5 class="last-title mt-50 mb-20">Wishlist</h5>
                        </div>
                        <!-- Wishlist Title End -->
                        <div class="table-desc wishlist-margin">
                            <div class="wishlist-page cart-page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-image">Avatar</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-stock">Stock Status</th>
                                        <th class="product-remove">Delete</th>
                                        <th class="product-cart">Add to Cart</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cartItems as $cartItem)
                                        @php($product = $cartItem->model)
                                        <tr>
                                            <td class="product-image">
                                                <a href="{{ route('product.page',['id'=>$product->id]) }}">
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
                                            <td class="product-name"><a
                                                    href="{{ route('product.page',['id'=>$product->id]) }}">{{ $product->name }}</a>
                                            </td>
                                            <td class="product-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($product->selling_price,2) }}</td>
                                            <td class="product-stock">
                                                @if ($product->available_quantity > 0)
                                                    In Stock
                                                @else
                                                    Out Of Stock
                                                @endif
                                            </td>
                                            <td class="product-remove"><a
                                                    wire:click="$emit('remove','{{ $cartItem->rowId }}','wishlist')"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product-cart">
                                                <button class="btn-secondary btn" type="button"
                                                        wire:click="$emit('add','{{ $product->id }}','shopping')">
                                                    Add To Cart
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>
                                            <button wire:click="save" class="btn btn-outline-primary btn-lg"><span
                                                    wire:loading.class="fa fa-spinner fa-spin"></span> Sync To Account
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="wishlist-shear desc-content justify-content-center no-border-bottom mt-20 no-margin-bottom">
                                <div class="social_sharing">
                                    <h5 class="text-center">share this post</h5>
                                    <ul class="mt-0">
                                        <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" title="google+"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
    wishlist area Start
    ==========================-->
</div>
