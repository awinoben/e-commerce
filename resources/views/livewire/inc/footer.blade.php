<div>
    <footer class="mt-30">
        <!-- Newslatter area start -->
        <div class="newsletter-group">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12">
                        <div class="newsletter-inner d-flex align-items-center">
                            <i class="fa fa-envelope-open-o"></i>
                            <div class="newsletter-title">
                                <h1 class="sign-title">Sign Up For Our Newsletter</h1>
                                <p>Get e-mail updates about our latest shop and special offers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="newsletter-box">
                            <form wire:submit.prevent="submit" class="mc-form">
                                <input type="email" id="mc-email" class="email-box" placeholder="enter your email"
                                       wire:model="email"
                                       name="email">
                                <button id="mc-submit" class="newsletter-btn" type="submit">Subscribe</button>
                            </form>
                            <div class="text-center">
                                @error('email') <span
                                    class="text-danger error">{{ $message }}</span> @enderror</div>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success text-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error text-danger"></div><!-- mailchimp-error end -->
                            </div><!-- mailchimp-alerts end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newslatter area End -->
        <!-- Footer Top Start -->
        <div class="footer-top mt-50 mb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-single-widget">
                            <div class="footer-logo mb-40">
                                <a href="{{ route('welcome') }}"><img src="{{ asset('img/logo.png') }}" height="100"
                                                                      width="200" alt=""></a>
                            </div>
                            <div class="widget-body">
                                <p>Your number one store for IT products.</p>
                                <div class="widget-address mt-30 mb-20">
                                    <p><strong>Address:</strong> Sarit Center.</p>
                                    <p><strong>Phone Number:</strong> (+254) 700 000 000 </p>
                                    <p><strong>Address Email:</strong> support@fusioncube.africa</p>
                                </div>
                            </div>
                            <div class="footer_social">
                                <ul class="d-flex">
                                    <li><a class="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a class="youtube" href="#"><i class="zmdi zmdi-youtube"></i></a></li>
                                    <li><a class="google" href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                    <li><a class="linkedin" href="#"><i class="zmdi zmdi-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-6">
                                <div class="widgets_container">
                                    <h6>Information</h6>
                                    <div class="footer_menu">
                                        <ul>
                                            <li><a href="{{ route('about.us') }}">About Us</a></li>
                                            <li><a href="{{ route('contact.us') }}"> Contact us</a></li>
                                            <li><a href="#"> Privecy Policy</a></li>
                                            <li><a href="#">Terms & Conditions</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                                <div class="widgets_container">
                                    <h6>My Account</h6>
                                    <div class="footer_menu">
                                        <ul>
                                            <li><a href="{{ route('dashboard') }}">My Account</a></li>
                                            <li><a href="{{ route('user.histories') }}">Order History</a></li>
                                            <li><a href="{{ route('user.wishlists') }}">Wishlist</a></li>
                                            <li><a href="#">Newsletter</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                                <div class="widgets_container">
                                    <h6>Find It Fast</h6>
                                    <div class="footer_menu">
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li>
                                                    <a href="{{ route('category.shop',['slug'=>$category->slug]) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                                <div class="widgets_container">
                                    <h6>Customer Service</h6>
                                    <div class="footer_menu">
                                        <ul>
                                            <li><a href="#">Sitemap</a></li>
                                            <li><a href="#">My Account</a></li>
                                            <li><a href="#">Contact Us</a></li>
                                            <li><a href="#">Delivery Information</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-lg-12">
                                <div class="widget-box mt-30">
                                    <div class="widget-single-box">
                                        <p><strong>Address:</strong></p>
                                        <ul>
                                            <li><a href="#">Order</a></li>
                                            <li><a href="#">Affiliate</a></li>
                                            <li><a href="#">Marketing</a></li>
                                            <li><a href="#">Sourcing</a></li>
                                            <li><a href="#">Gadgets</a></li>
                                            <li><a href="#">Accessories</a></li>
                                        </ul>
                                    </div>
                                    <div class="widget-single-box">
                                        <p><strong>Headphones:</strong></p>
                                        <ul>
                                            <li><a href="#">Beats</a></li>
                                            <li><a href="#">Headphone Bose</a></li>
                                            <li><a href="#">Headphone Nocx</a></li>
                                            <li><a href="#">Wireless</a></li>
                                            <li><a href="#">Headphone</a></li>
                                            <li><a href="#">Headphone Mini</a></li>
                                        </ul>
                                    </div>
                                    <div class="widget-single-box">
                                        <p><strong>Computers:</strong></p>
                                        <ul>
                                            <li><a href="#">Mini Laptops</a></li>
                                            <li><a href="#">Computers</a></li>
                                            <li><a href="#">Laptop Mouse</a></li>
                                            <li><a href="#">Laptop Pad</a></li>
                                            <li><a href="#">GB Laptop</a></li>
                                            <li><a href="#">XL Laptop</a></li>
                                        </ul>
                                    </div>
                                    <div class="widget-single-box">
                                        <p><strong>Camera:</strong></p>
                                        <ul>
                                            <li><a href="#">Lense Camera</a></li>
                                            <li><a href="#">Frame Camera</a></li>
                                            <li><a href="#">Box Camera</a></li>
                                            <li><a href="#">Mini Camera</a></li>
                                            <li><a href="#">XL Camera</a></li>
                                            <li><a href="#">Point shoot camera</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Top End -->
        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-12 col-12">
                        <div class="footer-bottom-content">
                            <div class="footer-copyright">
                                <p>Copyright &copy; {{ date('Y') }} <a href="#">{{ config('app.name') }}</a>. All Rights
                                    Reserved</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 col-12">
                        <div class="payment">
                            <a href="#">
                                <img src="{{ asset('assets/images/payment/footerend.png') }}" alt=""
                                     class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->
    </footer>


    <a class="scroll-to-top" href="#"><i class="fa fa-angle-up"></i></a>
</div>
