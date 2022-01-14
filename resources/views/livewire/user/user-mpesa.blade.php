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
                            <li>Transaction List</li>
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
                            <h3 class="last-title">Transactions</h3>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" aria-label="Small" wire:model="search"
                                       type="search" placeholder="Search..."
                                       aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm"><span
                                                class="fa fa-search"></span></span>
                                </div>
                            </div>
                            @if(count($mpesas))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reference Number</th>
                                            <th>Order Number</th>
                                            <th>Transaction Number</th>
                                            <th>Phone Number</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Initiated</th>
                                            <th>Date/Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($mpesas as $mpesa)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $mpesa->reference_number }}</td>
                                                <td>{{ $mpesa->order->order_number }}</td>
                                                <td>{{ $mpesa->transaction_number }}</td>
                                                <td>{{ $mpesa->phone_number }}</td>
                                                <td>{{ number_format($mpesa->amount,2) }}</td>
                                                <td>{{ $mpesa->description }}</td>
                                                <td>
                                                    @if($mpesa->is_paid)
                                                        <span class="badge badge-success">paid</span>
                                                    @else
                                                        @if(!is_null($mpesa->callback_received_at))
                                                            <span class="badge badge-danger">not-paid</span>
                                                        @else
                                                            <span class="badge badge-primary">pending</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($mpesa->is_initiated)
                                                        <span class="badge badge-success">success</span>
                                                    @else
                                                        <span class="badge badge-danger">failed</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y h:i a', strtotime($mpesa->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation example">
                                        {{ $mpesas->links() }}
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
