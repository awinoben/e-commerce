<div>
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{ route('dashboard') }}">Home</a></h1>
                            </li>
                            <li>Purchase List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-account-area mt-50">
        <div class="container">
            <div class="row">
                @livewire('user.inc.dash-nav')

                <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                @include('inc.alert')
                <!-- Tab panes -->
                    <div class="tab-content dashboard-content mb-20">
                        <div class="tab-pane fade active show">
                            <h3 class="last-title">Purchases</h3>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" aria-label="Small" wire:model="search"
                                       type="search" placeholder="Search..."
                                       aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm"><span
                                                class="fa fa-search"></span></span>
                                </div>
                            </div>
                            @if(count($histories))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>SKU</th>
                                            <th>Qty</th>
                                            <th>Cost ({{ \App\Http\Controllers\SystemController::defaultCurrency() }})</th>
                                            <th>Order Number</th>
                                            <th>Status</th>
                                            <th>Date/Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($histories as $history)
                                            @php($product = $history->product)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    @if(isset($product->product_image->front_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->front_image) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @elseif(isset($product->product_image->back_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->back_image) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @elseif(isset($product->product_image->left_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->left_image) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @elseif(isset($product->product_image->right_image))
                                                        <img
                                                            src="{{ asset('storage/photos/'.$product->product_image->right_image) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @else
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($product->slug,100) }}"
                                                            class="img-thumbnail" alt="image" width="100">
                                                    @endif
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>{{ number_format($history->quantity) }}</td>
                                                <td>{{ number_format($history->sub_cost,2) }}</td>
                                                <td>{{ $history->order->order_number }}</td>
                                                <td>
                                                    @if($history->is_paid)
                                                        <span class="badge badge-success">paid</span>
                                                    @else
                                                        <span class="badge badge-danger">not-paid</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y h:i a', strtotime($history->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation example">
                                        {{ $histories->links() }}
                                    </nav>
                                </div>
                            @else
                                <center>
                                    <hr>
                                    <a href="{{ route('shop') }}" class="btn btn-outline-success btn-sm"><span
                                            class="fa fa-shopping-basket"></span> Shop</a>
                                    <hr>
                                </center>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
