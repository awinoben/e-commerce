<div class="col-12 col-sm-12 col-md-12 col-lg-2">
    <ul class="nav flex-column dashboard-list mb-20">
        <li><a class="nav-link {{ request()->routeIs('dashboard') ? 'text-success' : '' }}"
               href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a class="nav-link {{ request()->routeIs('user.details') ? 'text-success' : '' }}"
               href="{{ route('user.details') }}">Account details</a></li>
        <li><a class="nav-link {{ request()->routeIs('user.orders') ? 'text-success' : '' }}"
               href="{{ route('user.orders') }}">Orders</a></li>
        <li><a class="nav-link {{ request()->routeIs('user.wishlists') ? 'text-success' : '' }}"
               href="{{ route('user.wishlists') }}">WishList</a></li>
        <li><a class="nav-link {{ request()->routeIs('user.histories') ? 'text-success' : '' }}"
               href="{{ route('user.histories') }}">Purchases</a></li>
        <li><a class="nav-link {{ request()->routeIs('user.mpesas') ? 'text-success' : '' }}"
               href="{{ route('user.mpesas') }}">Transactions</a></li>
        <li><a class="nav-link {{ request()->routeIs('user.statements') ? 'text-success' : '' }}"
               href="{{ route('user.statements') }}">Statements</a></li>
        <li><a class="nav-link" href="{{ route('user.logout') }}">logout</a></li>
    </ul>
</div>
