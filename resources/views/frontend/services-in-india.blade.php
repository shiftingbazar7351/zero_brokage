@extends('frontend.layouts.main')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .work-box {
            border: 2px solid #427de9;
            box-shadow: 0 0 15px rgba(31, 29, 29, 0.8);
            transition: box-shadow 0.3s ease;
        }

        .work-box:hover {
            cursor: pointer;
            box-shadow: 0 0 15px #427de9;
        }

        .city-card {
            border: 2px solid #427de9;
            transition: box-shadow 0.3s ease;
        }

        .city-card:hover {
            cursor: pointer;
            box-shadow: 0 0 15px #427de9;
        }



        .popup {
            display: none;
            position: fixed;
            z-index: 111000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .popup-content {
            background-color: white;
            margin: 11% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 42%;
            text-align: center;
            border-radius: 5px;
            transform: translateY(-30px);
            transition: transform 0.3s ease;
        }

        .popup.show {
            display: block;
            opacity: 1;
        }

        .popup.show .popup-content {
            transform: translateY(0);
        }

        .close {
            color: red;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #1573d6;
            color: black;
        }
    </style>
@endsection
@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12 my-4">
                    <h2 class=" breadcrumb-title text-white">Top Service Provider City</h2>
                    <div class="d-flex justify-content-center gap-3  mx-auto mt-5">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select your Category</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select your Sub-category</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
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
                <div class="card text-center align-items-center city-card flex-row">
                    <img src="{{ asset('assets/img/icons/daily-customer.png') }}" class="card-img-top"
                        style="width: 65px; margin-left:3%" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><span style="font-weight: bold; font-size: 1.9rem; color: #f0d32f;">
                                3500+
                            </span></h5>
                        <p class="card-text">Daily Customer</p>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center align-items-center city-card flex-row">
                    <img src="{{ asset('assets/img/icons/verified.png') }}" class="card-img-top"
                        style="width: 65px; margin-left:3%" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><span style="font-weight: bold; font-size: 1.9rem; color: #f0d32f;">
                                4500+
                            </span></h5>
                        <p class="card-text">Verified Service Provider</p>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center align-items-center city-card flex-row">
                    <img src="{{ asset('assets/img/icons/star-rating.png') }}" class="card-img-top"
                        style="width: 65px; margin-left:3%" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><span style="font-weight: bold; font-size: 1.9rem; color: #f0d32f;">
                                4.5/5
                            </span></h5>
                        <p class="card-text">Average Rating</p>

                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- ..........................service list container start...................... --}}

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-3 col-sm-12 theiaStickySidebar">
                    <div class="filter-div">
                        <div class="filter-head">
                            <h5>Filter by</h5>
                            <a href="#" class="reset-link" onclick="resetValue()">Reset Filters</a>
                        </div>
                        <div class="filter-content">
                            <h2>Keyword</h2>
                            <input type="text" class="form-control" id="input-keyword-india"
                                placeholder="What are you looking for?">
                        </div>
                        {{-- <div class="filter-content">
                        <h2>Location</h2>
                        <div class="group-img">
                            <input type="text" class="form-control" placeholder="Select Location"
                                id="location-val">
                            <i class="feather-map-pin"></i>
                        </div>
                    </div> --}}
                        <div class="filter-content">
                            <h2>Sub Category</h2>
                            <select class="form-control select" id="mySelectIndia">
                                <option value="AllSubCategory">All Sub Category</option>
                                <option value="computer">Computer</option>
                                <option value="construction">Construction1</option>
                                <option value="construction">Construction2</option>
                                <option value="construction">Construction3</option>
                            </select>
                        </div>
                        <div class="filter-content">
                            <h2>Categories <span><i class="feather-chevron-down"></i></span></h2>
                            <div class="filter-checkbox" id="fill-more">
                                <ul>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">All Categories</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Construction</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Car Wash</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Electrical</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Cleaning</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Interior</b>
                                        </label>
                                    </li>

                                </ul>
                            </div>
                            <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                    class="feather-arrow-down-circle ms-1"></i></a>
                        </div>

                        <!-- <div class="filter-content">
                                        <h2>Location</h2>
                                        <div class="group-img">
                                            <input type="text" class="form-control" placeholder="Select Location">
                                            <i class="feather-map-pin"></i>
                                        </div>
                                    </div> -->
                        <div class="filter-content">
                            <h2>Price Range <span><i class="feather-chevron-down"></i></span></h2>
                            <div class="filter-checkbox" id="fill-more" style="height: 135px">
                                <ul>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">&#8377;2000-&#8377;4000</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">&#8377;4000-&#8377;6000</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">&#8377;6000-&#8377;8000</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">&#8377;8000-&#8377;10000</b>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filter-content">
                            <h2>By Rating <span><i class="feather-chevron-down"></i></span></h2>
                            <ul class="rating-set">
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox" class="toggleCheckboxIndia">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(35)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox" class="toggleCheckboxIndia">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(40)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox" class="toggleCheckboxIndia">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(40)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox" class="toggleCheckboxIndia">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(20)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox" class="toggleCheckboxIndia">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(5)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>


                <div class="col-lg-8  col-sm-12">
                    <div class="row sorting-div">
                        <div class="col-lg-4 col-sm-12 ">
                            <div class="count-search">
                                <h6>Found 6 Services</h6>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12 d-flex justify-content-end ">
                            <div class="sortbyset">
                                <div class="sorting-select">
                                    <select class="form-control select">
                                        <option>Price Low to High</option>
                                        <option>Price High to Low</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            {{-- <div class="service-list">
                            <div class="service-cont">
                                <div class="service-cont-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-04.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="service-cont-info">
                                    <span class="item-cat">Car Wash</span>
                                    <h5 class="title">
                                        <a href="service-details.html">Car Repair Services</a>
                                    </h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.
                                    </p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.
                                    </p>

                                    <a href="" class="text-primary text-decoration-underline"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">View Details
                                    </a>

                                    <div class="modal fade " id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Service
                                                        Details
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Included</h5>
                                                    <p class="mb-2">Lorem ipsum dolor sit amet consectetur
                                                        adipisicing elit. Optio, ad?</p>
                                                    <h5>Excluded</h5>
                                                    <p class="mb-2">Lorem ipsum dolor sit amet consectetur
                                                        adipisicing elit. Optio, ad?</p>
                                                    <h5>Topic</h5>
                                                    <p class="mb-2">Lorem ipsum dolor sit amet consectetur
                                                        adipisicing elit. Optio, ad?</p>
                                                    <h5>Frequently asked question</h5>
                                                    <p class="mb-2">Lorem ipsum dolor sit amet consectetur
                                                        adipisicing elit. Optio, ad?</p>
                                                    <p class="mb-2">Lorem ipsum dolor sit amet consectetur
                                                        adipisicing elit. Optio, ad?</p>
                                                    <p class="mb-2">Lorem ipsum dolor sit amet consectetur
                                                        adipisicing elit. Optio, ad?</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-pro-img d-flex gap-4">
                                        <p><i class="feather-map-pin"></i>Maryland City, MD, USA</p>
                                        <span><i class="fas fa-star filled"></i>4.9</span>
                                    </div>
                                </div>
                            </div>
                            <div class="service-action">
                                <h6>&#8377;25.00<span class="old-price">&#8377;35.00</span></h6>
                                <a class="btn btn-secondary book-Now-btn">Book Now</a>
                                <a class="btn btn-secondary">View Profile</a>
                            </div>
                        </div> --}}

                            @foreach ($submenus as $menu)
                                <div class="service-list">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="{{ asset('storage/submenu/' . $menu->image ?? '') }}">
                                            </a>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">{{ $menu->menu->name ?? '' }}</span>
                                            <h5 class="title">
                                                <a href="service-details.html">{{ $menu->name ?? '' }}</a>
                                            </h5>
                                            <p>{{ $menu->description ?? '' }}</p>
                                            <a href="#" class="text-primary text-decoration-underline"
                                                data-bs-toggle="modal" data-bs-target="#modal-{{ $menu->id }}">View
                                                Details</a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-{{ $menu->id }}" tabindex="-1"
                                                aria-labelledby="modalLabel-{{ $menu->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel-{{ $menu->id }}">
                                                                Service Details</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $menu->details ?? 'No Data Found' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="service-pro-img d-flex gap-4">
                                                <p><i class="feather-map-pin"></i>
                                                    {{ ucwords($menu->cityName->name ?? '') }},
                                                    {{ ucwords($menu->cityName->state->name ?? '') }}
                                                </p>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="service-action">
                                        <h6>&#8377;{{ $menu->discounted_price ?? '' }}<span class="old-price">&#8377;
                                                {{ $menu->total_price ?? '' }}</span></h6>
                                        <a class="btn btn-secondary book-Now-btn">Book Now</a>
                                        <a class="btn btn-secondary">View Profile</a>
                                    </div>
                                </div>
                            @endforeach
                            <div id="myPopup-booking1-india" class="popup">
                                <div class="popup-content" style="width:36%">
                                    <span class="close" id="closePopup-booking1-india">&times;</span>
                                    <h3>To Book a Service</h3>
                                    <img src="{{ asset('assets/img/icons/signup.png') }}" alt="">
                                    <h5 class="sign-up-text">Enter your Mobile Number</h5>
                                    <input type="tel" id="phoneNumberInput-booking-india"
                                        class="phone-number-field form-group input-detailss"
                                        onkeyup="validateNumBookingg(this)" maxlength="10"
                                        placeholder="Enter Mobile Number" required>
                                    <div id="res-booking1-india"></div>
                                    <button id="saveChanges-booking1-india" class="btn my-4">Continue</button>
                                    {{-- <button id="closePopupBtn" class="btn">Close</button> --}}
                                    {{-- <div class="term-condition">
                                    <input type="checkbox" class="checkbox" id="checkbox-login-booking1">
                                    <p>By Continuing, you agree to our <span class="term">Term and Condition</span>
                                    </p>
                                </div> --}}
                                </div>
                            </div>


                            <div id="myPopup-booking-india" class="popup">
                                <div class="popup-content" style="width: 39%;">
                                    <span class="close" id="closePopup-booking-india">&times;</span>
                                    <h3>Enter Your Details</h3>

                                    <img src="{{ asset('assets/img/icons/write-icons.svg') }}" alt=""
                                        width="75px" class="mb-4">


                                    <div class="row px-5">
                                        <div class="col-md-6">
                                            <input type="text" class="input-detailss form-control mb-4"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default"
                                                placeholder="Enter your name">
                                            <input type="text" class="form-control  mb-4 input-detailss"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default"
                                                placeholder="Enter your Location">

                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control mb-4 input-detailss"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default"
                                                placeholder="Enter your email">
                                            <input type="date" class="form-control  mb-4 input-detailss"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>

                                    <button id="saveChanges-booking-india" class="btn mt-4">Continue</button>

                                </div>
                            </div>

                            <div id="myPopup2-booking-india" class="popup">
                                <div class="popup-content" style="width: 39%">
                                    <span class="close" id="closePopup2-booking-india">&times;</span>
                                    <h3>Verify OTP</h3>
                                    <img src="{{ asset('assets/img/icons/lock-icon.png') }}" alt="">

                                    <h5 class="sign-up-text">We've Sent you a 4 Digit Pin On Your Number</h5>

                                    <div class="edit-phone-cont">
                                        <div class="Phone-Number">8303361853</div>
                                        <div class="edit-icon" id="editnumber-booking-india"><img
                                                src="{{ asset('assets/img/icons/edit-icon.svg') }}" alt="">Edit
                                        </div>
                                    </div>
                                    <div class="main-div">
                                        <div class="input-div"><input type="text" value="4" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" value="4" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" value="4" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" value="4" maxlength="1" />
                                        </div>
                                    </div>
                                    <div class="resend">
                                        <div class="get-otp">Don't get OTP?</div>
                                        <div id="counter-booking-india" class="text-danger"></div>
                                    </div>
                                    <div class="resend-container">
                                        <h5 class="resend-otp" id="resendOtpTextBookingg">Resend OTP</h5>
                                        <p class="whatsapp-otp" id="otpOnWhatsappBookingg">Get OTP on <img
                                                src="{{ asset('assets/img/icons/icons8-whatsapp.gif') }}" alt="">
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-lg" id="verify-otp-booking">Verify
                                        OTP</button>


                                    <div class="term-condition">
                                        <input type="checkbox" class="checkbox" id="checkbox-login-india">
                                        <p>By Continuing, you agree to our <span class="term">Term and
                                                Condition</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blog-pagination rev-page">
                                <nav>
                                    <ul class="pagination justify-content-center mt-0">
                                        <li class="page-item disabled">
                                            <a class="page-link page-prev" href="javascript:void(0);" tabindex="-1"><i
                                                    class="fa-solid fa-arrow-left me-1"></i>
                                                PREV</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="javascript:void(0);">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link page-next" href="javascript:void(0);">NEXT <i
                                                    class="fa-solid fa-arrow-right ms-1"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- ...............................Service-list-container end...................... --}}

    {{-- .............................How it Work............................................... --}}

    <section class="work-section">

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
    {{-- ..............................How it work End......................... --}}


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="serviceIndiaContainer">

                    <h2 class="text-center">Here are Top 10 Packers and Movers Companies in India</h1>
                    {!! $description->description ??'' !!}

                   {{-- <h4 class="mt-3">Gati Logistics Packers and Movers</h4>
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
 --}}



                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid border border-primary w-75 mx-auto mt-5"></div>

    <div class="section mt-4">
        <div class="container">
            <h1 class="text-center">Top Packer and Mover In India</h1>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="bangalore-con border-3 border-bottom border-primary mb-4">
                        <a href="">
                            <h4>packers-and-movers Bangalore</h4>
                        </a>
                        <p>Lorem ipo c d optio! Quos, commodi Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Quas, consectetur. ! Dolorum, enim porro. Nesciunt?</p>
                    </div>
                    <div class="bangalore-con border-3 border-bottom border-primary mb-4">
                        <a href="">
                            <h4>packers-and-movers Bangalore</h4>
                        </a>
                        <p>Lorem ipo c d optio! Quos, commodi Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Quas, consectetur. ! Dolorum, enim porro. Nesciunt?</p>
                    </div>
                    <div class="bangalore-con border-3 border-bottom border-primary mb-4">
                        <a href="">
                            <h4>packers-and-movers Bangalore</h4>
                        </a>
                        <p>Lorem ipo c d optio! Quos, commodi Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Quas, consectetur. ! Dolorum, enim porro. Nesciunt?</p>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="bangalore-con border-3 border-bottom border-primary mb-4">
                        <a href="">
                            <h4>packers-and-movers Bangalore</h4>
                        </a>
                        <p>Lorem ipsummodi nesciunt iuatur, sequi aut perferendis optio! Dignissimos quod fuga totam
                            beatae at adipisci! Quos, commodi! Dolorum, enim porro. Nesciunt?</p>
                    </div>
                    <div class="bangalore-con border-3 border-bottom border-primary mb-4">
                        <h4>packers-and-movers Bangalore</h4>
                        <p>Lorem ipsummodi nesciunt iuatur, sequi aut perferendis optio! Dignissimos quod fuga totam
                            beatae at adipisci! Quos, commodi! Dolorum, enim porro. Nesciunt?</p>
                    </div>
                    <div class="bangalore-con border-3 border-bottom border-primary mb-4">
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
                @foreach ($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index }}" aria-expanded="true"
                                aria-controls="collapse{{ $index }}">
                                {{ $faq->question ?? '' }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}"
                            class="accordion-collapse collapse{{ $index == 0 ? ' show' : '' }}"
                            aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ $faq->answer ?? '' }}
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>

    </div>






    <script src="{{ asset('assets/js/service-india-popup.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="assets/js/jquery-3.7.0.min.js" type="7db8b12444c9592ace2cf678-text/javascript"></script>
    <script>
        const inputtestt = document.querySelector("#phoneNumberInput-booking-india");
        window.intlTelInput(inputtestt, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>
@endsection