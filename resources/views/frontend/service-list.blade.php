@extends('frontend.layouts.main')
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


    {{-- .................................Slider...................................... --}}


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

                <div class="col-lg-3 col-sm-12 theiaStickySidebar">
                    <div class="filter-div">
                        <div class="filter-head">
                            <h5>Filter by</h5>
                            <a href="#" class="reset-link" onclick="resetVal()">Reset Filters</a>
                        </div>
                        <div class="filter-content">
                            <h2>Keyword</h2>
                            <input type="text" class="form-control" id="input-keyword"
                                placeholder="What are you looking for?">
                        </div>
                        <div class="filter-content">
                            <h2>Location</h2>
                            <div class="group-img">
                                <input type="text" class="form-control" placeholder="Select Location" id="location-val">
                                <i class="feather-map-pin"></i>
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
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Construction</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Car Wash</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Electrical</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Cleaning</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                            <span><i></i></span>
                                            <b class="check-content">Interior</b>
                                        </label>
                                    </li>

                                </ul>
                            </div>
                            <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                    class="feather-arrow-down-circle ms-1"></i></a>
                        </div>


                        <div class="filter-content">
                            <h2>By Rating</h2>
                            <ul class="rating-set">
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox" class="toggleCheckbox">
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
                                        <input type="checkbox" class="toggleCheckbox">
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
                                        <input type="checkbox" class="toggleCheckbox">
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
                                        <input type="checkbox" class="toggleCheckbox">
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
                                        <input type="checkbox" class="toggleCheckbox">
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
                                <h6>Found {{ count($menus) }} Services</h6>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12 d-flex justify-content-end ">
                            <div class="sortbyset">
                                <div class="sorting-select">
                                    <select class="form-control select" id="sortByPrice">
                                        <option value="asc">Price Low to High</option>
                                        <option value="desc">Price High to Low</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
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
                            {{-- {{ dd($menu) }} --}}
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

{{-- ......................................Pagination container Start................................ --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blog-pagination rev-page">
                                <nav>
                                    <ul class="pagination justify-content-center mt-0">
                                        <li class="page-item disabled">
                                            <a class="page-link page-prev" href="javascript:void(0);"
                                                tabindex="-1"><i class="fa-solid fa-arrow-left me-1"></i> PREV</a>
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
 {{-- .........................................Pagination container End............................ --}}
                </div>

            </div>
        </div>
    </div>

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
    </script> --}}


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
        document.getElementById('sortByPrice').addEventListener('change', function() {
            applyFilters();
        });

        document.getElementById('mySelect').addEventListener('change', function() {
            applyFilters();
        });

        document.querySelectorAll('.categoryCheckbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                applyFilters();
            });
        });

        document.querySelectorAll('.rating-set input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                applyFilters();
            });
        });

        function applyFilters() {
            let keyword = document.getElementById('input-keyword').value;
            let location = document.getElementById('location-val').value;
            let subCategory = document.getElementById('mySelect').value;
            let categories = Array.from(document.querySelectorAll('.categoryCheckbox:checked')).map(cb => cb
                .nextElementSibling.textContent.trim());
            let ratings = Array.from(document.querySelectorAll('.rating-set input[type="checkbox"]:checked')).map(cb => cb
                .nextElementSibling.textContent.trim());
            let sortByPrice = document.getElementById('sortByPrice').value;

            let filters = {
                keyword: keyword,
                location: location,
                subCategory: subCategory,
                categories: categories,
                ratings: ratings,
                sortByPrice: sortByPrice
            };

            console.log(filters);

            // Send filters to backend via AJAX
            fetchResults(filters);
        }

        function fetchResults(filters) {
            fetch('/path-to-your-endpoint', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(filters)
                })
                .then(response => response.json())
                .then(data => {
                    // Update the DOM with the filtered results
                    console.log(data);
                    updateResults(data);
                })
                .catch(error => console.error('Error:', error));
        }

        function updateResults(data) {
            // Use the returned data to update the service list in the DOM
        }
    </script>
@endsection
