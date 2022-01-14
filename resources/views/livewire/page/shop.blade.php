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
                            <li>Shop</li>
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
    Shop area Start
    ==========================-->
    <div class="shop-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <aside class="sidebar-widget mt-50">
                        <div class="shop-sidebar-category">
                            <div class="input-group input-group-sm mb-3">
                                      <span class="input-group-text" id="inputGroup-sizing-lg"><span
                                              class="fa fa-search"></span></span>
                                <input type="search" class="form-control" aria-label="Large" wire:model="search"
                                       aria-describedby="inputGroup-sizing-sm" title="Filter By Brand, Weight, Price Range, Screen Size, Colour, Processor..."
                                       placeholder="Filter By Brand, Weight, Price Range, Screen Size, Colour, Processor...">
                                <div class="input-group-prepend">
                                </div>
                            </div>
                            <div class="sidebar-title">
                                <h4 class="title-shop text-center">Shop</h4>
                            </div>
                            <ul class="sidebar-category-expand">
                                @foreach($categories as $category)
                                    <li class="menu-item-has-children active"><span class="menu-expand"><i
                                                class="fa fa-angle-down"></i></span>
                                        <a href="{{ route('category.shop', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                                        <ul class="sub-menu">
                                            @foreach($category->sub_category as $sub_category)
                                                <li class="menu-item-has-children"><span class="menu-expand"><i
                                                            class="fa fa-angle-down"></i></span>
                                                    <a href="{{ route('sub.category.shop', ['id' => $sub_category->id]) }}">{{ $sub_category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
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
                            <div class="widget_list widget_categories mt-20">
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
                            </div>
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
                        <!-- Shop Banner Start -->
                        <div class="single-banner text-center mt-50 mb-30">
                            @if (count($slide))
                                <a href="{{ $slide[0]->url }}"><img
                                        src="{{ asset('storage/photos/'.$slide[0]->slide_image) }}"
                                        alt="" style="width: 870px;!important; height: 248px!important;"
                                        class="img-fluid"></a>
                            @else
                                <a href="#"><img
                                        src="https://i.pinimg.com/originals/31/f2/89/31f289e7a1b73ade73051f206550bb03.jpg"
                                        alt="" style="width: 870px;!important; height: 248px!important;"
                                        class="img-fluid"></a>
                            @endif
                        </div>
                        <!-- Shop Banner End -->
                    </aside>
                </div>

                <div class="col-lg-9 order-first order-lg-last">
                    <!-- Shop Banner Start -->
                {{-- <div class="single-banner mt-50 mb-50">
                    @if (count($slide))
                        <a href="{{ count($slide) > 1 ? $slide[1]->url : $slide[0]->url }}"><img
                                src="{{ asset('storage/photos/'.count($slide) > 1 ? $slide[1]->slide_image : $slide[0]->slide_image) }}"
                                alt="" style="width: 870px;!important; height: 248px!important;"
                                class="img-fluid"></a>
                    @else
                        <a href="#"><img
                                src="https://i.pinimg.com/originals/31/f2/89/31f289e7a1b73ade73051f206550bb03.jpg"
                                alt="" style="width: 870px;!important; height: 248px!important;"
                                class="img-fluid"></a>
                    @endif
                </div> --}}
                <!-- Shop Banner End -->
                @if(count($products))
                    <!-- Shop Wrapper Start -->
                        <div class="row shop-wrapper grid_3">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
                                    <!-- Single-Product-Start -->
                                    <div class="item-product pt-0">
                                        <div class="product-thumb">
                                            <a href="{{ route('product.page',['id'=>$product->id]) }}">
                                                @if(isset($product->product_image->front_image))
                                                    <img
                                                        src="{{ asset('storage/photos/'.$product->product_image->front_image) }}"
                                                        class="img-fluid" alt="image" width="400">
                                                @elseif(isset($product->product_image->back_image))
                                                    <img
                                                        src="{{ asset('storage/photos/'.$product->product_image->back_image) }}"
                                                        class="img-fluid" alt="image" width="400">
                                                @elseif(isset($product->product_image->left_image))
                                                    <img
                                                        src="{{ asset('storage/photos/'.$product->product_image->left_image) }}"
                                                        class="img-fluid" alt="image" width="400">
                                                @elseif(isset($product->product_image->right_image))
                                                    <img
                                                        src="{{ asset('storage/photos/'.$product->product_image->right_image) }}"
                                                        class="img-fluid" alt="image" width="400">
                                                @else
                                                    <img
                                                        src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,400) }}"
                                                        class="img-fluid" alt="image" width="400">
                                                @endif
                                            </a>
                                            <div class="box-label">
                                            </div>
                                            <div class="action-link">
                                                <a class="quick-view same-link" href="#" title="Quick view"
                                                   data-toggle="modal"
                                                   data-target="#{{ \Illuminate\Support\Str::slug($product->id) }}"
                                                   data-original-title="quick view"><i
                                                        class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                                <a class="compare-add same-link"
                                                   wire:click="$emit('add','{{ $product->id }}','compare')"
                                                   title="Add to compare"><i
                                                        class="zmdi zmdi-refresh-alt"></i></a>
                                                <a class="wishlist-add same-link"
                                                   wire:click="$emit('add','{{ $product->id }}','wishlist')"
                                                   title="Add to wishlist"><i
                                                        class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="{{ route('product.page',['id'=>$product->id]) }}">{{ $product->name }}</a>
                                            </div>
                                            <div class="rating">
                                                <p class="text-uppercase">{{ $product->brand->name }}</p>
                                            </div>
                                            <div class="price-box">
                                                <span
                                                    class="regular-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($product->selling_price,2) }}</span>
                                                {{--                                                <span class="old-price"><del>$350.50</del></span>--}}
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

                                {{--modal--}}
                                {{-- @livewire('inc.modal', ['product' => $product]) --}}
                            @endforeach
                        </div>
                        <!-- Shop Wrapper End -->
                        <!-- Shop Toolbar Start -->
                    {{--                        <div class="toolbar-shop toolbar-bottom">--}}
                    {{--                            --}}{{--                            <div class="page-amount">--}}
                    {{--                            --}}{{--                                <p>Showing 1-10 of 30 results</p>--}}
                    {{--                            --}}{{--                            </div>--}}
                    {{--                            <div class="pagination">--}}
                    {{--                                <ul class="float-right">--}}
                    {{--                                    {{ $products->links() }}--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    <!-- Shop Toolbar End -->
                        <div class="container">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-outline-success btn-sm text-uppercase" wire:click="loadMore">
                                    <span class="fa fa-refresh"></span> Load
                                    More
                                </button>
                            </div>
                        </div>
                    @else
                        <div>
                            <center>
                                <img src="{{ asset('img/logo.png') }}" alt="" width="150">
                                <hr>
                                <p class="text-center text-uppercase">No products available yet.</p>
                                <hr>
                            </center>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--======================
    Shop area End
    ==========================-->
</div>
