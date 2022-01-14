<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Order Details</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div wire:poll.60000ms>
                        <div class="card-body">
                            <div wire:loading>
                                @include('inc.loader-effect')
                            </div>
                            <div class="col-md-1 float-left">
                                <a href="{{ route('admin.all.order') }}" class="btn btn-outline-primary"><span
                                        data-feather="arrow-left"></span> Go Back</a>
                            </div>
                            <div class="col-md-11 float-right">
                                <input class="form-control" wire:model="search" type="search" placeholder="Search...">
                            </div>
                        </div>
                        <div wire:init="loadData">
                            <div class="table-responsive">
                                @if(count($histories))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
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
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Cost ({{ \App\Http\Controllers\SystemController::defaultCurrency() }})</th>
                                            <th>Order Number</th>
                                            <th>Status</th>
                                            <th>Date/Time</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No details were found...</p>
                                @endif

                                @if(count($histories))
                                    <ul class="pagination justify-content-end">
                                        {{ $histories->links() }}
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ./ Content -->


    <!-- Footer -->
    @livewire('admin.inc.footer')
    <!-- ./ Footer -->
</div>
