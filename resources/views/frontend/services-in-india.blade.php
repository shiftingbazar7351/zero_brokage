<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/terms-condition.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:29 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Truelysell | Template</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/feather.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
.work-box {
    border: 2px solid red;
    box-shadow: 0 0 15px rgba(31, 29, 29, 0.8);
    transition: box-shadow 0.3s ease;
}

.work-box:hover {
    cursor: pointer;
    box-shadow: 0 0 15px rgba(255, 0, 0, 0.8);
}

.city-card {
    border: 2px solid red;
    box-shadow: 0 0 15px rgba(31, 29, 29, 0.8);
    transition: box-shadow 0.3s ease;
}

.city-card:hover {
    cursor: pointer;
    box-shadow: 0 0 15px rgba(255, 0, 0, 0.8);
}
</style>


<body>

    <div class="main-wrapper">

        <header class="header">
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
                        <a href="index.html" class="navbar-brand logo">
                            <img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
                        </a>
                        <a href="index.html" class="navbar-brand logo-small">
                            <img src="assets/img/logo-small.png" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="index.html" class="menu-logo">
                                <img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i
                                    class="fas fa-times"></i></a>
                        </div>
                        <ul class="main-nav">
                            <li class="has-submenu megamenu">
                                <a href="javascript:void(0);">Home <i class="fas fa-chevron-down"></i></a>
                                <ul class="submenu mega-submenu">
                                    <li>
                                        <div class="megamenu-wrapper">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="single-demo ">
                                                        {{-- <div class="demo-img">
                                                            <a href="index.html"><img src="assets/img/home-01.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index.html">Electrical Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="single-demo ">
                                                        {{-- <div class="demo-img">
                                                            <a href="index-2.html"><img src="assets/img/home-02.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index-2.html">Cleaning Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="single-demo ">
                                                        {{-- <div class="demo-img">
                                                            <a href="index-3.html"><img src="assets/img/home-03.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index-3.html">Saloon Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="single-demo">
                                                        {{-- <div class="demo-img">
                                                            <a href="index-4.html"><img src="assets/img/home-04.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index-4.html">Catering Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="single-demo">
                                                        {{-- <div class="demo-img">
                                                            <a href="index-5.html"><img src="assets/img/home-05.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index-5.html">Car Wash Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="single-demo">
                                                        {{-- <div class="demo-img">
                                                            <a href="index-6.html"><img src="assets/img/home-06.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index-6.html">Cleaning Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="single-demo">
                                                        {{-- <div class="demo-img">
                                                            <a href="index-7.html"><img src="assets/img/home-07.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index-7.html">House Problem Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="single-demo">
                                                        {{-- <div class="demo-img">
                                                            <a href="index-8.html"><img src="assets/img/home-08.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index-8.html">Pet Grooming Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="single-demo">
                                                        {{-- <div class="demo-img">
                                                            <a href="index-9.html"><img src="assets/img/home-09.jpg"
                                                                    class="img-fluid" alt="img"></a>
                                                        </div> --}}
                                                        <div class="demo-info">
                                                            <a href="index-9.html">Mechanic Home</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Services <i class="fas fa-chevron-down"></i></a>
                                <ul class="submenu">
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
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Customers <i class="fas fa-chevron-down"></i></a>
                                <ul class="submenu">
                                    <li><a href="customer-dashboard.html">Dashboard</a></li>
                                    <li><a href="customer-booking.html">Booking</a></li>
                                    <li><a href="customer-favourite.html">Favorites</a></li>
                                    <li><a href="customer-wallet.html">Wallet</a></li>
                                    <li><a href="customer-reviews.html">Reviews</a></li>
                                    <li><a href="customer-chat.html">Chat</a></li>
                                    <li><a href="customer-profile.html">Settings</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Providers <i class="fas fa-chevron-down"></i></a>
                                <ul class="submenu">
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
                                </ul>
                            </li>
                            <li class="has-submenu active">
                                <a href="javascript:void(0);">Pages <i class="fas fa-chevron-down"></i></a>
                                <ul class="submenu">
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
                                            <li><a href="login.html">Login</a></li>
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
                                    <li class="active"><a href="terms-condition.html">Terms & Conditions</a></li>
                                    <li><a href="session-expired.html">Session Expired</a></li>
                                    <li><a href="installer.html">Installer</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="blog-grid.html">Blog <i class="fas fa-chevron-down"></i></a>
                                <ul class="submenu">
                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                    <li><a href="blog-list.html">Blog List</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="admin/index.html">Admin</a></li>
                            {{-- <li class="login-link">
                                <a href="choose-signup.html">Register</a>
                            </li>
                            <li class="login-link">
                                <a href="login.html">Login</a>
                            </li> --}}
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        {{-- <li class="nav-item">
                            <a class="nav-link header-reg" href="choose-signup.html">Register</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link header-login" href="login.html"><i
                                    class="fa-regular fa-circle-user me-2"></i>Login</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="bg-img">
            <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg1">
            <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg2">
        </div>

        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12 my-4"">
                        <h2 class=" breadcrumb-title text-white">Top Service Provider City</h2>
                        <div class="d-flex justify-content-center gap-3 col-12 col-md-6 mx-auto mt-5">

                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select your State</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select your City</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <button type="button" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid  bg-secondary-subtle">
            <div class="row w-75 mx-auto align-items-center">
                <div class="col-md-4">
                    <div class="card text-center align-items-center city-card" style="width: 100%;">
                        <img src="{{ asset('assets/img/icons/daily-customer.png') }}" class="card-img-top"
                            style="width: 65px" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">2500+</h5>
                            <p class="card-text">Daily Customer</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center align-items-center city-card" style="width: 100%;">
                        <img src="{{ asset('assets/img/icons/verified.png') }}" class="card-img-top" style="width: 65px"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">4500+</h5>
                            <p class="card-text">Verified Service Provider</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center align-items-center city-card" style="width: 100%;">
                        <img src="{{ asset('assets/img/icons/trophy.svg') }}" class="card-img-top" style="width: 65px"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">2500+</h5>
                            <p class="card-text">Daily Customer</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ..................How it Work............... --}}

        <section class="work-section mt-1">

            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="section-heading aos " data-aos="fade-up">
                            <h2>How It Works</h2>
                            <h4 class="process">Process of Hiring Best Movers</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="work-box aos" data-aos="fade-up">
                            <div class="work-icon">
                                <span class="first">
                                    <img src="assets/img/icons/work-icon.svg" alt="img">
                                </span>
                            </div>
                            <h5>Share Your Requiremen</h5>
                            <p class="workbox-p">Let us know what goods you need to shift and your preferred time.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="work-box aos" data-aos="fade-up">
                            <div class="work-icon">
                                <span>
                                    <img src="assets/img/icons/find-icon.svg" alt="img">
                                </span>
                            </div>
                            <h5>Find the Perfect Matches</h5>
                            <p>We'll find three top-rated movers that match your needs.</p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="work-box aos" data-aos="fade-up">
                            <div class="work-icon">
                                <span>
                                    <img src="assets/img/icons/place-icon.svg" alt="img">
                                </span>
                            </div>
                            <h5>Compare and Hire</h5>
                            <p>Compare shifting quotes and choose the best movers within your budget.</p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="work-box aos" data-aos="fade-up">
                            <div class="work-icon">
                                <span>
                                    <img src="assets/img/icons/next-icon.svg" alt="img">
                                </span>
                            </div>
                            <h5>Schedule Your Move</h5>
                            <p>Confirm the booking details, including the date & time for a seamless move.</p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- ..................How it work End............. --}}


        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="serviceIndiaContainer">
                        <p>If you are planning to shift your belongings, and you have no clue how to shift and search
                            for the best company with a reasonable price in India. ShiftingBazar is here to suggest to
                            you the </p>
                        <h1 class="text-center">Here are Top 10 Packers and Movers Companies in India</h1>
                        <h4 class="mt-3">Gati Logistics Packers and Movers</h4>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus aperiam sit repellat quis
                            perferendis iusto suscipit deserunt enim tempora, in, beatae eligendi vero ut sed esse,
                            mollitia soluta eaque? Sint?20</p>
                        <h4 class="mt-3">Express India Packers and Movers</h4>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus aperiam sit repellat quis
                            perferendis iusto suscipit deserunt enim tempora, in, beatae eligendi vero ut sed esse,
                            mollitia soluta eaque? Sint?20</p>
                        <h4 class="mt-3">Gati Logistics Packers and Movers</h4>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus aperiam sit repellat quis
                            perferendis iusto suscipit deserunt enim tempora, in, beatae eligendi vero ut sed esse,
                            mollitia soluta eaque? Sint?20</p>
                        <h4>Top Factors That Affect Charges of Movers </h4>
                        <p><span class="text-dark">Delivery Type :</span>Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Iste, harum quas molestias commodi voluptate tempora rem voluptatem quam
                            quidem</p>
                        <p><span class="text-dark">Delivery Type :</span>Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Iste, harum quas molestias commodi voluptate tempora rem voluptatem quam
                            quidem</p>
                        <p><span class="text-dark">Delivery Type :</span>Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Iste, harum quas molestias commodi voluptate tempora rem voluptatem quam
                            quidem</p>
                        <p><span class="text-dark">Delivery Type :</span>Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Iste, harum quas molestias commodi voluptate tempora rem voluptatem quam
                            quidem</p>
                        <h4>Tips to Find a Shifting Company in India?</h4>
                        <p>Tips to Find a Shifting Company in India?Tips to Find a Shifting Company in India?Tips to
                            Find a Shifting Company in India?</p>
                        <p>Tips to Find a Shifting Company in India?Tips to Find a Shifting Company in India?Tips to
                            Find a Shifting Company in India?</p>
                        <p>Tips to Find a Shifting Company in India?Tips to Find a Shifting Company in India?Tips to
                            Find a Shifting Company in India?</p>
                        <p>Tips to Find a Shifting Company in India?Tips to Find a Shifting Company in India?Tips to
                            Find a Shifting Company in India?</p>


                    </div>
                </div>
            </div>
        </div>



        <div class="container-fluid border border-danger w-75 mx-auto mt-5"></div>

        <div class="section mt-4">
            <div class="container">
                <h1 class="text-center">Top Packer and Mover In India</h1>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="bangalore-con border-3 border-bottom border-danger mb-4">
                            <a href="">
                                <h4>packers-and-movers Bangalore</h4>
                            </a>
                            <p>Lorem ipo c d optio! Quos, commodi Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit. Quas, consectetur. ! Dolorum, enim porro. Nesciunt?</p>
                        </div>
                        <div class="bangalore-con border-3 border-bottom border-danger mb-4">
                            <a href="">
                                <h4>packers-and-movers Bangalore</h4>
                            </a>
                            <p>Lorem ipo c d optio! Quos, commodi Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit. Quas, consectetur. ! Dolorum, enim porro. Nesciunt?</p>
                        </div>
                        <div class="bangalore-con border-3 border-bottom border-danger mb-4">
                            <a href="">
                                <h4>packers-and-movers Bangalore</h4>
                            </a>
                            <p>Lorem ipo c d optio! Quos, commodi Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit. Quas, consectetur. ! Dolorum, enim porro. Nesciunt?</p>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="bangalore-con border-3 border-bottom border-danger mb-4">
                            <a href="">
                                <h4>packers-and-movers Bangalore</h4>
                            </a>
                            <p>Lorem ipsummodi nesciunt iuatur, sequi aut perferendis optio! Dignissimos quod fuga totam
                                beatae at adipisci! Quos, commodi! Dolorum, enim porro. Nesciunt?</p>
                        </div>
                        <div class="bangalore-con border-3 border-bottom border-danger mb-4">
                            <h4>packers-and-movers Bangalore</h4>
                            <p>Lorem ipsummodi nesciunt iuatur, sequi aut perferendis optio! Dignissimos quod fuga totam
                                beatae at adipisci! Quos, commodi! Dolorum, enim porro. Nesciunt?</p>
                        </div>
                        <div class="bangalore-con border-3 border-bottom border-danger mb-4">
                            <a href="">
                                <h4>packers-and-movers Bangalore</h4>
                            </a>
                            <p>Lorem ipsummodi nesciunt iuatur, sequi aut perferendis optio! Dignissimos quod fuga totam
                                beatae at adipisci! Quos, commodi! Dolorum, enim porro. Nesciunt?</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <!-- ..............................FAQ section............................ -->

        <div class="container my-4">
            <h1 class="text-center my-4">FAQ </h1>
            <div class="row">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Accordion Item #1
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                the collapse plugin adds the appropriate classes that we use to style each element.
                                These classes control the overall appearance, as well as the showing and hiding via CSS
                                transitions. You can modify any of this with custom CSS or overriding our default
                                variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Accordion Item #2
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                until the collapse plugin adds the appropriate classes that we use to style each
                                element. These classes control the overall appearance, as well as the showing and hiding
                                via CSS transitions. You can modify any of this with custom CSS or overriding our
                                default variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Accordion Item #3
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                the collapse plugin adds the appropriate classes that we use to style each element.
                                These classes control the overall appearance, as well as the showing and hiding via CSS
                                transitions. You can modify any of this with custom CSS or overriding our default
                                variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>






        <footer class="footer">

            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">

                            <div class="footer-widget">
                                <div class="footer-logo">
                                    <a href="index.html"><img src="assets/img/logo.svg" alt="logo"></a>
                                </div>
                                <div class="footer-content">
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit, sed do eiusmod. </p>
                                </div>
                                <div class="footer-selects">
                                    <h2 class="footer-title">Language & Currency</h2>
                                    <div class="row">
                                        <div class="col-lg-12 d-flex">
                                            <div class="footer-select">
                                                <img src="assets/img/icons/global.svg" alt="img">
                                                <select class="select">
                                                    <option>English</option>
                                                    <option>France</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </div>
                                            <div class="footer-select">
                                                <img src="assets/img/icons/dropdown.svg" class="footer-dropdown"
                                                    alt="img">
                                                <select class="select">
                                                    <option>US Dollars</option>
                                                    <option>INR</option>
                                                    <option>Kuwait</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-2 col-md-6">

                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">Quick Links</h2>
                                <ul>
                                    <li>
                                        <a href="about-us.html">About Us</a>
                                    </li>
                                    <li>
                                        <a href="blog-grid.html">Blog</a>
                                    </li>
                                    <li>
                                        <a href="contact-us.html">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="provider-signup.html">Become a Professional</a>
                                    </li>
                                    <li>
                                        <a href="user-signup.html">Become a User</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6">

                            <div class="footer-widget footer-contact">
                                <h2 class="footer-title">Contact Us</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <p><span><i class="feather-map-pin"></i></span> 367 Hillcrest Lane, Irvine,
                                            California, United States</p>
                                    </div>
                                    <p><span><i class="feather-phone"></i></span> 321 546 8764</p>
                                    <p><span><i class="feather-mail"></i></span> <a
                                            href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="84f0f6f1e1e8fdf7e1e8e8c4e1fce5e9f4e8e1aae7ebe9">[email&#160;protected]</a>
                                    </p>
                                    <p class="mb-0"><span><i class="feather-globe"></i></span> www.truelysell.com
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6">

                            <div class="footer-widget">
                                <h2 class="footer-title">Follow Us</h2>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fa-brands fa-facebook"></i> </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i> </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <h2 class="footer-subtitle">Newsletter Signup</h2>
                                <div class="subscribe-form">
                                    <input type="email" class="form-control" placeholder="Enter Email Address">
                                    <button type="submit" class="btn footer-btn">
                                        <i class="feather-send"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="footer-bottom">
                <div class="container">

                    <div class="copyright">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="copyright-text">
                                    <p class="mb-0">Copyright &copy; 2023. All Rights Reserved.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="payment-image">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img src="assets/img/payment/visa.png"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img src="assets/img/payment/mastercard.png"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img src="assets/img/payment/stripe.png"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img src="assets/img/payment/discover.png"
                                                    alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li>
                                            <a href="privacy-policy.html">Privacy Policy</a>
                                        </li>
                                        <li>
                                            <a href="terms-condition.html">Terms & Conditions</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </footer>


        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>

    </div>


    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-3.7.0.min.js" type="7db8b12444c9592ace2cf678-text/javascript"></script>

    <script src="assets/js/bootstrap.bundle.min.js" type="7db8b12444c9592ace2cf678-text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="assets/js/feather.min.js" type="7db8b12444c9592ace2cf678-text/javascript"></script>

    <script src="assets/plugins/select2/js/select2.min.js" type="7db8b12444c9592ace2cf678-text/javascript"></script>

    <script src="assets/js/script.js" type="7db8b12444c9592ace2cf678-text/javascript"></script>
    <script src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="7db8b12444c9592ace2cf678-|49" defer></script>
</body>

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/terms-condition.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:29 GMT -->

</html>