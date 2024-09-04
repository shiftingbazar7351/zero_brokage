@extends('frontend.layouts.main')
@section('styles')
    <style>
        /* The search field */
        #myInput {
            box-sizing: border-box;
            font-size: 16px;
            padding: 10px;
            border: 1px solid #ddd;
            width: 100%;
            /* margin-bottom: 10px; */
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        /* Dropdown Content */
        .dropdown-content {
            display: none;
            /* Hide by default */
            position: absolute;
            background-color: #f6f6f6;
            border: 1px solid #ddd;
            max-height: 200px;
            /* Limit height */
            overflow-y: auto;
            /* Enable scroll if content exceeds height */
            z-index: 1;
            width: 100%;
        }

        /* Links inside the dropdown */
        .dropdown-content div {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            cursor: pointer;
        }

        /* Change color of dropdown options on hover */
        .dropdown-content div:hover {
            background-color: #f1f1f1;
        }
    </style>
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12 text-start">
                    <h1 class="breadcrumb-title">Best AC Services in Delhi, just start at @299</h1>
                    <div>
                        <ul class="text-light" style="list-style-type: disc; font-size:20px;">
                            <li class="mb-2"> Door step repair in within 100 minutes</li>
                            <li class="mb-2">Door step repair in within 100 minutes</li>
                            <li class="mb-2">Door step repair in within 100 minutes</li>
                        </ul>
                    </div>
                </div>
                <div class="rating-img mt-4 d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/img/icons/stars.png') }}" style="width: 65px" alt=""> <span
                        style="font-weight: bold; font-size: 2.9rem; color: #f0d32f;">
                        4.5
                    </span>
                </div>

            </div>
        </div>
    </div>
    <div></div>

    <div class="d-flex justify-content-center px-4" style="background-color: rgb(239, 240, 241)">
        <div class="wrapper">
            <i id="left" class="fa-solid fas fa-angle-left"></i>
            <ul class="carousel" style="justify-content: center">
                @foreach ($menus as $menu)
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    <li class="card">
                        <div class="img">
                            <img src="{{ Storage::url('menu/' . $menu->image ?? '') }}" alt="" draggable="false" />
                        </div>
                        <h5 style="font-weight: bold; text-align:center" class="pt-1">{{ $menu->name ?? '' }}</h5>
                    </li>
                @endforeach
            </ul>
            <i id="right" class="fa-solid fas fa-angle-right"></i>
        </div>
    </div>

    <div class="content" style="background-color: white">
        <div class="container-fluid">
            <div class="row">

                {{-- <div class="col-lg-3 col-sm-12 theiaStickySidebar">
                    <div class="filter-div">
                        <div class="filter-head">
                            <h5>Filter by</h5>
                            <a href="javascript:void(0);" class="reset-link" onclick="resetVal()">Reset Filters</a>
                        </div>
                        <div class="filter-content">
                            <h2>Keyword</h2>
                            <input type="text" class="form-control" id="input-keyword" name="keyword"
                                placeholder="What are you looking for?">
                        </div>

                        <div class="filter-content">
                            <h2>Location</h2>
                            <div class="dropdown">
                                <div class="group-img">
                                    <input type="text" placeholder="Search.." id="myInput" name="location"
                                        onkeyup="filterFunction()" class="form-control" style="font-size: small;">
                                </div>
                                <div id="myDropdown" class="dropdown-content">
                                    @foreach ($cities as $city)
                                        <div onclick="selectOption(' {{ ucwords($city->name) }}, {{ ucwords($city->state->name ?? '') }}')"
                                            style="font-size: small;">
                                            {{ ucwords($city->name) }}, {{ ucwords($city->state->name ?? '') }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>



                        <div class="filter-content">
                            <h2>Categories</h2>
                            <div class="filter-checkbox" id="fill-more">
                                <ul>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckbox" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">All Categories</b>
                                        </label>
                                    </li>
                                    @foreach ($subcategories as $subcategory)
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                                <span><i></i></span>
                                                <b class="check-content">{{ $subcategory->name ?? '' }}</b>
                                            </label>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                            <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                    class="feather-arrow-down-circle ms-1"></i></a>
                        </div>
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>


                <div class="col-lg-8  col-sm-12">
                    <div class="row sorting-div">
                        <div class="col-lg-4 col-sm-12 ">
                            <div class="count-search">
                                <h6>Found {{ count($menus) }} Services</h6>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            @foreach ($submenus as $menu)
                                <input type="hidden" name="submenu_id" value="{{ $menu->menu_id }}">
                                <input type="hidden" name="subcategory_id" id="subcategory_id" {{ $menu->id }}>
                                <div class="service-list shadow-sm">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="{{ asset('storage/submenu/' . $menu->image ?? '') }}">
                                            </a>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">{{ ucwords($menu->menu->name) ?? '' }}</span>
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
                                    </div>
                                </div>
                            @endforeach
                            <div id="myPopup-booking1" class="popup">
                                <div class="popup-content" style="width:36%">
                                    <span class="close" id="closePopup-booking1">&times;</span>
                                    <h3>To Book a Service</h3>
                                    <img src="{{ asset('assets/img/icons/signup.png') }}" alt="">
                                    <h5 class="sign-up-text">Enter your Mobile Number</h5>
                                    <input type="tel" id="phoneNumberInput-booking"
                                        class="phone-number-field form-group input-detailss"
                                        onkeyup="validateNumBookingg(this)" maxlength="10"
                                        placeholder="Enter Mobile Number" required>
                                    <div id="res-booking1"></div>
                                    <button id="saveChanges-booking1" class="btn mb-4">Continue</button>
                                </div>
                            </div>


                            <div id="myPopup-booking" class="popup">
                                <div class="popup-content" style="width: 39%;">
                                    <span class="close" id="closePopup-booking">&times;</span>
                                    <h3>Enter Your Details</h3>

                                    <img src="{{ asset('assets/img/icons/write-icons.svg') }}" alt=""
                                        width="75px" class="mb-4">


                                    <div class="row px-5">
                                        <div class="col-md-6">
                                            <input type="text" class="input-detailss form-control mb-4"
                                                aria-label="Sizing example input" name="name"
                                                aria-describedby="inputGroup-sizing-default" placeholder="Enter your name"
                                                required>
                                            <input type="text" class="form-control  mb-4 input-detailss"
                                                aria-label="Sizing example input" name="location"
                                                aria-describedby="inputGroup-sizing-default"
                                                placeholder="Enter your Location" required>

                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control mb-4 input-detailss"
                                                aria-label="Sizing example input" name="email"
                                                aria-describedby="inputGroup-sizing-default"
                                                placeholder="Enter your email" required>
                                            <input type="date" class="form-control  mb-4 input-detailss"
                                                aria-label="Sizing example input" name="date_time"
                                                aria-describedby="inputGroup-sizing-default" required>
                                        </div>
                                    </div>

                                    <button id="saveChanges-booking" class="btn mt-4">Continue</button>

                                </div>
                            </div>

                            <div id="myPopup2-booking" class="popup">
                                <div class="popup-content" style="width: 39%">
                                    <span class="close" id="closePopup2-booking">&times;</span>
                                    <h3>Verify OTP</h3>
                                    <img src="{{ asset('assets/img/icons/lock-icon.png') }}" alt="">

                                    <h5 class="sign-up-text">We've Sent you a 4 Digit Pin On Your Number</h5>

                                    <div class="edit-phone-cont">
                                        <div class="Phone-Number"></div>
                                        <div class="edit-icon" id="editnumber-booking"><img
                                                src="{{ asset('assets/img/icons/edit-icon.svg') }}" alt="">Edit
                                        </div>
                                    </div>
                                    <div class="main-div">
                                        <div class="input-div"><input type="text" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" maxlength="1" />
                                        </div>
                                    </div>
                                    <div class="resend">
                                        <div class="get-otp">Don't get OTP?</div>
                                        <div id="counter-booking" class="text-danger"></div>
                                    </div>
                                    <div class="resend-container">
                                        <h5 class="resend-otp" id="resendOtpTextBooking">Resend OTP</h5>
                                        <p class="whatsapp-otp" id="otpOnWhatsappBooking">Get OTP on <img
                                                src="{{ asset('assets/img/icons/icons8-whatsapp.gif') }}" alt="">
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-lg" id="verify-otp-booking">Verify
                                        OTP</button>


                                    <div class="term-condition">
                                        <input type="checkbox" class="checkbox" id="checkbox-login-booking">
                                        <p>By Continuing, you agree to our <span class="term">Term and Condition</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div> --}}

                <div class="col-lg-3 col-sm-12 theiaStickySidebar">
                    <div class="filter-div">
                        <div class="filter-head">
                            <h5>Filter by</h5>
                            <a href="javascript:void(0);" class="reset-link" onclick="resetVal()">Reset Filters</a>
                        </div>
                        <div class="filter-content">
                            <h2>Keyword</h2>
                            <input type="text" class="form-control" id="input-keyword" name="keyword"
                                placeholder="What are you looking for?">
                        </div>

                        <div class="filter-content">
                            <h2>Location</h2>
                            <div class="dropdown">
                                <div class="group-img">
                                    <input type="text" placeholder="Search.." id="myInput" name="location"
                                        onkeyup="filterFunction()" class="form-control" style="font-size: small;">
                                </div>
                                <div id="myDropdown" class="dropdown-content">
                                    @foreach ($cities as $city)
                                        <div onclick="selectOption('{{ ucwords($city->name) }}, {{ ucwords($city->state->name ?? '') }}')"
                                            style="font-size: small;">
                                            {{ ucwords($city->name) }}, {{ ucwords($city->state->name ?? '') }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="filter-content">
                            <h2>Categories</h2>
                            <div class="filter-checkbox" id="fill-more">
                                <ul>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckbox" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">All Categories</b>
                                        </label>
                                    </li>
                                    @foreach ($subcategories as $subcategory)
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                                <span><i></i></span>
                                                <b class="check-content">{{ $subcategory->name ?? '' }}</b>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                    class="feather-arrow-down-circle ms-1"></i></a>
                        </div>
                        <button class="btn btn-primary" id="search-button">Search</button>
                    </div>
                </div>

                <div class="col-lg-8 col-sm-12">
                    <div class="row sorting-div">
                        <div class="col-lg-4 col-sm-12 ">
                            <div class="count-search">
                                <h6>Found {{ count($menus) }} Services</h6>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4" id="service-list">
                        <div class="col-md-12">
                            @foreach ($submenus as $menu)
                                <input type="hidden" name="submenu_id" value="{{ $menu->menu_id }}">
                                <input type="hidden" name="subcategory_id" id="subcategory_id" {{ $menu->id }}>
                                <div class="service-list shadow-sm">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="{{ asset('storage/submenu/' . $menu->image ?? '') }}">
                                            </a>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">{{ ucwords($menu->menu->name) ?? '' }}</span>
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
                                    </div>
                                </div>
                            @endforeach
                            <div id="myPopup-booking1" class="popup">
                                <div class="popup-content" style="width:36%">
                                    <span class="close" id="closePopup-booking1">&times;</span>
                                    <h3>To Book a Service</h3>
                                    <img src="{{ asset('assets/img/icons/signup.png') }}" alt="">
                                    <h5 class="sign-up-text">Enter your Mobile Number</h5>
                                    <input type="tel" id="phoneNumberInput-booking"
                                        class="phone-number-field form-group input-detailss"
                                        onkeyup="validateNumBookingg(this)" maxlength="10"
                                        placeholder="Enter Mobile Number" required>
                                    <div id="res-booking1"></div>
                                    <button id="saveChanges-booking1" class="btn mb-4">Continue</button>
                                </div>
                            </div>


                            <div id="myPopup-booking" class="popup">
                                <div class="popup-content" style="width: 39%;">
                                    <span class="close" id="closePopup-booking">&times;</span>
                                    <h3>Enter Your Details</h3>

                                    <img src="{{ asset('assets/img/icons/write-icons.svg') }}" alt=""
                                        width="75px" class="mb-4">


                                    <div class="row px-5">
                                        <div class="col-md-6">
                                            <input type="text" class="input-detailss form-control mb-4"
                                                aria-label="Sizing example input" name="name"
                                                aria-describedby="inputGroup-sizing-default" placeholder="Enter your name"
                                                required>
                                            <input type="text" class="form-control  mb-4 input-detailss"
                                                aria-label="Sizing example input" name="location"
                                                aria-describedby="inputGroup-sizing-default"
                                                placeholder="Enter your Location" required>

                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control mb-4 input-detailss"
                                                aria-label="Sizing example input" name="email"
                                                aria-describedby="inputGroup-sizing-default"
                                                placeholder="Enter your email" required>
                                            <input type="date" class="form-control  mb-4 input-detailss"
                                                aria-label="Sizing example input" name="date_time"
                                                aria-describedby="inputGroup-sizing-default" required>
                                        </div>
                                    </div>

                                    <button id="saveChanges-booking" class="btn mt-4">Continue</button>

                                </div>
                            </div>

                            <div id="myPopup2-booking" class="popup">
                                <div class="popup-content" style="width: 39%">
                                    <span class="close" id="closePopup2-booking">&times;</span>
                                    <h3>Verify OTP</h3>
                                    <img src="{{ asset('assets/img/icons/lock-icon.png') }}" alt="">

                                    <h5 class="sign-up-text">We've Sent you a 4 Digit Pin On Your Number</h5>

                                    <div class="edit-phone-cont">
                                        <div class="Phone-Number"></div>
                                        <div class="edit-icon" id="editnumber-booking"><img
                                                src="{{ asset('assets/img/icons/edit-icon.svg') }}" alt="">Edit
                                        </div>
                                    </div>
                                    <div class="main-div">
                                        <div class="input-div"><input type="text" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" maxlength="1" />
                                        </div>

                                        <div class="input-div"><input type="text" maxlength="1" />
                                        </div>
                                    </div>
                                    <div class="resend">
                                        <div class="get-otp">Don't get OTP?</div>
                                        <div id="counter-booking" class="text-danger"></div>
                                    </div>
                                    <div class="resend-container">
                                        <h5 class="resend-otp" id="resendOtpTextBooking">Resend OTP</h5>
                                        <p class="whatsapp-otp" id="otpOnWhatsappBooking">Get OTP on <img
                                                src="{{ asset('assets/img/icons/icons8-whatsapp.gif') }}" alt="">
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-lg" id="verify-otp-booking">Verify
                                        OTP</button>


                                    <div class="term-condition">
                                        <input type="checkbox" class="checkbox" id="checkbox-login-booking">
                                        <p>By Continuing, you agree to our <span class="term">Term and Condition</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
             <script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-button').click(function() {
            let keyword = $('#input-keyword').val();
            let location = $('#myInput').val();
            let categories = $('.categoryCheckbox:checked').map(function() {
                return $(this).siblings('.check-content').text();
            }).get();

            $.ajax({
                url: '{{ route('search.filter') }}', // Ensure this matches your route name
                method: 'GET',
                data: {
                    keyword: keyword,
                    location: location,
                    categories: categories
                },
                success: function(response) {
                    $('#service-list').html(response);
                },
                error: function(xhr) {
                    console.error('An error occurred:', xhr.responseText);
                }
            });
        });

        // Reset filters function
        window.resetVal = function() {
            $('#input-keyword').val('');
            $('#myInput').val('');
            $('.categoryCheckbox').prop('checked', false);
        };
    });
</script>

             </script>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script>
        window.addEventListener('scroll', function() {
            var stickySlider = document.querySelector('.sticky-slider');
            var offsetTop = stickySlider.offsetTop;

            if (window.pageYOffset > offsetTop - 98) {
                stickySlider.style.position = 'fixed';
                stickySlider.style.top = '98px';
                stickySlider.style.zIndex = '99';
                stickySlider.style.width = '100%'; // Ensures the width doesn't collapse
            } else {
                stickySlider.style.position = 'relative';
                stickySlider.style.top = 'auto';
            }
        });
    </script> --}}
    <script src="{{ asset('assets/js/booking_infoPopup.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const inputtestt = document.querySelector("#phoneNumberInput-booking");
        window.intlTelInput(inputtestt, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle mobile number submission
            $('#saveChanges-booking1').click(function(e) {
                e.preventDefault();
                let mobileNumber = $('#phoneNumberInput-booking').val();

                $.ajax({
                    url: '/user/enquiry/store', // The route for storing the mobile number
                    type: 'POST',
                    data: {
                        mobile_number: mobileNumber,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Mobile number saved successfully');
                        // Open the next popup
                        $('#myPopup-booking1').hide();
                        $('#myPopup-booking').show();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors && errors.mobile_number) {
                            $('#res-booking1').text(errors.mobile_number[0]);
                        }
                    }
                });
            });

            // Handle details submission
            $('#saveChanges-booking').click(function(e) {
                e.preventDefault();
                let name = $('input[placeholder="Enter your name"]').val();
                let move_from_origin = $('input[placeholder="Enter your Location"]').val();
                let email = $('input[placeholder="Enter your email"]').val();
                let subcategory_id = $('#subcategory_id').val();
                let date_time = $('input[type="date"]').val(); // Using date_time to match controller

                $.ajax({
                    url: '/user/enquiry/update',
                    type: 'POST',
                    data: {
                        mobile_number: $('#phoneNumberInput-booking')
                            .val(), // Assuming mobile number is being used as identifier
                        name: name,
                        move_from_origin: move_from_origin,
                        email: email,
                        date_time: date_time,
                        subcategory_id: subcategory_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Details updated successfully');
                        $('#myPopup-booking').hide();
                        $('#myPopup2-booking').show(); // Show the OTP verification popup
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        // Display the errors accordingly
                        if (errors) {
                            if (errors.name) {
                                alert(errors.name[0]);
                            }
                            if (errors.email) {
                                alert(errors.email[0]);
                            }
                            if (errors.date_time) {
                                alert(errors.date_time[0]);
                            }
                        }
                    }
                });
            });


            $('#verify-otp-booking').click(function(e) {
                e.preventDefault();

                var otp = '';
                var allFilled = true;

                // Combine the OTP input values
                $('.input-div input').each(function() {
                    var value = $(this).val().trim(); // Trim any whitespace
                    if (value === '' || value.length !== 1) {
                        allFilled = false;
                        return false; // Exit loop if any field is empty or not a single digit
                    }
                    otp += value;
                });

                if (!allFilled || otp.length !== 4) {
                    toastr.error('Please enter a valid 4-digit OTP.');
                    return; // Exit if OTP is not valid
                }

                var mobileNumber = $('.Phone-Number').text(); // Get mobile number from the popup

                $.ajax({
                    url: '/verify-otp',
                    type: 'POST',
                    data: {
                        mobile_number: mobileNumber,
                        otp: otp,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);

                            // Hide the OTP verification popup or transition to the next step
                            $('#myPopup2-booking').hide();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        } else if (xhr.status === 400) {
                            toastr.error(xhr.responseJSON.error);
                        }
                    }
                });
            });



        });
    </script>
    <script>
        const otpInputs = document.querySelectorAll('.otp-input');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1) {
                    // Move to the next input field if it exists
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', (e) => {
                // Handle the backspace key to move to the previous input
                if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
    </script>

    {{-- <script>
        window.addEventListener('scroll', function() {
            var stickySlider = document.querySelector('.sticky-slider');
            var offsetTop = stickySlider.offsetTop;

            if (window.pageYOffset > offsetTop - 0) {
                stickySlider.style.position = 'fixed';
                stickySlider.style.top = '0px';
                stickySlider.style.zIndex = '9999999999';
                stickySlider.style.width = '100%'; // Ensures the width doesn't collapse
            } else {
                stickySlider.style.position = 'relative';
                stickySlider.style.top = 'auto';
            }
        });
    </script>


    <script src="{{ asset('assets/js/booking_infoPopup.js') }}"></script>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const inputPhonelist = document.querySelector("#phoneNumberInput-booking");
        window.intlTelInput(inputPhonelist, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script> --}}

    <script>
        function filterFunction() {
            var input, filter, div, options, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            options = div.getElementsByTagName("div");

            // Show dropdown content when user starts typing
            div.style.display = input.value ? "block" : "none";

            for (i = 0; i < options.length; i++) {
                txtValue = options[i].textContent || options[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    options[i].style.display = "";
                } else {
                    options[i].style.display = "none";
                }
            }
        }

        function selectOption(value) {
            document.getElementById("myInput").value = value;
            document.getElementById("myDropdown").style.display = "none";
        }
    </script>
@endsection
