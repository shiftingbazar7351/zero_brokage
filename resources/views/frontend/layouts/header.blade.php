<header class="header header-one">
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="{{ asset('assets/img/logofinal.png') }}" class="img-fluid" alt="Logo">
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo-small">
                    <img src="{{ asset('assets/img/logofinal.png') }}" class="img-fluid" alt="Logo" />
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ route('home') }}" class="menu-logo">
                        <img src="{{ asset('assets/img/logofinal.png') }}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
                </div>
                <ul class="main-nav">
                    <li class="has-submenu megamenu active">
                        <a href="{{ route('home') }}">Home
                            {{-- <i class="fas fa-chevron-down"></i> --}}
                        </a>
                        {{-- <ul class="submenu mega-submenu">
                            <li>
                                <div class="megamenu-wrapper">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="single-demo active">

                                                <div class="demo-info">
                                                    <a href="index.html">Electrical Home</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="single-demo">

                                                <div class="demo-info">
                                                    <a href="index-2.html">Cleaning Home</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="single-demo">

                                                <div class="demo-info">
                                                    <a href="index-3.html">Saloon Home</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="single-demo">

                                                <div class="demo-info">
                                                    <a href="index-4.html">Catering Home</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="single-demo">

                                                <div class="demo-info">
                                                    <a href="index-5.html">Car Wash Home</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="single-demo">

                                                <div class="demo-info">
                                                    <a href="index-6.html">Cleaning Home</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="single-demo">

                                                <div class="demo-info">
                                                    <a href="index-7.html">House Problem Home</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="single-demo">

                                                <div class="demo-info">
                                                    <a href="index-8.html">Pet Grooming Home</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="single-demo">

                                                <div class="demo-info">
                                                    <a href="index-9.html">Mechanic Home</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul> --}}
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void(0);">Services
                            {{-- <i class="fas fa-chevron-down"></i> --}}
                        </a>
                        {{-- <ul class="submenu">
                            <li><a href="service-grid.html">Service Grid</a></li>
                            <li><a href="service-list.html">Service List</a></li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Service Details</a>
                                <ul class="submenu">
                                    <li><a href="service-details.html">Service Details 1</a></li>
                                    <li><a href="service-details2.html">Service Details 2</a></li>
                                </ul>
                            </li>
                            <li><a href="search.html">Search</a></li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Providers</a>
                                <ul class="submenu">
                                    <li><a href="providers.html">Providers List</a></li>
                                    <li><a href="provider-details.html">Providers Details</a></li>
                                </ul>
                            </li>
                            <li><a href="create-service.html">Create Service</a></li>
                        </ul> --}}
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void(0);">Customers
                            {{-- <i class="fas fa-chevron-down"></i> --}}
                        </a>
                        {{-- <ul class="submenu">
                            <li><a href="customer-dashboard.html">Dashboard</a></li>
                            <li><a href="customer-booking.html">Booking</a></li>
                            <li><a href="customer-favourite.html">Favorites</a></li>
                            <li><a href="customer-wallet.html">Wallet</a></li>
                            <li><a href="customer-reviews.html">Reviews</a></li>
                            <li><a href="customer-chat.html">Chat</a></li>
                            <li><a href="customer-profile.html">Settings</a></li>
                        </ul> --}}
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void(0);">Providers
                            {{-- <i class="fas fa-chevron-down"></i> --}}
                        </a>
                        {{-- <ul class="submenu">
                            <li><a href="provider-dashboard.html">Dashboard</a></li>
                            <li><a href="provider-services.html">My Services</a></li>
                            <li><a href="provider-booking.html">Booking</a></li>
                            <li><a href="provider-payout.html">Payout</a></li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Settings</a>
                                <ul class="submenu">
                                    <li><a href="provider-appointment-settings.html">Appointment Settings</a>
                                    </li>
                                    <li><a href="provider-profile-settings.html">Account Settings</a></li>
                                    <li><a href="provider-social-profile.html">Social Profiles</a></li>
                                    <li><a href="provider-security-settings.html">Security</a></li>
                                    <li><a href="provider-plan.html">Plan & Billings</a></li>
                                    <li><a href="provider-notifcations.html">Notifications</a></li>
                                    <li><a href="provider-connected-apps.html">Connected Apps</a></li>
                                </ul>
                            </li>
                            <li><a href="provider-availability.html">Availability</a></li>
                            <li><a href="provider-holiday.html">Holidays & Leave</a></li>
                            <li><a href="provider-coupons.html">Coupons</a></li>
                            <li><a href="provider-offers.html">Offers</a></li>
                            <li><a href="provider-reviews.html">Reviews</a></li>
                            <li><a href="provider-earnings.html">Earnings</a></li>
                            <li><a href="provider-chat.html">Chat</a></li>
                        </ul> --}}
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void(0);">Pages
                            {{-- <i class="fas fa-chevron-down"></i> --}}
                        </a>
                        {{-- <ul class="submenu">
                            <li><a href="about-us.html">About</a></li>
                            <li><a href="contact-us.html">Contact Us</a></li>
                            <li><a href="how-it-works.html">How It Works</a></li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Error Page</a>
                                <ul class="submenu">
                                    <li><a href="error-404.html">404 Error</a></li>
                                    <li><a href="error-500.html">500 Error</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Authentication</a>
                                <ul class="submenu">
                                    <li><a href="choose-signup.html">Signup Choose </a></li>
                                    <li><a href="user-signup.html">Customer Signup</a></li>
                                    <li><a href="provider-signup.html">Provider Signup</a></li>
                                    <li><a href="reset-password.html">Reset Password</a></li>
                                    <li><a href="password-recovery.html">Password Update</a></li>
                                    <li><a href="phone-otp.html">Phone OTP</a></li>
                                    <li><a href="email-otp.html">Email OTP</a></li>
                                    <li><a href="free-trial.html">Free Trial</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Booking</a>
                                <ul class="submenu">
                                    <li><a href="booking.html">Booking 1</a></li>
                                    <li><a href="booking-2.html">Booking 2</a></li>
                                    <li><a href="booking-payment.html">Booking Checkout</a></li>
                                    <li><a href="booking-done.html">Booking Success</a></li>
                                    <li><a href="booking-details.html">Booking Details</a></li>
                                </ul>
                            </li>
                            <li><a href="categories.html">Categories</a></li>
                            <li><a href="pricing.html">Pricing Plan</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="maintenance.html">Maintenance</a></li>
                            <li><a href="coming-soon.html">Coming Soon</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li><a href="terms-condition.html">Terms & Conditions</a></li>
                            <li><a href="session-expired.html">Session Expired</a></li>
                            <li><a href="installer.html">Installer</a></li>
                        </ul> --}}
                    </li>
                    <li class="has-submenu">
                        <a href="blog-grid.html">Blog
                            {{-- <i class="fas fa-chevron-down"></i> --}}
                        </a>
                        {{-- <ul class="submenu">
                            <li><a href="blog-grid.html">Blog Grid</a></li>
                            <li><a href="blog-list.html">Blog List</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul> --}}
                    </li>
                    <li><a href="{{ route('admin_page') }}">Admin</a></li>
                </ul>
            </div>
            @include('frontend.layouts.login-popup')
        </nav>
    </div>
</header>
