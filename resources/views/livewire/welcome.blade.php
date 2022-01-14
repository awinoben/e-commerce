<div>
    <div class="header-area header-three sticker">
        <!-- Header Top Start -->
        <div class="header-top full-border text-white" style="background-color: #131921;">
            <div class="header-container">
                <div class="row">
                    <div class="col-lg-2 col-12">
                        <div class="header-top-left">
                            <div class="logo">
                                <a href="{{ route('welcome') }}"><img src="{{ asset('img/logo.png') }}" height="70"
                                        width="140" alt="" class="img-fluid"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-12">
                        <div class="box-right ml-auto">
                            <ul>
                                <li class="settings">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="settings">
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li class="settings font-weight-bold">
                                    <a href="{{ route('welcome') }}">
                                        <span style="color: #0086f5">P</span>
                                        <span style="color: #ff4131">a</span>
                                        <span style="color: #00a94e">r</span>
                                        <span style="color: #0086f5">t</span>
                                        <span style="color: #ffbe02">s</span>
                                        <span>&nbsp;</span>
                                        <span style="color: #00a94e">F</span>
                                        <span style="color: #ff4131">i</span>
                                        <span style="color: #0086f5">n</span>
                                        <span style="color: #0086f5">d</span>
                                        <span style="color: #ffbe02">e</span>
                                        <span style="color: #ff4131">r</span>
                                    </a>
                                </li>
                                <li class="settings">
                                    <a href="#" class="drop-toggle">
                                        <span>{{ \App\Http\Controllers\SystemController::defaultCurrency() }}</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
{{--                                    <ul class="box-dropdown drop-dropdown text-dark">--}}
{{--                                        <li><a href="#">EUR €</a></li>--}}
{{--                                        <li><a href="#">USD $</a></li>--}}
{{--                                    </ul>--}}
                                </li>
                                <li class="settings">
                                    <a href="#" class="drop-toggle">
                                        <img src="{{ asset('img/banner/usa.jpg') }}" alt="">
                                        EN(USA)
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="box-dropdown drop-dropdown text-dark">
                                        <li>
                                            <a href="#"><img src="{{ asset('img/banner/usa.jpg') }}" alt="">
                                                EN(USA)</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="settings">
                                    <a href="#" class="drop-toggle">
                                        My Account
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="box-dropdown drop-dropdown text-dark">
                                        @if (\Illuminate\Support\Facades\Auth::check())
                                            <li><a href="{{ route('dashboard') }}">My Account</a>
                                            </li>
                                            <li><a href="{{ route('user.orders') }}">Orders</a></li>
                                            <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                            <li><a href="{{ route('wishlist.page') }}">WishList</a></li>
                                            <li><a href="{{ route('compare.page') }}">Compare</a></li>
                                            <li><a href="{{ route('user.logout') }}">Sign Out</a></li>
                                        @else
                                            <li><a href="{{ route('user.orders') }}">Orders</a></li>
                                            <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                            <li><a href="{{ route('wishlist.page') }}">WishList</a></li>
                                            <li><a href="{{ route('compare.page') }}">Compare</a></li>
                                            <li><a href="{{ route('login') }}">Sign In</a></li>
                                        @endif
                                    </ul>
                                </li>
                                @livewire('inc.cart-manager')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Top End -->
    </div>
    <div class="product-category-area">
        <div class="container">
            <div class="row" style="margin-top: 20vh;">
                <div class="col-lg-12">
                    <center>
                        <img src="{{ asset('img/partfinder.png') }}" alt="" height="200" width="300"
                            style="padding: 20px;">
                    </center>
                    {{-- <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <select name="filter_sub_category_id" id="filter_sub_category_id"
                                class="input-group-lg form-control" style="height: 50px!important;"
                                wire:model="filter_sub_category_id">
                                <option value="all" selected>--- All Parts ---</option>
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="search" class="form-control" aria-label="Large" wire:model="search"
                            aria-describedby="inputGroup-sizing-sm"
                            placeholder="Search for product by name, model No, part No...">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-lg"><span
                                    class="fa fa-shopping-basket"><sup><span
                                            class="badge badge-warning">{{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}</span></sup></span></span>
                        </div>
                    </div> --}}

                    {{-- <div class="input-group">
                        <select name="filter_sub_category_id" id="filter_sub_category_id" class="custom-select"
                                wire:model="filter_sub_category_id">
                            @foreach ($sub_categories as $sub_category)
                                @if ($sub_category->slug === 'parts-upgrades-and-parts-replacement')
                                    <option value="{{ $sub_category->id }}" :key="{{ $sub_category->id }}" selected>
                                        {{ $sub_category->name }}</option>
                                @else
                                    <option value="{{ $sub_category->id }}" :key="{{ $sub_category->id }}">
                                        {{ $sub_category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="search" class="form-control" aria-label="Large" wire:model="search"
                               aria-describedby="inputGroup-sizing-sm"
                               placeholder="Search for part by name,brand, model No, part No...">
                        <a href="#">
                            <div class="input-group-append">
                                <button class="btn btn-outline-green" type="button"><span
                                        class="fa fa-search"></span>
                                </button>
                            </div>
                        </a>
                    </div> --}}
                    <center>
                        <div class="bar">
                            <a href="#"><i class="text-muted fa fa-search"></i></a>
                            <input class="searchbar" type="text" placeholder="Search for Parts" title="Search for Parts"
                                wire:model="search">
                            <a href="#"> <img class="voice"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Google_mic.svg/716px-Google_mic.svg.png"
                                    title="Search by Voice"></a>
                        </div>
                        <div class="buttons">
                            <button class="button" type="button">Search for parts by Part Number/Machine Model.</button>
                        </div>
                    </center>
                    <div class="col-md-12">
                        <div wire:loading>
                            <center>
                                Searching...
                            </center>
                        </div>
                    </div>
                </div>
                @if (count($products))
                    <div class="col-lg-12">
                        <div class="product-thing-tab slick-custom-default" style="padding: 20px">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-md-3" style="padding-bottom: 50px">
                                        <div class="item-product">
                                            <div class="product-thumb">
                                                <a href="{{ route('product.page', ['id' => $product->id]) }}">
                                                    @if (isset($product->product_image->front_image))
                                                        <img src="{{ asset('storage/photos/' . $product->product_image->front_image) }}"
                                                            alt="" class="img-fluid" width="400" height="500">
                                                    @elseif(isset($product->product_image->back_image))
                                                        <img src="{{ asset('storage/photos/' . $product->product_image->back_image) }}"
                                                            alt="" class="img-fluid" width="400" height="500">
                                                    @elseif(isset($product->product_image->left_image))
                                                        <img src="{{ asset('storage/photos/' . $product->product_image->left_image) }}"
                                                            alt="" class="img-fluid" width="400" height="500">
                                                    @elseif(isset($product->product_image->right_image))
                                                        <img src="{{ asset('storage/photos/' . $product->product_image->right_image) }}"
                                                            alt="" class="img-fluid" width="400" height="500">
                                                    @else
                                                        <img src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                                            alt="" class="img-fluid" width="400" height="500">
                                                    @endif
                                                </a>
                                                <div class="action-link">
                                                    <a class="quick-view same-link" href="#" title="Quick view"
                                                        data-toggle="modal"
                                                        data-target="#{{ \Illuminate\Support\Str::slug($product->id) }}"
                                                        data-original-title="quick view"><i
                                                            class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                                    <a class="compare-add same-link"
                                                        wire:click="$emit('addCart','{{ $product->id }}','compare')"
                                                        title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></a>
                                                    <a class="wishlist-add same-link"
                                                        wire:click="$emit('addCart','{{ $product->id }}','wishlist')"
                                                        title="Add to wishlist"><i
                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name text-center">
                                                    <a
                                                        href="{{ route('product.page', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                </div>
                                                <div class="rating text-center">
                                                    <p class="text-uppercase">{{ $product->brand->name }}</p>
                                                </div>
                                                <div class="price-box text-center">
                                                    <span
                                                        class="regular-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }}
                                                        {{ number_format($product->selling_price, 2) }}</span>
                                                </div>
                                                <div class="cart">
                                                    <div class="add-to-cart">
                                                        <button class="btn btn-green" title="Add to cart"
                                                            wire:click="$emit('addCart','{{ $product->id }}','shopping')">
                                                            <span wire:loading.class="fa fa-spinner fa-spin"></span>
                                                            <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- modal --}}
                                    {{-- @livewire('inc.modal', ['product' => $product]) --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    @if (!is_null($search) && $search != '')
                        <div class="col-lg-12" style="padding: 20px!important">
                            <center>
                                <img src="{{ asset('img/logo.png') }}" alt="" width="150">
                                <hr>
                                <p class="text-center">No Product(s) Available.</p>
                                <hr>
                            </center>
                        </div>
                    @endif
                @endif
            </div>
            <div class="row fixed-row-bottom">
                <div class="col-lg-12">
                    <div>
                        <p class="text-center">&copy; {{ date('Y') }} {{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
