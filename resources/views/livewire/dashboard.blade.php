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
                            <li>DashBoard</li>
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
                            <h3 class="last-title">Dashboard </h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-center">Wallet Balance</h6>
                                            <hr>
                                            <p class="card-text text-center">{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($user->wallet,2) }}</p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-center">Orders</h6>
                                            <hr>
                                            <p class="card-text text-center">{{ number_format(count($user->order)) }}</p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-center">Purchases</h6>
                                            <hr>
                                            <p class="card-text text-center">{{ number_format(count($user->history)) }}</p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow-lg" style="margin-top: 10px!important">
                                        <h6 class="card-title text-right text-success" style="padding:20px!important">
                                            <b><i>Weekly Shopping
                                                    Analytics</i></b></h6>
                                        <div id="chart" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('user_chart')",
            loader: {
                color: '#32CD32',
                size: [30, 30],
                type: 'bar',
                textColor: '#000000',
                text: 'Loading some chart data...',
            },
            hooks: new ChartisanHooks()
                .legend()
                .colors()
                .datasets([{type: 'line', fill: false}, 'bar'])
                .tooltip(),
        });
    </script>
</div>
