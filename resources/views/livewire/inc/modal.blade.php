<div>
    <div class="modal fade" id="{{ \Illuminate\Support\Str::slug($product->id) }}" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
                </button>
                <div class="modal_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="modal_tab">
                                    <div class="tab-content product-details-large">
                                        <div class="tab-pane fade show active" id="{{ $tab1 }}" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img
                                                        src="{{ isset($product->product_image->front_image) ? asset('storage/photos/'.$product->product_image->front_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug,480)  }}"
                                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="{{ $tab2 }}" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img
                                                        src="{{ isset($product->product_image->back_image) ? asset('storage/photos/'.$product->product_image->back_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug,480)  }}"
                                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="{{ $tab3 }}" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img
                                                        src="{{ isset($product->product_image->left_image) ? asset('storage/photos/'.$product->product_image->left_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug,480)  }}"
                                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="{{ $tab4 }}" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img
                                                        src="{{ isset($product->product_image->right_image) ? asset('storage/photos/'.$product->product_image->right_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug,480)  }}"
                                                        alt="" class="img-fluid" style="width: 480px!important;"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal_tab_button">
                                        <ul class="nav product_navactive" role="tablist">
                                            <li>
                                                <a class="nav-link active" data-toggle="tab" href="#{{ $tab1 }}"
                                                   role="tab"
                                                   aria-controls="{{ $tab1 }}" aria-selected="false"><img
                                                        src="{{ isset($product->product_image->front_image) ? asset('storage/photos/'.$product->product_image->front_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug,100)  }}"
                                                        alt="" class="img-fluid" style="width: 100px!important;"></a>
                                            </li>
                                            <li>
                                                <a class="nav-link" data-toggle="tab" href="#{{ $tab2 }}" role="tab"
                                                   aria-controls="{{ $tab2 }}" aria-selected="false"><img
                                                        src="{{ isset($product->product_image->back_image) ? asset('storage/photos/'.$product->product_image->back_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug,100)  }}"
                                                        alt="" class="img-fluid" style="width: 100px!important;"></a>
                                            </li>
                                            <li>
                                                <a class="nav-link button_three" data-toggle="tab" href="#{{ $tab3 }}"
                                                   role="tab" aria-controls="{{ $tab3 }}" aria-selected="false"><img
                                                        src="{{ isset($product->product_image->left_image) ? asset('storage/photos/'.$product->product_image->left_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug,100)  }}"
                                                        alt="" class="img-fluid" style="width: 100px!important;"></a>
                                            </li>
                                            <li>
                                                <a class="nav-link" data-toggle="tab" href="#{{ $tab4 }}" role="tab"
                                                   aria-controls="{{ $tab4 }}" aria-selected="false"><img
                                                        src="{{ isset($product->product_image->right_image) ? asset('storage/photos/'.$product->product_image->right_image) : \App\Http\Controllers\SystemController::generateAvatars($product->slug,100)  }}"
                                                        alt="" class="img-fluid" style="width: 100px!important;"></a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- Product Summery Start -->
                                <div class="product-summery mt-50">
                                    <div class="product-head">
                                        <h1 class="product-title">{{ $product->name }}</h1>
                                    </div>
                                    <div class="rating">
                                        &nbsp;
                                    </div>
                                    <div class="price-box">
                                        <span
                                            class="regular-price">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($product->selling_price,2) }}</span>
                                    </div>
                                    <div class="product-description">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                    <div class="product-tax mb-20">
                                        <ul>
                                            <li><span><strong>Category :</strong>{{ $product->category->name }}</span>
                                            </li>
                                            <li><span><strong>Sub Category :</strong>{{ $product->sub_category->name }}</span>
                                            </li>
                                            <li><span><strong>Product Code :</strong>{{ $product->sku }}</span></li>
                                            <li><span><strong>Availability :</strong>{{ $product->available_quantity }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-buttons grid_list">
                                        <div class="action-link">
                                            <a href="#" title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></a>
                                            <button class="btn-secondary"
                                                    wire:click="$emit('add','{{ $product->id }}','shopping')">Add To
                                                Cart
                                            </button>
                                            <a href="#" title="Add to wishlist"><i
                                                    class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-meta">
                                        <div class="desc-content">
                                            <div class="social_sharing d-flex">
                                                <h5>share this post:</h5>
                                                <ul>
                                                    <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                    <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li><a href="#" title="pinterest"><i
                                                                class="fa fa-pinterest"></i></a></li>
                                                    <li><a href="#" title="google+"><i
                                                                class="fa fa-google-plus"></i></a></li>
                                                    <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Summery End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
