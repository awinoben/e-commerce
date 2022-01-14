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
                            <li>Cart</li>
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
    Shopping Cart area Start
    ==========================-->
    <div class="cart-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" wire:poll.keep-alive>
                    <!-- Cart Title Start -->
                    <div class="cart-title">
                        <h5 class="last-title mt-50 mb-20">Shopping Cart</h5>
                    </div>
                    @if(count($cartItems))
                        <div class="table-desc">
                            <div class="cart-page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-image">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-remove">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cartItems as $cartItem)
                                        <tr>
                                            <td class="product-image">
                                                @php($product = $cartItem->model)
                                                @if(isset($product->product_image->front_image))
                                                    <img
                                                        src="{{ asset('storage/photos/'.$product->product_image->front_image) }}"
                                                        alt="image" width="50">
                                                @elseif(isset($product->product_image->back_image))
                                                    <img
                                                        src="{{ asset('storage/photos/'.$product->product_image->back_image) }}"
                                                        alt="image" width="50">
                                                @elseif(isset($product->product_image->left_image))
                                                    <img
                                                        src="{{ asset('storage/photos/'.$product->product_image->left_image) }}"
                                                        alt="image" width="50">
                                                @elseif(isset($product->product_image->right_image))
                                                    <img
                                                        src="{{ asset('storage/photos/'.$product->product_image->right_image) }}"
                                                        alt="image" width="50">
                                                @else
                                                    <img
                                                        src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                        alt="image" width="50">
                                                @endif
                                            </td>
                                            <td class="product-name">
                                                <a href="#">{{ $cartItem->model->name }}</a>
                                            </td>
                                            <td class="product-price">
                                                {{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($cartItem->price,2) }}</td>
                                            <td class="product-quantity">
                                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"
                                                wire:click="$emit('updateMinus','{{ $cartItem->rowId }}','shopping','{{ $cartItem->qty }}')"
                                                data-type="minus" data-field="">
                                          <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                                    <input min="1" class="form-control input-number text-center"
                                                           max="{{ $cartItem->model->available_quantity }}"
                                                           value="{{ $cartItem->qty }}"
                                                           type="text">
                                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number"
                                                wire:click="$emit('updatePlus','{{ $cartItem->rowId }}','shopping','{{ $cartItem->qty }}')"
                                                data-type="plus" data-field="">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                                </div>
                                            </td>
                                            <td class="product-total">
                                                {{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($cartItem->price * $cartItem->qty,2) }}</td>
                                            <td class="product-remove">
                                                <a href="#"
                                                   wire:click="$emit('remove','{{ $cartItem->rowId }}','shopping')"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button wire:click="$emit('destroy','shopping')"
                                        class="btn btn-danger float-right btn-lg text-uppercase"
                                        style="margin: 10px!important;">
                                    <span wire:loading.class="fa fa-spinner fa-spin"></span> clear cart
                                </button>
                            </div>
                        </div>
                        <div class="coupon-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="coupon-code left">
                                        <h3>Coupon</h3>
                                        <div class="coupon-inner">
                                            <p>Enter your coupon code if you have one.</p>
                                            <input placeholder="Coupon code" type="text">
                                            <button type="submit">Apply coupon</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="coupon-code right">
                                        <h3>Cart Totals</h3>
                                        <div class="coupon-inner">
                                            <div class="cart-subtotal">
                                                <p>Subtotal</p>
                                                <p class="cart-amount">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ $subtotal }}</p>
                                            </div>
                                            {{--                                            <div class="cart-subtotal ">--}}
                                            {{--                                                <p>Shipping</p>--}}
                                            {{--                                                <p class="cart-amount"><span>Flat Rate:</span> £255.00</p>--}}
                                            {{--                                            </div>--}}
                                            <a href="#">Calculate shipping</a>

                                            <div class="cart-subtotal">
                                                <p>Total</p>
                                                <p class="cart-amount">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ $subtotal }}</p>
                                            </div>
                                            <div class="checkout-btn">
                                                <a href="{{ route('checkout.page') }}">
                                                    <span wire:loading.class="fa fa-spinner fa-spin"></span> Proceed to
                                                    Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <center>
                            <hr>
                            <a href="{{ route('shop') }}" class="btn btn-lg btn-outline-success"><span class="fa fa-shopping-basket"></span></a>
                            <hr>
                        </center>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--======================
    Shopping Cart area End
    ==========================-->
</div>
