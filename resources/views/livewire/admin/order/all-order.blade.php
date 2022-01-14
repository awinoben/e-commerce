<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>All Order List</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @include('inc.alert')
                <div class="card">
                    <div wire:poll.60000ms>
                        <div class="card-body">
                            <div wire:loading>
                                @include('inc.loader-effect')
                            </div>
                            <input class="form-control" wire:model="search" type="search" placeholder="Search...">
                        </div>
                        <div wire:init="loadData">
                            <div class="table-responsive">
                                @if(count($orders))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Customer</th>
                                            <th>Order Number</th>
                                            <th>Payment Option</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                <td>
                                                    <figure class="avatar avatar-sm">
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($order->order_number,400) }}"
                                                            class="rounded-circle" alt="image">
                                                    </figure>
                                                </td>
                                                <td>{{ $order->user->phone_number }}</td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->payment_option->name }}</td>
                                                <td>{{ number_format($order->quantity) }}</td>
                                                <td>{{ number_format($order->sub_cost,2) }}</td>
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
                                                <td><a href="{{ route('admin.order.detail',['id'=>$order->id]) }}"
                                                       class="btn btn-outline-primary">Order Details</a></td>
                                                <td>
                                                    @if($order->is_paid)
                                                        @if($order->is_dispatched)
                                                            @if($order->is_received)
                                                                <button class="btn btn-success disabled">Done</button>
                                                            @else
                                                                <button class="btn btn-info disabled">Waiting For
                                                                    Confirmation
                                                                </button>
                                                            @endif
                                                        @else
                                                            <button class="btn btn-primary"
                                                                    wire:click="dispatchOrder('{{ $order->id }}')">
                                                                Dispatch
                                                                Order
                                                            </button>
                                                        @endif
                                                    @else
                                                        @if ($order->is_cancelled)
                                                            <button class="btn btn-primary disabled">
                                                                N/A
                                                            </button>
                                                        @else
                                                            <button class="btn btn-primary"
                                                                    wire:click="markOrder('{{ $order->id }}')">
                                                                Mark As Paid
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!$order->is_paid && !$order->is_cancelled)
                                                        <button wire:click="cancelOrder('{{ $order->id }}')"
                                                                class="btn btn-danger">
                                                            Cancel
                                                        </button>
                                                    @else
                                                        <button
                                                            class="btn btn-danger disabled">
                                                            Cancel
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y h:i a', strtotime($order->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Customer</th>
                                            <th>Order Number</th>
                                            <th>Payment Option</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Date/Time</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No orders were found...</p>
                                @endif

                                @if(count($orders))
                                    <ul class="pagination justify-content-end">
                                        {{ $orders->links() }}
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
    @livewire('admin.order.order-records')
    @livewire('admin.inc.footer')
    <!-- ./ Footer -->
</div>
