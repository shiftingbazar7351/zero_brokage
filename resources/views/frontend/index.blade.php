@extends('frontend.layouts.main')
@section('content')


    <section class="hero-section">
        <div class="container">
            <div class="home-banner">
                <div class="row align-items-center w-100">
                    <div class="col-12 mx-auto bann">
                        <div class="section-search aos" data-aos="fade-up">
                            <h1>Welcome to <span class="truely">ZERO</span><span class="sell">BROKAGE</span> For
                                Your Home Services </h1>
                            <div class="search-box">
                                <form action="https://truelysell.dreamstechnologies.com/html/template/search.html">
                                    <div class="search-input line">
                                        <div class="search-group-icon">
                                            <i class="feather-map-pin"></i>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>Your Location</label>
                                            <input type="text" class="form-control border p-3" placeholder="Noida">
                                        </div>
                                    </div>
                                    <div class="search-input">
                                        <div class="search-group-icon search-icon">
                                            <i class="feather-search"></i>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>What are you looking for?</label>
                                            <input type="text" class="form-control border p-3"
                                                placeholder="Car Repair Service">
                                        </div>
                                    </div>
                                    <div class="search-btn">
                                        <button class="btn btn-primary mt-3" type="submit"><i
                                                class="feather-search me-2"></i>Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @if (count($categories) != 0)
        <section class="feature-section">
            <div class="container">
                <div class="section-heading">
                    <div class="row align-items-center">
                        <div class="col-md-6 aos" data-aos="fade-up">
                            <h2>Service Categories</h2>
                            <p>What do you need to find?</p>
                        </div>
                        <div class="col-md-6 text-md-end aos" data-aos="fade-up">
                            <a href="search-list.html" class="btn btn-primary btn-view">View All<i
                                    class="feather-arrow-right-circle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-2 col-lg-3">
                            <a href="{{ route('service.grid', ['slug' => $category->slug]) }}" class="feature-box aos"
                                data-aos="fade-up">
                                <div class="feature-icon">
                                    <span>
                                        <img src="{{ asset('storage/assets/icon/' . $category->icon ?? '') }}"
                                            class="rounded-circle" alt="img">
                                    </span>
                                </div>
                                <h5>{{ $category->name ?? '' }}</h5>
                                <div class="feature-overlay">
                                    <img src="{{ asset('storage/assets/category/' . $category->image ?? '') }}"
                                        alt="img">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="feature-section">
        <div class="container">
            <div class="section-heading">
                <div class="row align-items-center">
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <h2>Trending Categories</h2>
                        <p>What do you like most?</p>
                    </div>
                    <div class="col-md-6 text-md-end aos" data-aos="fade-up">
                        <a href="categories.html" class="btn btn-primary btn-view">View All<i
                                class="feather-arrow-right-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/trendin-01.svg" alt="img">
                            </span>
                        </div>
                        <h6>Catering Service</h6>

                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/feature-icon-04.svg" alt="img">
                            </span>
                        </div>
                        <h6>Deep Cleaning Service</h6>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/trending-03.svg" alt="img">
                            </span>
                        </div>
                        <h6>Painting Service</h6>

                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/feature-icon-02.svg" alt="img">
                            </span>
                        </div>
                        <h6>Car Cleaning</h6>

                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/camera.svg" alt="img">
                            </span>
                        </div>
                        <h6>Photographer</h6>

                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/feature-icon-01.svg" alt="img">
                            </span>
                        </div>
                        <h6>Construction</h6>

                    </a>
                </div>

            </div>
        </div>
    </section>


    <section class="service-section">
        <div class="container">
            <div class="section-heading">
                <div class="row align-items-center">
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <h2>Featured Services</h2>
                        <p>Explore the greates our services. You won’t be disappointed</p>
                    </div>
                    <div class="col-md-6 text-md-end aos" data-aos="fade-up">
                        <div class="owl-nav mynav"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel service-slider">
                        <div class="service-widget aos featured-cont" data-aos="fade-up">
                            <div class="service-img feat-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="assets/img/icons/feature-icon-01.svg">
                                </a>
                                <p style="text-align: center">Construction</p>

                            </div>
                        </div>
                        <div class="service-widget aos featured-cont" data-aos="fade-up">
                            <div class="service-img feat-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="assets/img/icons/feature-icon-02.svg">
                                </a>
                                <p style="text-align: center">Car Washing</p>
                            </div>

                        </div>
                        <div class="service-widget aos featured-cont" data-aos="fade-up">
                            <div class="service-img feat-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="assets/img/icons/feature-icon-03.svg">
                                </a>
                                <p style="text-align: center">Electric</p>
                            </div>

                        </div>
                        <div class="service-widget aos featured-cont" data-aos="fade-up">
                            <div class="service-img feat-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="assets/img/icons/feature-icon-04.svg">
                                </a>
                                <p style="text-align: center">Cleaning</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>


    <section class="providers-section">
        <div class="container">
            <div class="section-heading">
                <div class="row align-items-center">
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <h2>Top Providers</h2>
                        <p>Meet Our Experts</p>
                    </div>
                    <div class="col-md-6 text-md-end aos" data-aos="fade-up">
                        <a href="providers.html" class="btn btn-primary btn-view">View All<i
                                class="feather-arrow-right-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="row  aos" data-aos="fade-up">
                <div class="col-lg-3 col-sm-3">
                    <div class="providerset">
                        <div class="providerset-img">
                            <a href="provider-details.html">
                                <img src="assets/img/provider/provider-11.jpg" alt="img">
                            </a>
                        </div>
                        <div class="providerset-content">
                            <div class="providerset-price">
                                <div class="providerset-name">
                                    <h4><a href="provider-details.html">John Smith</a><i class="fa fa-check-circle"
                                            aria-hidden="true"></i></h4>
                                    <span>Electrician</span>
                                </div>
                                <div class="providerset-prices">
                                    <h6>$20.00<span>/hr</span></h6>
                                </div>
                            </div>
                            <div class="provider-rating">
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fa-solid fa-star-half-stroke filled"></i><span>(320)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3">
                    <div class="providerset">
                        <div class="providerset-img">
                            <a href="provider-details.html">
                                <img src="assets/img/provider/provider-12.jpg" alt="img">
                            </a>
                        </div>
                        <div class="providerset-content">
                            <div class="providerset-price">
                                <div class="providerset-name">
                                    <h4><a href="provider-details.html">Michael</a><i class="fa fa-check-circle"
                                            aria-hidden="true"></i></h4>
                                    <span>Carpenter</span>
                                </div>
                                <div class="providerset-prices">
                                    <h6>$50.00<span>/hr</span></h6>
                                </div>
                            </div>
                            <div class="provider-rating">
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fa-solid fa-star-half-stroke filled"></i><span>(228)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3">
                    <div class="providerset">
                        <div class="providerset-img">
                            <a href="provider-details.html">
                                <img src="assets/img/provider/provider-13.jpg" alt="img">
                            </a>
                        </div>
                        <div class="providerset-content">
                            <div class="providerset-price">
                                <div class="providerset-name">
                                    <h4><a href="provider-details.html">Antoinette</a><i class="fa fa-check-circle"
                                            aria-hidden="true"></i></h4>
                                    <span>Cleaner</span>
                                </div>
                                <div class="providerset-prices">
                                    <h6>$25.00<span>/hr</span></h6>
                                </div>
                            </div>
                            <div class="provider-rating">
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fa-solid fa-star-half-stroke filled"></i><span>(130)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3">
                    <div class="providerset">
                        <div class="providerset-img">
                            <a href="provider-details.html">
                                <img src="assets/img/provider/provider-14.jpg" alt="img">
                            </a>
                        </div>
                        <div class="providerset-content">
                            <div class="providerset-price">
                                <div class="providerset-name">
                                    <h4><a href="provider-details.html">Thompson</a><i class="fa fa-check-circle"
                                            aria-hidden="true"></i></h4>
                                    <span>Mechanic</span>
                                </div>
                                <div class="providerset-prices">
                                    <h6>$25.00<span>/hr</span></h6>
                                </div>
                            </div>
                            <div class="provider-rating">
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fa-solid fa-star-half-stroke filled"></i><span>(95)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="work-section pt-0">

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
                        <h4>01</h4>
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
                        <h4>02</h4>
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
                        <h4>03</h4>
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
                        <h4>03</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature-section">
        <div class="container">
            <div class="section-heading">
                <div class="row align-items-center">
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <h2>Most Popular Services</h2>
                        <p>What do you like most?</p>
                    </div>
                    <div class="col-md-6 text-md-end aos" data-aos="fade-up">
                        <a href="service-list1-All.html" class="btn btn-primary btn-view">View All<i
                                class="feather-arrow-right-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/trendin-01.svg" alt="img">
                            </span>
                        </div>
                        <h5>Catering Service</h5>

                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/feature-icon-04.svg" alt="img">
                            </span>
                        </div>
                        <h5>Deep Cleaning Service</h5>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/trending-03.svg" alt="img">
                            </span>
                        </div>
                        <h5>Painting Service</h5>

                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/feature-icon-02.svg" alt="img">
                            </span>
                        </div>
                        <h5>Car Cleaning</h5>

                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/camera.svg" alt="img">
                            </span>
                        </div>
                        <h5>Photographer</h5>

                    </a>
                </div>
                <div class="col-md-2">
                    <a href="service-list1-All.html" class="feature-box aos" data-aos="fade-up">
                        <div class="feature-icon">
                            <span>
                                <img src="assets/img/icons/feature-icon-01.svg" alt="img">
                            </span>
                        </div>
                        <h5>Construction</h5>

                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="client-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-heading aos" data-aos="fade-up">
                        <h2>What our client says</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur elit</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel testimonial-slider">
                        <div class="client-widget aos" data-aos="fade-up">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi </p>
                            <h5>Sophie Moore</h5>
                            <h6>Director</h6>
                        </div>
                        <div class="client-widget aos" data-aos="fade-up">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi </p>
                            <h5>Mike Hussy</h5>
                            <h6>Lead</h6>
                        </div>
                        <div class="client-widget aos" data-aos="fade-up">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi </p>
                            <h5>John Doe</h5>
                            <h6>CEO</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center aos" data-aos="fade-up">
                    <div class="section-heading">
                        <h2>Latest Blog</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur elit</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="blog flex-fill aos" data-aos="fade-up">
                        <div class="blog-image">
                            <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-01.jpg"
                                    alt="Post Image"></a>
                        </div>
                        <div class="blog-content">
                            <ul class="blog-item">
                                <li><i class="feather-calendar"></i>09 Aug 2023</li>
                                <li>
                                    <div class="post-author">
                                        <a href="#"><i class="feather-user"></i><span>Hal Lewis</span></a>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="blog-title">
                                <a href="blog-details.html">How to Choose a Electrical ServiceProvider?</a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="blog flex-fill aos" data-aos="fade-up">
                        <div class="blog-image">
                            <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-02.jpg"
                                    alt="Post Image"></a>
                        </div>
                        <div class="blog-content">
                            <ul class="blog-item">
                                <li><i class="feather-calendar"></i>09 Aug 2023</li>
                                <li>
                                    <div class="post-author">
                                        <a href="#"><i class="feather-user"></i><span>JohnDoe</span></a>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="blog-title">
                                <a href="blog-details.html">Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit</a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="blog flex-fill aos" data-aos="fade-up">
                        <div class="blog-image">
                            <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-03.jpg"
                                    alt="Post Image"></a>
                        </div>
                        <div class="blog-content">
                            <ul class="blog-item">
                                <li><i class="feather-calendar"></i>09 Aug 2023</li>
                                <li>
                                    <div class="post-author">
                                        <a href="#"><i class="feather-user"></i><span>Greg Avery</span></a>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="blog-title">
                                <a href="blog-details.html">Construction Service Scams: How to Avoid Them</a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center aos " data-aos="fade-up">
                    <div class="section-heading">
                        <h2>Our Partners</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur elit</p>
                    </div>
                </div>
                <div class="owl-carousel partners-slider aos " data-aos="fade-up">
                    <div class="partner-img">
                        <img src="assets/img/partner/partner1.svg" alt="img">
                    </div>
                    <div class="partner-img">
                        <img src="assets/img/partner/partner2.svg" alt="img">
                    </div>
                    <div class="partner-img">
                        <img src="assets/img/partner/partner3.svg" alt="img">
                    </div>
                    <div class="partner-img">
                        <img src="assets/img/partner/partner4.svg" alt="img">
                    </div>
                    <div class="partner-img">
                        <img src="assets/img/partner/partner5.svg" alt="img">
                    </div>
                    <div class="partner-img">
                        <img src="assets/img/partner/partner6.svg" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
