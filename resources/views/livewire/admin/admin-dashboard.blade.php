<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Dashboard</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12">
                <a href="{{ route('admin.sales.list') }}">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title d-flex justify-content-between">
                                Sales
                                <small class="text-muted">Last 30 days</small>
                            </h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-3">{{ number_format(is_numeric($sales) ? $sales : 0) }}</h2>
                                </div>
                                <div
                                    class="icon-block icon-block-xl icon-block-floating bg-secondary opacity-7">
                                    <i class="ti-bar-chart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12">
                <a href="{{ route('admin.new.order') }}">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title d-flex justify-content-between">
                                Orders
                                <small class="text-muted">Last 30 days</small>
                            </h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-3">{{ number_format(is_numeric($orders) ? $orders : 0) }}</h2>
                                </div>
                                <div class="icon-block icon-block-xl icon-block-floating bg-success opacity-7">
                                    <i class="ti-package"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12">
                <a href="{{ route('admin.customer.list') }}">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title d-flex justify-content-between">
                                Customers
                            </h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-3">{{ number_format(is_numeric($customers) ? $customers : 0) }}</h2>
                                </div>
                                <div class="icon-block icon-block-xl icon-block-floating bg-warning opacity-7">
                                    <i class="ti-user"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title mb-3">Weekly Average New Sales/Orders</h6>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex flex-column">
                                    <small class="text-muted">Last 7 Days</small>
                                </div>
                            </div>
                        </div>
                        <div id="chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./ Content -->

    <!-- Footer -->
    @livewire('admin.inc.footer')
    <!-- ./ Footer -->

    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('admin_chart')",
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
