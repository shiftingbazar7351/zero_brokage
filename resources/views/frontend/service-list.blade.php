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

    <div class="d-flex justify-content-center px-4 sticky-slider" style="background-color: rgb(239, 240, 241)">
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
                                {{-- <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                    class="feather-arrow-down-circle ms-1"></i></a> --}}
                            </div>
                            <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                    class="feather-arrow-down-circle ms-1"></i></a>
                        </div>

                        <div class="filter-content">
                            <h2>Experince <span><i class="feather-chevron-down"></i></span></h2>
                            <div class="filter-checkbox" id="fill-more">
                                <ul>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">1 years - 5 years</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">6 years - 10 years</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">11 years - 15 years</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                                            <span><i></i></span>
                                            <b class="check-content">15 years - 20 years</b>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- <button class="btn btn-primary" id="search-button">Search</button> --}}
                    </div>
                </div>

                <div class="col-lg-8 col-sm-12">
                    <div class="row sorting-div">
                        <div class="col-lg-4 col-sm-12 ">
                            <div class="count-search">
                                <h6> Services</h6>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4" id="service-list">
                        <div class="col-md-12">
                            @include('frontend.partials.service-list')
                            {{--  --}}

                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-sm-12">
                        <div class="blog-pagination rev-page">
                            <nav>
                                <ul class="pagination justify-content-center">
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
                </div> --}}
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
    {{-- <script>
        const inputtestt = document.querySelector("#phoneNumberInput-booking");
        window.intlTelInput(inputtestt, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script> --}}

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

    <script>
        $(document).ready(function() {
            // Trigger AJAX search on button click
            $('#search-button').click(function() {
                performSearch();
            });

            // Trigger AJAX search when a filter changes
            $('.toggleCheckbox, #input-keyword, #myInput').on('change keyup', function() {
                performSearch();
            });

            // Function to perform AJAX request
            function performSearch() {
                let keyword = $('#input-keyword').val();
                let location = $('#myInput').val();
                let categories = [];

                // Get selected categories
                $('.categoryCheckbox:checked').each(function() {
                    categories.push($(this).closest('li').find('.check-content').text().trim());
                });

                $.ajax({
                    url: "{{ route('your.search.route') }}", // Replace with your route
                    method: 'GET',
                    data: {
                        keyword: keyword,
                        location: location,
                        categories: categories
                    },
                    success: function(response) {
                        $('#service-list').html(response.html);
                        $('#filter-section').html(response
                        .filterHtml); // Update the filter section as well
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText); // Handle errors
                    }
                });
            }
        });
    </script>
@endsection
