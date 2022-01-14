<div>
    <!--=====================
    slider area start
    =========================-->
    <div class="slider_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="slider_area slider-one">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if (count($slides))
                                    @foreach ($slides as $slide)
                                        {{-- <div class="single_slider">
                                            <img src="{{ asset('storage/photos/' . $slide->slide_image) }}" alt=""
                                                 class="img-fluid" width="870" height="448"
                                                 style="width:870px!important; height:470px!important">
                                            <div class="slider_content color_two">
                                                <h2>{{ $slide->name }}</h2>
                                                <a href="{{ $slide->url }}" class="bg-success">Shop Now</a>
                                            </div>
                                        </div> --}}
                                        <div class="carousel-item">
                                            <img class="d-block"
                                                 src="{{ asset('storage/photos/' . $slide->slide_image) }}"
                                                 alt="Slider">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <img class="d-block" src="{{ asset('img/banner/comp_access.jpg') }}"
                                             alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block" src="{{ asset('img/banner/comp_access.jpg') }}"
                                             alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block" src="{{ asset('img/banner/comp_access.jpg') }}"
                                             alt="Third slide">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======================
        slider area End
    ==========================-->

    <!--=====================
    Home Product Area Start
    =========================-->
    <div class="home3-product home4-product-area" style="margin-top: -400px">
        <div class="container">
            <div class="col-md-12">
                <div class="col-lg-12 order-lg-1 order-2">
                    <!-- Product slide home 2 start -->
                    <div class="product-slide-home2">
                        {{-- <div class="block-title">
                            <h6>New Arrivals</h6>
                        </div> --}}
                        <div class="product-carousel-home2 slick-custom slick-custom-default nav-top mt-2">
                            @foreach ($categories as $category)
                                @if (count($category->product))
                                    @foreach ($category->product->take(1) as $product)
                                        <div class="product-row">
                                            <!-- Single-Product-Start -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6>{{ $product->category->name }}</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="item-product" style="height: 450px">
                                                        <div class="product-thumb">
                                                            <a href="{{ route('product.page', ['id' => $product->id]) }}">
                                                                @if (isset($product->product_image->front_image))
                                                                    <img
                                                                        src="{{ asset('storage/photos/' . $product->product_image->front_image) }}"
                                                                        class="img-fluid" alt="image" width="300">
                                                                @elseif(isset($product->product_image->back_image))
                                                                    <img
                                                                        src="{{ asset('storage/photos/' . $product->product_image->back_image) }}"
                                                                        class="img-fluid" alt="image" width="300">
                                                                @elseif(isset($product->product_image->left_image))
                                                                    <img
                                                                        src="{{ asset('storage/photos/' . $product->product_image->left_image) }}"
                                                                        class="img-fluid" alt="image" width="300">
                                                                @elseif(isset($product->product_image->right_image))
                                                                    <img
                                                                        src="{{ asset('storage/photos/' . $product->product_image->right_image) }}"
                                                                        class="img-fluid" alt="image" width="300">
                                                                @else
                                                                    <img
                                                                        src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                                                        class="img-fluid" alt="image" width="300">
                                                                @endif
                                                            </a>
                                                            <div class="action-link">
                                                                <a class="quick-view same-link" href="#"
                                                                   title="Quick view"
                                                                   data-toggle="modal"
                                                                   data-target="#{{ \Illuminate\Support\Str::slug($product->id) }}"
                                                                   data-original-title="quick view"><i
                                                                        class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                                                <a class="compare-add same-link"
                                                                   wire:click="$emit('add','{{ $product->id }}','compare')"
                                                                   title="Add to compare"><i
                                                                        class="zmdi zmdi-refresh-alt"></i></a>
                                                                <a class="wishlist-add same-link"
                                                                   title="Add to wishlist"
                                                                   wire:click="$emit('add','{{ $product->id }}','wishlist')"><i
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
                                                                        <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single-Product-End -->
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @php($count = 1)
                    @foreach ($categories as $category)
                        @if (count($category->product))
                            <div class="product-slide-home2 mb-20 mt-10">
                                <div class="block-title">
                                    <h6>{{ $category->name }}</h6>
                                </div>
                                <div class="product-carousel-home2 slick-custom slick-custom-default nav-top">
                                    @foreach ($category->product as $product)
                                        <div class="product-row">
                                            <!-- Single-Product-Start -->
                                            <div class="item-product">
                                                <div class="product-thumb">
                                                    <a href="{{ route('product.page', ['id' => $product->id]) }}">
                                                        @if (isset($product->product_image->front_image))
                                                            <img
                                                                src="{{ asset('storage/photos/' . $product->product_image->front_image) }}"
                                                                class="img-fluid" alt="image" width="300">
                                                        @elseif(isset($product->product_image->back_image))
                                                            <img
                                                                src="{{ asset('storage/photos/' . $product->product_image->back_image) }}"
                                                                class="img-fluid" alt="image" width="300">
                                                        @elseif(isset($product->product_image->left_image))
                                                            <img
                                                                src="{{ asset('storage/photos/' . $product->product_image->left_image) }}"
                                                                class="img-fluid" alt="image" width="300">
                                                        @elseif(isset($product->product_image->right_image))
                                                            <img
                                                                src="{{ asset('storage/photos/' . $product->product_image->right_image) }}"
                                                                class="img-fluid" alt="image" width="300">
                                                        @else
                                                            <img
                                                                src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                                                class="img-fluid" alt="image" width="300">
                                                        @endif
                                                    </a>
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
                                                        <a class="wishlist-add same-link" title="Add to wishlist"
                                                           wire:click="$emit('add','{{ $product->id }}','wishlist')"><i
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
                                                                <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single-Product-End -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    @endif
                    @php($count++)
                @endforeach
                <!-- Product Slide Home 2 End -->
                    <!-- Shipping Area Start -->
                    <div class="row mt-10">
                        <div class="col-12">
                            <div class="single-shipping single-shipping-last single-delivery">
                                <div class="block-wrapper">
                                    <div class="shipping-content">
                                        <h5 class="ship-title">Free Delivery</h5>
                                        <p>Free shipping on all order</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single-shipping single-shipping-last single-delivery">
                                <div class="block-wrapper2">
                                    <div class="shipping-content">
                                        <h5 class="ship-title">Online Support 24/7</h5>
                                        <p>Free shipping on all order</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single-shipping single-shipping-last single-delivery">
                                <div class="block-wrapper3">
                                    <div class="shipping-content">
                                        <h5 class="ship-title">Money Return</h5>
                                        <p>Free shipping on all order</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shipping Area End -->
                </div>
                <!-- Banner area Start -->
                <div class="banner-area">
                    <div class="single-banner mt-30">
                        <a href="{{ route('shop') }}"><img src="{{ asset('img/banner/banner2-4.png') }}" alt=""
                                                           class="img-fluid"></a>
                    </div>
                </div>
                <!-- Banner Area End -->
            </div>
            {{-- <div class="row">
<div class="col-lg-3 order-lg-2 order-1">
    <div class="left-side-wrapper">
        <!-- Product List Sidebar Start -->
        <div class="product-list-slidebar mt-40">
            <div class="block-title">
                <h6>New Arrivals</h6>
            </div>
            <div class="feature-carousel slick-custom slick-custom-default list-home3 nav-top">
                <div class="product-list-content">
                    @foreach ($products as $product)
                        <div class="single-product-list mb-20">
                            <div class="product-list-image">
                                <a href="{{ route('product.page', ['id' => $product->id]) }}">
                                    @if (isset($product->product_image->front_image))
                                        <img
                                            src="{{ asset('storage/photos/' . $product->product_image->front_image) }}"
                                            class="img-fluid block-one" alt="image" width="393">
                                        <img
                                            src="{{ asset('storage/photos/' . $product->product_image->front_image) }}"
                                            class="img-fluid block-two" alt="image" width="393">
                                    @elseif(isset($product->product_image->back_image))
                                        <img
                                            src="{{ asset('storage/photos/' . $product->product_image->back_image) }}"
                                            class="img-fluid block-one" alt="image" width="393">
                                        <img
                                            src="{{ asset('storage/photos/' . $product->product_image->back_image) }}"
                                            class="img-fluid block-two" alt="image" width="393">
                                    @elseif(isset($product->product_image->left_image))
                                        <img
                                            src="{{ asset('storage/photos/' . $product->product_image->left_image) }}"
                                            class="img-fluid block-one" alt="image" width="393">
                                        <img
                                            src="{{ asset('storage/photos/' . $product->product_image->left_image) }}"
                                            class="img-fluid block-two" alt="image" width="393">
                                    @elseif(isset($product->product_image->right_image))
                                        <img
                                            src="{{ asset('storage/photos/' . $product->product_image->right_image) }}"
                                            class="img-fluid block-one" alt="image" width="393">
                                        <img
                                            src="{{ asset('storage/photos/' . $product->product_image->right_image) }}"
                                            class="img-fluid block-two" alt="image" width="393">
                                    @else
                                        <img
                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                            class="img-fluid block-one" alt="image" width="393">
                                        <img
                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                            class="img-fluid block-two" alt="image" width="393">
                                    @endif
                                </a>
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
                                    <span class="regular-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }}
                                        {{ number_format($product->selling_price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Product List Sidebar End -->
        <!-- Left Side Banner Start -->
        <div class="banner-area">
            <div class="single-banner mt-35">
                <a href="{{ route('shop') }}"><img
                        src="https://waptech.net/wp-content/uploads/2020/09/small-banner-_0006_2-_Computer-Accessories_-300x300.jpg"
                        alt=""
                        class="img-fluid"></a>
            </div>
        </div>
        <!-- Left Side Banner End -->
    </div>
</div>
</div> --}}
        </div>
    </div>
    <!--======================
                    Home Product Area End
                    ==========================-->

    <!-- =================
                    Category Product Area Start
                    =====================-->
    <div class="product-category-area mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs category-tabs">
                        @php($count = 1)
                        @foreach ($categories as $category)
                            @if (count($category->product))
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_{{ $count }}" data-toggle="tab"
                                       href="#fusion_{{ $count }}">
                                                    <span><img src="{{ asset('img/banner/thumb-3.png') }}" alt=""
                                                               class="img-fluid"></span>
                                        <span>{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endif
                            @php($count++)
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @php($count = 1)
                        @foreach ($categories as $category)
                            @if (count($category->product))
                                <div
                                    class="product-thing-tab slick-custom-default tab-pane fade {{ $count == 1 ? 'show active' : '' }}"
                                    id="fusion_{{ $count }}">
                                    @foreach ($category->product as $product)
                                        <div class="item-product">
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
                                                    <a class="wishlist-add same-link" title="Add to wishlist"
                                                       wire:click="$emit('add','{{ $product->id }}','wishlist')"><i
                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a
                                                        href="{{ route('product.page', ['id' => $product->id]) }}">{{ $category->name }}</a>
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
                                    @endforeach
                                </div>
                            @endif
                            @php($count++)
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================
                                                                    Product Area End
                                                                    =====================-->
</div>
