<div>
    <div class="header-area header-three sticker">
        <!-- Header Top Start -->
        <div class="header-top full-border text-white" style="background-color: #131921;">
            <div class="header-container">
                <div class="row">
                    <div class="col-lg-2 col-12">
                        <div class="header-top-left">
                            <div class="logo">
                                <a href="{{ route('welcome') }}"><img src="{{ asset('img/logo.png') }}"
                                                                      height="70" width="140" alt=""
                                                                      class="img-fluid"></a>
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
        <!-- Header Bottom Start -->
        <div class="header-menu header-bottom-area theme-header-menu-bg">
            <div class="header-container">
                <div class="row">
                    <div class="col-lg-3">
                        <!-- Category Menu Start -->
                        <div class="categoryes-menu-bar">
                            <div class="categoryes-menu-btn category-toggle">
                                <div class="float-left">
                                    <a href="#">All Categories</a>
                                </div>
                                <div class="float-right">
                                    <i class="fa fa-bars"></i>
                                </div>
                            </div>
                            <nav class="categorye-menus category-dropdown">
                                <ul class="categories-expand">
                                    @php($brands = [])
                                    @foreach ($categories as $category)
                                        <li class="categories-hover-right">
                                            <a href="{{ route('category.shop', ['slug' => $category->slug]) }}">{{ $category->name }}
                                                <i class="fa fa-angle-right float-right"></i></a>
                                            <ul class="cat-submenu category-mega">
                                                @foreach ($category->sub_category->take(3) as $sub_category)
                                                    <li class="cat-mega">
                                                        <a href="{{ route('sub.category.shop', ['id' => $sub_category->id]) }}">{{ ucfirst(\Illuminate\Support\Str::lower($sub_category->name)) }}</a>
                                                        <ul>
                                                            {{-- @foreach ($sub_category->product->take(10) as $product)
                                                                @if (!in_array($product->brand->id, $brands))
                                                                    <li><a href="#">{{ $product->brand->name }}</a></li>
                                                                    @php(array_push($brands,$product->brand->id))
                                                                @endif
                                                            @endforeach --}}
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                    <li class="category-item-parent">
                                        <a href="#" class="more-btn">More Category</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Category Menu End -->
                    </div>
                    <div class="col-lg-9">
                        <form wire:submit.prevent="searchBar">
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <select name="select" id="category2" aria-label="Small"
                                            aria-describedby="inputGroup-sizing-sm" class="input-group-text"
                                            wire:model="category_id">
                                        <option value="all" selected>All categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="search" class="form-control" aria-label="Small" wire:model="name"
                                       aria-describedby="inputGroup-sizing-sm"
                                       placeholder="Search product by name,brand..">
                                <div class="input-group-append">
                                    <button class="input-group-text" id="inputGroup-sizing-sm" type="submit"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        {{-- <div class="search-container">
                            <form wire:submit.prevent="searchBar">
                                <div class="top-cat">
                                    <select class="select-option" name="select" id="category2" wire:model="category_id">
                                        <option value="all" disabled selected>All categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="search_box">
                                    <input class="header-search" wire:model.debounce.5000ms="name"
                                           placeholder="Search product by Part Number, name, model number..."
                                           type="text">
                                    <button class="header-search-button" type="submit">Search</button>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom End  -->
    </div>
</div>
