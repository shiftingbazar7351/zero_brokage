﻿@extends('frontend.layouts.main')
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
                                {{-- <form> --}}
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
                                            placeholder="e.g Car,AC,Electricians service etc">
                                    </div>
                                </div>
                                <div class="search-btn">
                                    <button class="btn btn-primary mt-3" type="submit"><i
                                            class="feather-search me-2"></i>Search
                                    </button>
                                </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (count($subcategories) != 0)
        <section class="feature-section">
            <div class="container">
                <div class="section-heading">
                    <div class="row align-items-center">
                        <div class="col-md-6 aos" data-aos="fade-up">
                            <h2>Service Categories</h2>
                            <p>What do you need to find?</p>
                        </div>

                    </div>
                </div>
                <div class="row">
                    @foreach ($subcategories as $subcategory)
                        <div class="col-4 col-lg-3">
                            <a href="{{ route('service.grid', ['slug' => $subcategory->slug]) }}" class="feature-box aos"
                                data-aos="fade-up">
                                <div class="feature-icon">
                                    <span>
                                        <img src="{{ asset('storage/icon/' . $subcategory->icon ?? '') }}"
                                            class="rounded-circle" alt="img">
                                    </span>
                                </div>
                                <h5>{{ $subcategory->name ?? '' }}</h5>
                                <div class="feature-overlay">
                                    <img src="{{ asset('storage/background_image/' . $subcategory->background_image ?? '') }}"
                                        alt="img">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($trendingsubcat) > 0)
        <section class="feature-section">
            <div class="container">
                <div class="section-heading">
                    <div class="row align-items-center">
                        <div class="col-md-6 aos" data-aos="fade-up">
                            <h2>Trending Categories</h2>
                            <p>What do you like most?</p>
                        </div>

                    </div>
                </div>
                <div class="row">
                    @foreach ($trendingsubcat as $subcategory)
                        <div class="col-4 col-lg-3">
                            <a href="{{ route('service.grid', ['slug' => $subcategory->slug]) }}" class="feature-box aos"
                                data-aos="fade-up">
                                <div class="feature-icon">
                                    <span>
                                        <img src="{{ asset('storage/icon/' . $subcategory->icon ?? '') }}"
                                            class="rounded-circle" alt="img">
                                    </span>
                                </div>
                                <h6>{{ $subcategory->name ?? '' }}</h6>

                            </a>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>
    @endif
    @if (count($featuresubcat))
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
                            @foreach ($featuresubcat as $subcategory)
                                <div class="service-widget aos featured-cont" data-aos="fade-up" style="width: 300px">
                                    <div class="service-img feat-img mt-2" style="width: 250px">
                                        <a href="{{ route('service.grid', ['slug' => $subcategory->slug]) }}">
                                            <img src="{{ asset('storage/icon/' . $subcategory->icon ?? '') }}"
                                                class="img-fluid serv-img" alt="Service Image"
                                                style="width: 250px; height:120px">
                                        </a>
                                        <p style="text-align: center; margin:5px 0px" class="text-dark">
                                            {{ $subcategory->name ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </section>
    @endif

    @if (count($providers))
        <section class="providers-section">
            <div class="container">
                <div class="section-heading">
                    <div class="row align-items-center">
                        <div class="col-md-6 aos" data-aos="fade-up">
                            <h2>Top Providers</h2>
                            <p>Meet Our Experts</p>
                        </div>

                    </div>
                </div>
                <div class="row  aos" data-aos="fade-up">
                    @foreach ($providers as $provider)
                        <div class="col-lg-3 col-sm-3">
                            <div class="providerset">
                                <div class="providerset-img">
                                    <a href="{{ route('vender-profile', $provider->id ?? '') }}">
                                        <img src="{{ asset('storage/vendor/vendor_image/' . $provider->vendor_image ?? '') }}"
                                            alt="img" style="height: 194px">
                                    </a>
                                </div>
                                <div class="providerset-content">
                                    <div class="providerset-price">
                                        <div class="providerset-name">
                                            <h4><a
                                                    href="{{ route('vender-profile', $provider->id ?? '') }}">{{ $provider->vendor_name ?? '' }}</a><i
                                                    class="fa fa-check-circle" aria-hidden="true"></i></h4>
                                            <span>{{ $provider->subCategory->name ?? '' }}</span>
                                        </div>
                                        <div class="providerset-prices">
                                            {{-- <h6>&#8377;{{ $provider->price ??'' }}<span>/hr</span></h6> --}}
                                        </div>
                                    </div>
                                    <div class="provider-rating">
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i
                                                class="fa-solid fa-star-half-stroke filled"></i><span>({{ $provider->review_count ?? '0' }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section class="work-section pt-0 d-none d-sm-block">

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-heading aos " data-aos="fade-up">
                        <h2>How It Works</h2>
                        <marquee direction="left" behavior="scroll" scrollamount="5" >
                           <h4 class="process"> Process of Hiring Best Movers</h4>
                        </marquee>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="work-box aos p-2" data-aos="fade-up">
                        <div class="work-icon">
                            <span class="first">
                                <img src="assets/img/icons/work-icon.svg" alt="img">
                            </span>
                        </div>
                        <h5>Share Your Requirement</h5>
                        <p class="workbox-p">Let us know what goods you need to shift and your preferred time.</p>
                        <h4>01</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="work-box aos p-2" data-aos="fade-up">
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
                    <div class="work-box aos p-2" data-aos="fade-up">
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
                    <div class="work-box aos p-2" data-aos="fade-up">
                        <div class="work-icon">
                            <span>
                                <img src="assets/img/icons/next-icon.svg" alt="img">
                            </span>
                        </div>
                        <h5>Schedule Your Move</h5>
                        <p>Confirm the booking details, including the date & time for a seamless move.</p>
                        <h4>04</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (count($subcategories) != 0)
        <section class="feature-section">
            <div class="container">
                <div class="section-heading">
                    <div class="row align-items-center">
                        <div class="col-md-6 aos" data-aos="fade-up">
                            <h2>Most Popular Services</h2>
                            <p>What do you like most?</p>
                        </div>
                        {{-- <div class="col-md-6 text-md-end aos" data-aos="fade-up">
                        <a href="service-list1-All.html" class="btn btn-primary btn-view">View All<i
                                class="feather-arrow-right-circle"></i></a>
                    </div> --}}
                    </div>
                </div>

                 <div class="d-flex justify-content-center px-4 sticky-slider aos" data-aos="fade-up">
                    <div class="wrapper-slider">
                        <i id="left" class="fa-solid fas fa-angle-left"></i>
                        <ul class="carousell" style="gap:12px">
                            @foreach ($subcategories as $subcategory)
                            <li class="card" style="width: 100%">
                                <div class="img">
                                    <a href="{{ route('services-in-india-city', $subcategory->slug ?? '') }}">
                                        <img src="{{ asset('storage/icon/' . $subcategory->icon ?? '') }}" alt=""
                                        draggable="false" />
                                    </a>
                                </div>
                                <h5 style="font-weight: bold;text-align:center; font-size:16px" class="pt-1">
                                    {{ $subcategory->name ?? '' }}</h5>
                            </li>
                            @endforeach

                        </ul>
                        <i id="right" class="fa-solid fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if (count($reviews) > 0)
        <section class="client-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="section-heading aos" data-aos="fade-up">
                            <h2>What our client says</h2>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur elit</p> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel testimonial-slider">
                            @foreach ($reviews as $review)
                                <div class="client-widget aos" data-aos="fade-up">
                                    <p>{{ $review->description ?? '' }}</p>
                                    <h5>{{ $review->name }}</h5>
                                    <h6>{{ $review->profession ?? '' }}</h6>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
