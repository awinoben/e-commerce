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
                            <li>Order List</li>
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
                            <h3 class="last-title">Orders</h3>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" aria-label="Small" wire:model="search"
                                       type="search" placeholder="Search..."
                                       aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm"><span
                                                class="fa fa-search"></span></span>
                                </div>
                            </div>
                            @if(count($orders))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order No.</th>
                                            <th>Cost ({{ \App\Http\Controllers\SystemController::defaultCurrency() }})
                                            </th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Date/Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ number_format($order->sub_cost,2) }}</td>
                                                <td>{{ number_format($order->quantity) }}</td>
                                                <td>
                                                    @if($order->is_cancelled || $order->is_received)
                                                        @if ($order->is_cancelled)
                                                            <span class="badge badge-danger">cancelled</span>
                                                        @else
                                                            <span class="badge badge-success">complete</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-info">in-complete</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($order->is_paid)
                                                        <a href="#" class="btn btn-outline-success disabled"
                                                           wire:loading.attr="disabled">Paid</a>
                                                    @else
                                                        @if ($order->is_cancelled)
                                                            <a href="#" class="btn btn-outline-info"
                                                               wire:loading.attr="disabled">N/A</a>
                                                        @else
                                                            <a href="#" class="btn btn-outline-primary"
                                                               wire:loading.attr="disabled"
                                                               wire:click="payOrder('{{ $order->id }}')">Pay</a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!$order->is_paid)
                                                        @if ($order->is_cancelled)
                                                            <a href="#" class="btn btn-outline-info"
                                                               wire:loading.attr="disabled">N/A</a>
                                                        @else
                                                            <a href="#" wire:click="cancelOrder('{{ $order->id }}')"
                                                               class="btn btn-outline-danger"
                                                               wire:loading.attr="disabled">Cancel</a>
                                                        @endif
                                                    @else
                                                        @if($order->is_dispatched)
                                                            @if($order->is_received)
                                                                <a href="#" class="btn btn-outline-success disabled"
                                                                   wire:loading.attr="disabled"><span
                                                                        class=" fa fa-check"></span> Done</a>
                                                            @else  <a href="#" class="btn btn-outline-primary"
                                                                      wire:click="markOrder('{{ $order->id }}')"
                                                                      wire:loading.attr="disabled">Mark As Received</a>
                                                            @endif
                                                        @else
                                                            <a href="#" class="btn btn-outline-warning disabled"
                                                               wire:loading.attr="disabled">Not
                                                                Dispatched</a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y h:i a', strtotime($order->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation example">
                                        {{ $orders->links() }}
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
