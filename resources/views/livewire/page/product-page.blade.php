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
                            <li>
                                <h1><a href="{{ route('shop') }}">Shop</a></h1>
                            </li>
                            <li>Product Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->

    <!-- ========================
    Product Details Area Start
    ===========================-->
    <div class="product-area product-details-section">
        <div class="container">
            <div class="row">
                @if ($product->category->is_special || !count($product->product_options))
                    <div class="col-lg-6 col-12 mt-50">
                        <!-- Product Zoom Image start -->
                        <div class="product-slider-container arrow-center text-center">
                            <div class="product-item">
                                <a href="#"><img
                                        src="{{ isset($product->product_image->front_image) ? asset('storage/photos/' . $product->product_image->front_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 480) }}"
                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                            </div>
                            <div class="product-item">
                                <a href="#"><img
                                        src="{{ isset($product->product_image->back_image) ? asset('storage/photos/' . $product->product_image->back_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 480) }}"
                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                            </div>
                            <div class="product-item">
                                <a href="#"><img
                                        src="{{ isset($product->product_image->left_image) ? asset('storage/photos/' . $product->product_image->left_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 480) }}"
                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                            </div>
                            <div class="product-item">
                                <a href="#"><img
                                        src="{{ isset($product->product_image->right_image) ? asset('storage/photos/' . $product->product_image->right_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 480) }}"
                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                            </div>
                        </div>
                        <!-- Product Zoom Image End -->
                        <!-- Product Thumb Zoom Image Start -->
                        <div class="product-details-thumbnail arrow-center text-center">
                            <div class="product-item-thumb">
                                <img src="{{ isset($product->product_image->front_image) ? asset('storage/photos/' . $product->product_image->front_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                    alt="" class="img-fluid" style="width: 100px!important;">
                            </div>
                            <div class="product-item-thumb">
                                <img src="{{ isset($product->product_image->back_image) ? asset('storage/photos/' . $product->product_image->back_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                    alt="" class="img-fluid" style="width: 100px!important;">
                            </div>
                            <div class="product-item-thumb">
                                <img src="{{ isset($product->product_image->left_image) ? asset('storage/photos/' . $product->product_image->left_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                    alt="" class="img-fluid" style="width: 100px!important;">
                            </div>
                            <div class="product-item-thumb">
                                <img src="{{ isset($product->product_image->right_image) ? asset('storage/photos/' . $product->product_image->right_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                    alt="" class="img-fluid" style="width: 100px!important;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 mt-45">
                        <!-- Product Summery Start -->
                        <div class="product-summery position-relative">
                            <div class="product-head">
                                <h1 class="product-title">{{ $product->name }}</h1>
                                <div class="product-arrows text-right">
                                    {{-- <a href="#"><i class="fa fa-long-arrow-left"></i></a> --}}
                                    {{-- <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}
                                </div>
                            </div>
                            <div class="price-box">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <ul>
                                            <li>
                                                <span
                                                    class="font-weight-bold text-danger">Price:</span>&nbsp;&nbsp;&nbsp;
                                                <span
                                                    class="text-danger font-weight-bold">{{ \App\Http\Controllers\SystemController::defaultCurrency() }}
                                                    {{ number_format($product->selling_price, 2) }}</span>
                                            </li>
                                            <li><span
                                                    class="font-weight-bold">Brand:</span>&nbsp;&nbsp;&nbsp;<span>{{ $product->brand->name }}</span>
                                            </li>
                                            <li><span
                                                    class="font-weight-bold">Category:</span>&nbsp;&nbsp;&nbsp;<span><a
                                                        href="{{ route('category.shop', ['slug' => $product->category->slug]) }}"><span>{{ $product->category->name }}</span></a></span>
                                            </li>
                                            <li><span class="font-weight-bold">Size:</span>&nbsp;&nbsp;&nbsp;<span>
                                                    @foreach ($product->size as $size)
                                                        <a href="#" class="text-small">{{ $size->value }}</a>
                                                    @endforeach
                                                </span>
                                            </li>
                                            <li><span class="font-weight-bold">Color:</span>&nbsp;&nbsp;&nbsp;<span>
                                                    @foreach ($product->color as $color)
                                                        <a href="#" data-bg-color="#000000"
                                                            style="background-color: {{ $color->value }};"></a>
                                                    @endforeach
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-8">
                                        <ul>
                                            <li><span>
                                                    Quantity<div class="product-quantity">
                                                        <span class="qty-btn minus"><i
                                                                class="fa fa-angle-down"></i></span>
                                                        <input type="text" class="input-qty" value="1">
                                                        <span class="qty-btn plus"><i class="fa fa-angle-up"></i></span>
                                                    </div></span>
                                            </li>
                                            <li>
                                                <div class="product-buttons grid_list mt-3">
                                                    <div class="action-link">
                                                        <a class="compare-add same-link"
                                                            wire:click="$emit('add','{{ $product->id }}','compare')"
                                                            title="Add to compare"><i
                                                                class="zmdi zmdi-refresh-alt text-white"></i></a>
                                                        <button class="btn-secondary btn-sm"
                                                            wire:click="$emit('add','{{ $product->id }}','shopping')">
                                                            Add to Cart
                                                        </button>
                                                        <button class="btn-secondary btn-sm"
                                                            wire:click="$emit('add','{{ $product->id }}','shopping')">
                                                            Buy Now
                                                        </button>
                                                        <a class="wishlist-add same-link"
                                                            wire:click="$emit('add','{{ $product->id }}','wishlist')"
                                                            title="Add to wishlist"><i
                                                                class="zmdi zmdi-favorite-outline zmdi-hc-fw text-white"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                    </div>
                                </div>
                            </div>
                            <div class="product-description">
                                <p>{!! $product->details !!}</p>
                            </div>
                            <div class="rating-meta d-flex">
                                <div class="rating">
                                </div>
                                <ul class="meta d-flex">
                                    <li>
                                        <a href="#"><i class="fa fa-commenting-o"></i>Read reviews
                                            ({{ count($product->review) }})</a>
                                    </li>
                                    <li>
                                        <a href="#reviews"><i class="fa fa-edit"></i>Write a review</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-meta">
                                <div class="desc-content">
                                    <div class="social_sharing d-flex">
                                        <h5>share this post:</h5>
                                        <ul>
                                            <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#" title="google+"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Summery End -->
                    </div>
                @else
                    <div class="col-lg-3 col-12 mt-50">
                        <!-- Product Zoom Image start -->
                        <div class="product-slider-container arrow-center text-center">
                            <div class="product-item">
                                <a href="#"><img
                                        src="{{ isset($product->product_image->front_image) ? asset('storage/photos/' . $product->product_image->front_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 480) }}"
                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                            </div>
                            <div class="product-item">
                                <a href="#"><img
                                        src="{{ isset($product->product_image->back_image) ? asset('storage/photos/' . $product->product_image->back_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 480) }}"
                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                            </div>
                            <div class="product-item">
                                <a href="#"><img
                                        src="{{ isset($product->product_image->left_image) ? asset('storage/photos/' . $product->product_image->left_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 480) }}"
                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                            </div>
                            <div class="product-item">
                                <a href="#"><img
                                        src="{{ isset($product->product_image->right_image) ? asset('storage/photos/' . $product->product_image->right_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 480) }}"
                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                            </div>
                        </div>
                        <!-- Product Zoom Image End -->
                        <!-- Product Thumb Zoom Image Start -->
                        <div class="product-details-thumbnail arrow-center text-center">
                            <div class="product-item-thumb">
                                <img src="{{ isset($product->product_image->front_image) ? asset('storage/photos/' . $product->product_image->front_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                    alt="" class="img-fluid" style="width: 100px!important;">
                            </div>
                            <div class="product-item-thumb">
                                <img src="{{ isset($product->product_image->back_image) ? asset('storage/photos/' . $product->product_image->back_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                    alt="" class="img-fluid" style="width: 100px!important;">
                            </div>
                            <div class="product-item-thumb">
                                <img src="{{ isset($product->product_image->left_image) ? asset('storage/photos/' . $product->product_image->left_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                    alt="" class="img-fluid" style="width: 100px!important;">
                            </div>
                            <div class="product-item-thumb">
                                <img src="{{ isset($product->product_image->right_image) ? asset('storage/photos/' . $product->product_image->right_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug, 100) }}"
                                    alt="" class="img-fluid" style="width: 100px!important;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12 mt-45">
                        <!-- Product Summery Start -->
                        <div class="product-summery position-relative">
                            <div class="product-head">
                                <h1 class="product-title">{{ $product->name }}</h1>
                                <div class="product-arrows text-right">
                                    {{-- <a href="#"><i class="fa fa-long-arrow-left"></i></a> --}}
                                    {{-- <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}
                                </div>
                            </div>
                            <div class="rating-meta d-flex">
                                <div class="rating">
                                </div>
                                <ul class="meta d-flex">
                                    <li>
                                        <a href="#"><i class="fa fa-commenting-o"></i>Read reviews
                                            ({{ count($product->review) }})</a>
                                    </li>
                                    <li>
                                        <a href="#reviews"><i class="fa fa-edit"></i>Write a review</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="price-box">
                                <span
                                    class="regular-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }}
                                    {{ number_format($product->selling_price, 2) }}</span>
                            </div>
                            <div class="product-description">
                                <p>{!! $product->details !!}</p>
                            </div>
                            <div class="product-packeges">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="label"><span>Brand</span></td>
                                            <td class="value"><a
                                                    href="#"><span>{{ $product->brand->name }}</span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label"><span>Category</span></td>
                                            <td class="value"><a
                                                    href="{{ route('category.shop', ['slug' => $product->category->slug]) }}"><span>{{ $product->category->name }}</span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label"><span>Size</span></td>
                                            <td class="value">
                                                <div class="product-sizes">
                                                    @foreach ($product->size as $size)
                                                        <a href="#" class="text-small">{{ $size->value }}</a>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label"><span>Color</span></td>
                                            <td class="value">
                                                <div class="product-colors">
                                                    @foreach ($product->color as $color)
                                                        <a href="#" data-bg-color="#000000"
                                                            style="background-color: {{ $color->value }};"></a>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label"><span>Quantity</span></td>
                                            <td class="value">
                                                <div class="product-quantity">
                                                    <span class="qty-btn minus"><i class="fa fa-angle-down"></i></span>
                                                    <input type="text" class="input-qty" value="1">
                                                    <span class="qty-btn plus"><i class="fa fa-angle-up"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="product-buttons grid_list">
                                <div class="action-link">
                                    <a class="compare-add same-link"
                                        wire:click="$emit('add','{{ $product->id }}','compare')"
                                        title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></a>
                                    <button class="btn-secondary"
                                        wire:click="$emit('add','{{ $product->id }}','shopping')">
                                        Add To Cart
                                    </button>
                                    <a class="wishlist-add same-link"
                                        wire:click="$emit('add','{{ $product->id }}','wishlist')"
                                        title="Add to wishlist"><i
                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                </div>
                            </div>
                            <div class="product-meta">
                                <div class="desc-content">
                                    <div class="social_sharing d-flex">
                                        <h5>share this post:</h5>
                                        <ul>
                                            <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#" title="google+"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Summery End -->
                    </div>
                    <div class="col-lg-4 col-12 mt-45" style="border-left: 1px solid black;">
                        <!-- Product Summery Start -->
                        <div class="product-summery position-relative">
                            <div class="product-head">
                                <h1 class="product-title text-center"><i>{{ $product->name }} Parts & Accessories</i>
                                </h1>
                            </div>
                            <div class="table-desc">
                                <div class="cart-page table-responsive table-sm">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th class="product-image">Image</th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-name">Shop</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->product_options as $product_option)
                                                <tr>
                                                    <td><input type="checkbox"
                                                            wire:change="$emit('add','{{ $product->id }}','shopping')">
                                                    </td>
                                                    <td class="product-image">
                                                        @php($product_attached = $product_option->option->product)
                                                            <a
                                                                href="{{ route('product.page', ['id' => $product->id]) }}">
                                                                @if (isset($product_attached->product_image->front_image))
                                                                    <img src="{{ asset('storage/photos/' . $product_attached->product_image->front_image) }}"
                                                                        alt="image" width="40">
                                                                @elseif(isset($product_attached->product_image->back_image))
                                                                    <img src="{{ asset('storage/photos/' . $product_attached->product_image->back_image) }}"
                                                                        alt="image" width="40">
                                                                @elseif(isset($product_attached->product_image->left_image))
                                                                    <img src="{{ asset('storage/photos/' . $product_attached->product_image->left_image) }}"
                                                                        alt="image" width="40">
                                                                @elseif(isset($product_attached->product_image->right_image))
                                                                    <img src="{{ asset('storage/photos/' . $product_attached->product_image->right_image) }}"
                                                                        alt="image" width="40">
                                                                @else
                                                                    <img src="{{ \App\Http\Controllers\SystemController::generateAvatars($product_attached->slug, 100) }}"
                                                                        alt="image" width="40">
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td class="product-name">
                                                            <a
                                                                href="{{ route('product.page', ['id' => $product_attached->id]) }}">{{ $product_attached->name }}</a>
                                                        </td>
                                                        <td class="product-price">
                                                            {{ \App\Http\Controllers\SystemController::defaultCurrency() }}
                                                            {{ number_format($product_attached->selling_price, 2) }}</td>
                                                        <td>
                                                            <button class="btn btn-green" title="Add to cart"
                                                                wire:click="$emit('add','{{ $product->id }}','shopping')">
                                                                <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Summery End -->
                        </div>
                    @endif
                </div>
                <div class="row mt-40">
                    <div class="col-lg-3 col-sm-3 col-md-2">
                        <!-- Product Description Tab Start -->
                        <div class="product-desc-tab">
                            <ul class="nav flex-column" role="tablist">
                                <li><a class="active" href="#description" role="tab" data-toggle="tab"
                                        aria-selected="false">Description</a></li>
                                <li><a href="#sheet" role="tab" data-toggle="tab" aria-selected="false">Data sheet</a></li>
                                <li><a href="#reviews" role="tab" data-toggle="tab" aria-selected="true">Reviews</a></li>
                            </ul>
                        </div>
                        <!-- Product Description Tab End -->
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-10">
                        <div class="product-desc-tab-content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="product_tab_content fade active show">
                                <div class="product_description_wrap mt-20">
                                    <div class="product_desc">
                                        <h2 class="last-title mb-20">{{ $product->name }} Features</h2>
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="sheet" class="product_tab_content fade">
                                <div class="pro__feature mt-20">
                                    @if (count($product->product_data_sheet))
                                        <h2 class="last-title mb-20">Read More On {{ $product->name }}</h2>
                                        @foreach ($product->product_data_sheet as $sheet)
                                            <h5 class="text-primary" style="padding:20px"><a
                                                    href="{{ asset('storage/sheets/' . $sheet->data_sheet) }}"><span
                                                        class="fa fa-file-pdf-o"></span> {{ $sheet->data_sheet }}</a>
                                            </h5>
                                        @endforeach
                                    @else
                                        <p>No data sheets available yet.</p>
                                    @endif
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="reviews" class="product_tab_content fade">
                                @if (count($product->review))
                                    <div class="review_address_inner mt-20">
                                        @php($count = 1)
                                            @foreach ($product->review()->take(5)->get()
            as $review)
                                                @if ($count % 2 == 0)
                                                    <div class="pro_review">
                                                        <div class="review_thumb">
                                                            <img src="{{ \App\Http\Controllers\SystemController::generateAvatars($review->user->slug, 50) }}"
                                                                alt="review images">
                                                        </div>
                                                        <div class="review_details">
                                                            <div class="review_info">
                                                                <a class="last-title" href="#">{{ $review->user->name }}</a>
                                                                <div class="rating">
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="review_date">
                                                                <span>{{ date('F d, Y h:i a', strtotime($review->created_at)) }}</span>
                                                            </div>
                                                            <p>{{ $review->description }}</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="pro_review pro-second">
                                                        <div class="review_thumb">
                                                            <img src="{{ \App\Http\Controllers\SystemController::generateAvatars($review->user->slug, 50) }}"
                                                                alt="review images">
                                                        </div>
                                                        <div class="review_details">
                                                            <div class="review_info">
                                                                <a class="last-title" href="#">{{ $review->user->name }}</a>
                                                                <div class="rating">
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="review_date">
                                                                <span>{{ date('F d, Y h:i a', strtotime($review->created_at)) }}</span>
                                                            </div>
                                                            <p>{{ $review->description }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                @php($count++)
                                                @endforeach
                                            </div>
                                            <div class="comments_form">
                                                <h3>Leave a Reply </h3>
                                                <p>Your email address will not be published. Required fields are marked *</p>
                                                <form wire:submit.prevent="review">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="review_description">Give your comment</label>
                                                            <textarea name="review_description" id="review_description"
                                                                spellcheck="false" wire:model.debounce.2000ms="review_description"
                                                                data-gramm="false"></textarea>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-lg btn-green float-right" type="submit">Post
                                                        Review
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="comments_form">
                                                <h3>Leave a Reply </h3>
                                                <p>Your email address will not be published. Required fields are marked *</p>
                                                <form wire:submit.prevent="review">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="review_description">Give your comment</label>
                                                            <textarea name="review_description" id="review_description"
                                                                spellcheck="false" wire:model.debounce.2000ms="review_description"
                                                                data-gramm="false"></textarea>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-lg btn-green float-right" type="submit">Post
                                                        Review
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- End Single Content -->
                                </div>
                            </div>
                        </div>
                        @if (count(
                    $product->category->product()->whereNotIn('id', [$product->id])->get(),
                ))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-details-home2 mt-45 mb-15">
                                        <div class="block-title">
                                            <h6>Related Products</h6>
                                        </div>
                                        <div class="product-carousel-home2 slick-custom slick-custom-default nav-top">
                                            @foreach ($product->category->product as $item)
                                                @if ($product->id != $item->id)
                                                    <div class="product-row">
                                                        <!-- Single-Product-Start -->
                                                        <div class="item-product">
                                                            <div class="product-thumb">
                                                                <a href="{{ route('product.page', ['id' => $item->id]) }}">
                                                                    @if (isset($item->product_image->front_image))
                                                                        <img src="{{ asset('storage/photos/' . $item->product_image->front_image) }}"
                                                                            class="img-fluid" alt="image" width="400">
                                                                    @elseif(isset($item->product_image->back_image))
                                                                        <img src="{{ asset('storage/photos/' . $item->product_image->back_image) }}"
                                                                            class="img-fluid" alt="image" width="400">
                                                                    @elseif(isset($item->product_image->left_image))
                                                                        <img src="{{ asset('storage/photos/' . $item->product_image->left_image) }}"
                                                                            class="img-fluid" alt="image" width="400">
                                                                    @elseif(isset($item->product_image->right_image))
                                                                        <img src="{{ asset('storage/photos/' . $item->product_image->right_image) }}"
                                                                            class="img-fluid" alt="image" width="400">
                                                                    @else
                                                                        <img src="{{ \App\Http\Controllers\SystemController::generateAvatars($item->slug, 400) }}"
                                                                            class="img-fluid" alt="image" width="400">
                                                                    @endif
                                                                </a>
                                                                <div class="box-label">
                                                                    <div class="label-product-new">
                                                                        <span>New</span>
                                                                    </div>
                                                                </div>
                                                                <div class="action-link">
                                                                    <a class="quick-view same-link" href="#" title="Quick view"
                                                                        data-toggle="modal"
                                                                        data-target="#{{ \Illuminate\Support\Str::slug($item->id) }}"
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
                                                                    <a
                                                                        href="{{ route('product.page', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                                                </div>
                                                                <div class="rating">
                                                                    <p class="text-uppercase">{{ $product->brand->name }}</p>
                                                                </div>
                                                                <div class="price-box">
                                                                    <span
                                                                        class="regular-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }}
                                                                        {{ number_format($item->selling_price, 2) }}</span>
                                                                </div>
                                                                <div class="cart">
                                                                    <div class="add-to-cart">
                                                                        <button class="btn btn-green" title="Add to cart"
                                                                            wire:click="$emit('add','{{ $item->id }}','shopping')">
                                                                            <span wire:loading.class="fa fa-spinner fa-spin"></span>
                                                                            <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Single-Product-End -->
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- ========================
                            Product Details Area End
                            ===========================-->
            </div>
