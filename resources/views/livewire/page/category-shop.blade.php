<div>
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
                        <nav class="categorye-menus category-dropdown" hidden>
                            <ul class="categories-expand">
                                @php($brands = [])
                                @foreach ($categories as $category)
                                    <li class="categories-hover-right">
                                        <a href="{{ route('category.shop', ['slug' => $category->slug]) }}">{{ $category->name }}
                                            <i class="fa fa-angle-right float-right"></i></a>
                                        <ul class="cat-submenu category-mega">
                                            @foreach ($category->sub_category->take(3) as $sub_category)
                                                <li class="cat-mega">
                                                    <a
                                                        href="{{ route('sub.category.shop', ['id' => $sub_category->id]) }}">{{ ucfirst(\Illuminate\Support\Str::lower($sub_category->name)) }}</a>
                                                    <ul>
                                                        {{-- @foreach ($sub_category->product->take(10) as $product)
                                                            @if (!in_array($product->brand->id, $brands))
                                                                <li><a href="#">{{ $product->brand->name }}</a></li>
                                                                @php(array_push($brands, $product->brand->id))
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
                    <div class="input-group input-group-sm mt-3">
                        <div class="input-group-prepend">
                            <select name="filter_sub_category_id" id="filter_sub_category_id" aria-label="Small"
                                    aria-describedby="inputGroup-sizing-sm" class="input-group-text"
                                    wire:model="filter_sub_category_id">
                                <option value="all" selected>-- All --</option>
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="search" class="form-control" aria-label="Small" wire:model="search"
                               aria-describedby="inputGroup-sizing-sm"
                               placeholder="Search part number, part name, model, product category, product name,brand name...">
                        <div class="input-group-append">
                            <button class="input-group-text" id="inputGroup-sizing-sm" type="submit"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom End  -->
    <div class="shop-fullwidth-area mt-50">
        <div class="header-container">
            <div class="row">
                <div class="col-lg-3">
                    <aside class="sidebar-widget mt-50">
                        <div class="shop-sidebar-category">
                            <div class="input-group input-group-sm mb-3">
                                      <span class="input-group-text" id="inputGroup-sizing-lg"><span
                                              class="fa fa-search"></span></span>
                                <input type="search" class="form-control" aria-label="Large" wire:model="search"
                                       aria-describedby="inputGroup-sizing-sm"
                                       title="Filter By Brand, Weight, Price Range, Screen Size, Colour, Processor..."
                                       placeholder="Filter By Brand, Weight, Price Range, Screen Size, Colour, Processor...">
                                <div class="input-group-prepend">
                                </div>
                            </div>
                            <div class="sidebar-title">
                                <h4 class="title-shop text-center">Filter by Category</h4>
                            </div>
                            <div>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--                            <ul class="sidebar-category-expand">--}}
                            {{--                                @foreach($categories as $category)--}}
                            {{--                                    <li class="menu-item-has-children active"><span class="menu-expand"><i--}}
                            {{--                                                class="fa fa-angle-down"></i></span>--}}
                            {{--                                        <a href="{{ route('category.shop', ['slug' => $category->slug]) }}">{{ $category->name }}</a>--}}
                            {{--                                        <ul class="sub-menu">--}}
                            {{--                                            @foreach($category->sub_category as $sub_category)--}}
                            {{--                                                <li class="menu-item-has-children"><span class="menu-expand"><i--}}
                            {{--                                                            class="fa fa-angle-down"></i></span>--}}
                            {{--                                                    <a href="{{ route('sub.category.shop', ['id' => $sub_category->id]) }}">{{ $sub_category->name }}</a>--}}
                            {{--                                                </li>--}}
                            {{--                                            @endforeach--}}
                            {{--                                        </ul>--}}
                            {{--                                    </li>--}}
                            {{--                                @endforeach--}}
                            {{--                            </ul>--}}
                        </div>
                        <div class="widget_inner widget-background mt-50">
                            <div class="widget_list widget_filter">
                                <div class="sidebar-title">
                                    <h4 class="title-shop">Filter by Price</h4>
                                </div>
                                <form action="#">
                                    <div id="slider-range"></div>
                                    <button type="submit">Filter</button>
                                    <input type="text" name="text" id="amount"/>
                                </form>
                            </div>
                            {{-- <div class="widget_list widget_categories mt-20">
                                <div class="sidebar-title">
                                    <h4 class="title-shop">Categories</h4>
                                </div>
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <input type="checkbox" wire:click="filterCategory('{{ $category->id }}')">
                                            <a>{{ $category->name }}</a>
                                            <span class="checkmark"></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div> --}}
                            <div class="widget_list widget_categories mt-20">
                                <div class="sidebar-title">
                                    <h4 class="title-shop">Brands</h4>
                                </div>
                                <ul>
                                    @foreach($brands as $brand)
                                        <li>
                                            <input type="checkbox" wire:click="filterBrand('{{ $brand->id }}')">
                                            <a>{{ $brand->name }}</a>
                                            <span class="checkmark"></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-9">
                    <div class="row shop-wrapper grid_4">
                        @if (count($products))
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-20">
                                    <!-- Single-Product-Start -->
                                    <div class="item-product pt-0">
                                        <div class="product-thumb">
                                            <a href="{{ route('product.page', ['id' => $product->id]) }}">
                                                <img
                                                    src="{{ isset($product->product_image->front_image) ? asset('storage/photos/' . $product->product_image->front_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 300) }}"
                                                    alt="" class="img-fluid">
                                            </a>
                                            <div class="action-link">
                                                <a class="quick-view same-link" href="#" title="Quick view"
                                                   data-toggle="modal" data-target="#modal_box"
                                                   data-original-title="quick view"><i
                                                        class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                                <a class="compare-add same-link"
                                                   wire:click="$emit('add','{{ $product->id }}','compare')"
                                                   title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></a>
                                                <a class="wishlist-add same-link"
                                                   wire:click="$emit('add','{{ $product->id }}','wishlist')"
                                                   title="Add to wishlist"><i
                                                        class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a
                                                    href="{{ route('product.page', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                            </div>
                                            <div class="rating">
                                                <p class="text-uppercase">{{ $product->brand->name }}</p>
                                            </div>
                                            <div class="price-box">
                                                    <span
                                                        class="regular-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }}
                                                        {{ number_format($product->selling_price, 2) }}</span>
                                            </div>
                                            <div class="cart">
                                                <div class="add-to-cart">
                                                    <button class="btn btn-green" title="Add to cart"
                                                            wire:click="$emit('add','{{ $product->id }}','shopping')">
                                                        <span wire:loading.class="fa fa-spinner fa-spin"></span>
                                                        <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single-Product-End -->
                                </div>
                            @endforeach
                            <div class="container">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-outline-success btn-sm text-uppercase" wire:click="loadMore">
                                        <span class="fa fa-refresh"></span> Load
                                        More
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <center>
                                    <img src="{{ asset('img/logo.png') }}" alt="" width="150">
                                    <hr>
                                    <p class="text-center text-capitalize">No products available</p>
                                    <hr>
                                </center>
                            </div>
                            <div class="col-lg-3"></div>
                        @endif
                    </div>
                    <!-- Shop Wrapper End -->
                </div>
            </div>
        </div>
    </div>
</div>
