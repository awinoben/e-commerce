<div>
    <div class="header-area header-three sticker">
        <!-- Header Top Start -->
        <div class="header-top full-border text-white" style="background-color: #131921;">
            <div class="header-container">
                <div class="row">
                    <div class="col-lg-2 col-12">
                        <div class="header-top-left">
                            <div class="logo mt-3">
                                <a href="{{ route('welcome') }}"><img src="{{ asset('img/logo.png') }}" height="70"
                                                                      width="140" alt=""
                                                                      class="img-fluid"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-12">
                        <div class="box-right ml-auto">
                            <ul>
                                <li class="settings">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="settings">
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li class="settings font-weight-bold">
                                    <a href="{{ route('welcome') }}">
                                        <span style="color: #0086f5">P</span>
                                        <span style="color: #ff4131">a</span>
                                        <span style="color: #00a94e">r</span>
                                        <span style="color: #0086f5">t</span>
                                        <span style="color: #ffbe02">s</span>
                                        <span>&nbsp;</span>
                                        <span style="color: #00a94e">F</span>
                                        <span style="color: #ff4131">i</span>
                                        <span style="color: #0086f5">n</span>
                                        <span style="color: #0086f5">d</span>
                                        <span style="color: #ffbe02">e</span>
                                        <span style="color: #ff4131">r</span>
                                    </a>
                                </li>
                                <li class="settings">
                                    <a href="#" class="drop-toggle">
                                        <span>{{ \App\Http\Controllers\SystemController::defaultCurrency() }}</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
{{--                                    <ul class="box-dropdown drop-dropdown text-dark">--}}
{{--                                        <li><a href="#">EUR €</a></li>--}}
{{--                                        <li><a href="#">USD $</a></li>--}}
{{--                                    </ul>--}}
                                </li>
                                <li class="settings">
                                    <a href="#" class="drop-toggle">
                                        <img src="{{ asset('img/banner/usa.jpg') }}" alt="">
                                        EN(USA)
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="box-dropdown drop-dropdown text-dark">
                                        <li>
                                            <a href="#"><img src="{{ asset('img/banner/usa.jpg') }}" alt="">
                                                EN(USA)</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="settings">
                                    <a href="#" class="drop-toggle">
                                        My Account
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="box-dropdown drop-dropdown text-dark">
                                        @if (\Illuminate\Support\Facades\Auth::check())
                                            <li><a href="{{ route('dashboard') }}">My Account</a>
                                            </li>
                                            <li><a href="{{ route('user.orders') }}">Orders</a></li>
                                            <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                            <li><a href="{{ route('wishlist.page') }}">WishList</a></li>
                                            <li><a href="{{ route('compare.page') }}">Compare</a></li>
                                            <li><a href="{{ route('user.logout') }}">Sign Out</a></li>
                                        @else
                                            <li><a href="{{ route('user.orders') }}">Orders</a></li>
                                            <li><a href="{{ route('checkout.page') }}">Checkout</a></li>
                                            <li><a href="{{ route('wishlist.page') }}">WishList</a></li>
                                            <li><a href="{{ route('compare.page') }}">Compare</a></li>
                                            <li><a href="{{ route('login') }}">Sign In</a></li>
                                        @endif
                                    </ul>
                                </li>
                                @livewire('inc.cart-manager')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Top End -->
    </div>
</div>
