<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>M-Pesa List</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div wire:poll.30000ms>
                        <div class="card-body">
                            <div wire:loading>
                                @include('inc.loader-effect')
                            </div>
                            <input class="form-control" wire:model="search" type="search" placeholder="Search...">
                        </div>
                        <div wire:init="loadData">
                            <div class="table-responsive">
                                @if(count($mpesas))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
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
                                                <td>
                                                    <figure class="avatar avatar-sm">
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($mpesa->reference_number,400) }}"
                                                            class="rounded-circle" alt="image">
                                                    </figure>
                                                </td>
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
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
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
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No m-pesa statements were found...</p>
                                @endif

                                @if(count($mpesas))
                                    <ul class="pagination justify-content-end">
                                        {{ $mpesas->links() }}
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
