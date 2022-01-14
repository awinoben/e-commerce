<li class="settings">
    <div class="blockcart">
        <a href="#" class="drop-toggle">
            <img src="{{ asset('img/banner/cart.png') }}" alt="" height="50" width="50" class="img-fluid">
            <span class="my-cart">My Cart</span>
            <span class="count">{{ number_format(count($cartItems)) }}</span>
            <span
                class="total-item text-white">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ $subtotal }}</span>
        </a>
        <div class="cart-dropdown drop-dropdown">
            @if(count($cartItems))
                @php($count = 1)
                <ul>
                    @foreach($cartItems as $cartItem)
                        @if($count <= 3)
                            <li class="mini-cart-details">
                                <div class="innr-crt-img">
                                    @php($product = $cartItem->model)
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
                                    <span>{{ $cartItem->qty }}x</span>
                                </div>
                                <div class="innr-crt-content">
                                    <span class="product-price text-primary">{{ $cartItem->model->name }}</span>
                                    <span
                                        class="product-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($cartItem->price,2) }}</span>
                                    <a href="#" class="btn btn-danger" style="padding: 10px!important;"
                                       wire:click="$emit('remove','{{ $cartItem->rowId }}','shopping')">remove</a>
                                </div>
                            </li>
                            @php($count++)
                        @endif
                    @endforeach
                    <li>
                        <span class="subtotal-text">Subtotal</span>
                        <span
                            class="subtotal-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ $subtotal }}</span>
                    </li>
                    <li>
                        <span class="subtotal-text">Total</span>
                        <span
                            class="subtotal-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ $subtotal }}</span>
                    </li>
                </ul>
                <div class="checkout-cart">
                    <a href="{{ route('shopping.cart') }}" class="btn btn-outline-primary text-center"
                       style="padding: 10px!important;">View Cart</a>
                </div>
            @endif
        </div>
    </div>
</li>
