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
                            <li>Statement List</li>
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
                            <h3 class="last-title">Statements</h3>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" aria-label="Small" wire:model="search"
                                       type="search" placeholder="Search..."
                                       aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm"><span
                                                class="fa fa-search"></span></span>
                                </div>
                            </div>
                            @if(count($statements))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reference Number</th>
                                            <th>Transaction Number</th>
                                            <th>Transaction Type</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date/Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($statements as $statement)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $statement->reference_number }}</td>
                                                <td>{{ $statement->transaction_number }}</td>
                                                <td>{{ $statement->transaction_type }}</td>
                                                <td>{{ number_format($statement->amount,2) }}</td>
                                                <td>{{ $statement->description }}</td>
                                                <td>
                                                    @if($statement->is_debit)
                                                        <span class="badge badge-success">credit</span>
                                                    @else
                                                        <span class="badge badge-danger">debit</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y h:i a', strtotime($statement->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation example">
                                        {{ $statements->links() }}
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
