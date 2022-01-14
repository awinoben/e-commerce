<div>
    <!-- Navigation -->
    <div class="navigation">
        <!-- Logo -->
        <div class="navigation-header">
            <a class="navigation-logo" href={{ route('admin.dashboard') }}>
                <img class="small-logo" src="{{ asset('img/logo.png') }}" alt="logo" width="50" height="50">
                <img class="dark-logo" src="{{ asset('img/logo.png') }}"
                     alt="dark logo" width="50">
                <img class="small-logo" src="{{ asset('img/logo.png') }}"
                     alt="small logo" width="50">
                <img class="small-dark-logo"
                     src="{{ asset('img/logo.png') }}"
                     alt="small dark logo" width="50">
            </a>
            <a href="#" class="small-navigation-toggler"></a>
            <a href="#" class="btn btn-danger mobile-navigation-toggler">
                <i class="ti-close"></i>
            </a>
        </div>
        <!-- ./ Logo -->

        <!-- Menu wrapper -->
        <div class="navigation-menu-wrapper">
            <!-- Menu tab -->
            <div class="navigation-menu-tab">
                <ul id="#myTab">
                    <li>
                        <a href="#" data-menu-target="#dashboards">
                                <span class="menu-tab-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                            <span>Dashboards</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.category') }}" data-menu-target="#setups">
                                <span class="menu-tab-icon">
                                    <i data-feather="tool"></i>
                                </span>
                            <span>Setups</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-menu-target="#manage">
                                <span class="menu-tab-icon">
                                    <i data-feather="layers"></i>
                                </span>
                            <span>Manage</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-menu-target="#orders">
                                <span class="menu-tab-icon">
                                    <i data-feather="shopping-cart"></i>
                                </span>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-menu-target="#payments">
                                <span class="menu-tab-icon">
                                    <i data-feather="credit-card"></i>
                                </span>
                            <span>Payments</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-menu-target="#settings">
                                <span class="menu-tab-icon">
                                    <i data-feather="log-out"></i>
                                </span>
                            <span>LogOut</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ./ Menu tab -->

            <!-- Menu body -->
            <div class="navigation-menu-body">
                <ul id="dashboards">
                    <li class="navigation-divider">Dashboards</li>
                    <li>
                        <a class="active"
                           href="{{ route('admin.dashboard') }}">
                            <span class="nav-link-icon" data-feather="shopping-cart"></span>
                            <span>{{ config('app.name') }}</span>
                        </a>
                    </li>
                    {{--                    <li>--}}
                    {{--                        <a href="#">--}}
                    {{--                            <span class="nav-link-icon" data-feather="bar-chart-2"></span>--}}
                    {{--                            <span>Analytics</span>--}}
                    {{--                            <span class="badge badge-success">New</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li class="navigation-divider">Quick Access</li>
                    <li>
                        <a href="{{ route('admin.all.order') }}">
                            <span class="nav-link-icon" data-feather="box"></span>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sales.list') }}">
                            <span class="nav-link-icon" data-feather="crosshair"></span>
                            <span>Sales</span>
                        </a>
                    </li>
                </ul>
                <ul id="setups">
                    <li class="navigation-divider">Setups</li>
                    <li>
                        <a href="{{ route('admin.add.category') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.sub.category') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Sub-Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.sub.sub.category') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Sub-SubCategory</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.color') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Color</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.filter') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Filter</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.size') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Size</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.location') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Location</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.slide') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Slide</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.brand') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Brand</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.add.product') }}">
                            <span class="nav-link-icon" data-feather="plus-square"></span>
                            <span>Add Product</span>
                        </a>
                    </li>
                </ul>
                <ul id="manage">
                    <li class="navigation-divider">Manage</li>
                    <li>
                        <a href="{{ route('admin.customer.list') }}">
                            <span class="nav-link-icon" data-feather="users"></span>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.subscribe.list') }}">
                            <span class="nav-link-icon" data-feather="users"></span>
                            <span>Subscribers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.category') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.sub.category') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Sub Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.sub.sub.category') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Sub-SubCategories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.color') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Colors</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.filter') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Filters</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.size') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Sizes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.location') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Locations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.slide') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Slides</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.brand') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Brands</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list.product') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>Products</span>
                        </a>
                    </li>
                </ul>
                <ul id="orders">
                    <li class="navigation-divider">Orders</li>
                    <li>
                        <a href="{{ route('admin.new.order') }}">
                            <span class="nav-link-icon" data-feather="corner-down-right"></span>
                            <span>New</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pending.order') }}">
                            <span class="nav-link-icon" data-feather="corner-right-up"></span>
                            <span>Pending</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.delivered.order') }}">
                            <span class="nav-link-icon" data-feather="corner-left-up"></span>
                            <span>Delivered</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cancelled.order') }}">
                            <span class="nav-link-icon" data-feather="corner-down-left"></span>
                            <span>Cancelled</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.all.order') }}">
                            <span class="nav-link-icon" data-feather="layers"></span>
                            <span>All</span>
                        </a>
                    </li>
                </ul>
                <ul id="payments">
                    <li class="navigation-divider">Payments</li>
                    <li>
                        <a href="{{ route('admin.mpesa.list') }}">
                            <span class="nav-link-icon" data-feather="shield"></span>
                            <span>M-Pesa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.statement.list') }}">
                            <span class="nav-link-icon" data-feather="file-text"></span>
                            <span>Statements</span>
                        </a>
                    </li>
                </ul>
                <ul id="settings">
                    <li class="navigation-divider">System Settings</li>
                    <li>
                        <a href="{{ route('admin.logout') }}">
                            <span class="nav-link-icon" data-feather="log-out"></span>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ./ Menu body -->
        </div>
        <!-- ./ Menu wrapper -->
    </div>
    <!-- ./ Navigation -->
</div>
