@extends('frontend.layouts.main')
@section('styles')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"/>


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
    {{-- <div class="breadcrumb-bar">
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
    </div> --}}

    <div class="wrapper">
        <div id="carousel-slider" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2000">
            <!--Indicators-->
            <ol class="carousel-indicators">
              <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-slider" data-slide-to="1"></li>
              <li data-target="#carousel-slider" data-slide-to="2"></li>
              <li data-target="#carousel-slider" data-slide-to="3"></li>
              <li data-target="#carousel-slider" data-slide-to="4"></li>
              <li data-target="#carousel-slider" data-slide-to="5"></li>
              <li data-target="#carousel-slider" data-slide-to="6"></li>
              <li data-target="#carousel-slider" data-slide-to="7"></li>
              <li data-target="#carousel-slider" data-slide-to="8"></li>
            </ol>
            <!--Indicators-->
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
              <!--First slide-->
              <div class="carousel-item active">
                <img class="" src="{{ asset('assets/img/banner/1.png') }}" style="width: 100%; height:50vh" alt="First slide">
              </div>
              <!--/First slide-->
              <!--Second slide-->
              <div class="carousel-item">
                  <img class="" src="{{ asset('assets/img/banner/4.png') }}" style="width: 100%; height:50vh;" alt="First slide">
              </div>
              <!--/Second slide-->
              <!--Third slide-->
              <div class="carousel-item">
                <img class="" src="{{ asset('assets/img/banner/5.png') }}" style="width: 100%; height:50vh" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="" src="{{ asset('assets/img/banner/8.png') }}" style="width: 100%; height:50vh" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="" src="{{ asset('assets/img/banner/9.png') }}" style="width: 100%; height:50vh" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="" src="{{ asset('assets/img/banner/12.png') }}" style="width: 100%; height:50vh" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="" src="{{ asset('assets/img/banner/13.png') }}" style="width: 100%; height:50vh" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="" src="{{ asset('assets/img/banner/15.png') }}" style="width: 100%; height:50vh" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="" src="{{ asset('assets/img/banner/17.png') }}" style="width: 100%; height:50vh" alt="Third slide">
              </div>
              <!--/Third slide-->
              <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black"></span>
                <span class="sr-only" >Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
      </div>

    <div class="d-flex justify-content-center px-4 sticky-slider" style="background-color: rgb(239, 240, 241)">
        <div class="wrapper-slider">
            <i id="left" class="fa-solid fas fa-angle-left"></i>
            <ul class="carousel" style="justify-content: center">
                @foreach ($menus as $menu)
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    <li class="card">
                        <div class="img">
                            <img src="{{ Storage::url('menu/' . $menu->image ?? '') }}" alt="" draggable="false" />
                        </div>
                        <h5 style="font-weight: bold;text-align:center; font-size:16px" class="pt-1">{{ $menu->name ?? '' }}</h5>
                    </li>
                @endforeach
            </ul>
            <i id="right" class="fa-solid fas fa-angle-right"></i>
        </div>
    </div>

    <div class="content" style="background-color: white">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.partials.filter-section')
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/booking_infoPopup.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


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

    // Collect OTP from input fields
    $('.input-div input').each(function() {
        var value = $(this).val().trim(); // Trim any whitespace
        if (value === '' || value.length !== 1) {
            allFilled = false;
            return false; // Exit loop if any field is empty or not a single digit
        }
        otp += value;
    });

    // Validate OTP length
    if (!allFilled || otp.length !== 4) {
        toastr.error('Please enter a valid 4-digit OTP.');
        return; // Exit if OTP is not valid
    }

    // Get the mobile number
    var mobileNumber = $('.Phone-Number').text().trim();

    // Make AJAX request
    $.ajax({
        url: '/enquiry-verify-otp',
        type: 'POST',
        data: {
            mobile_number: mobileNumber,
            otp: otp,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.success);
                $('#myPopup2-booking').hide(); // Hide OTP popup
                // Optionally: Redirect or proceed to the next step
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
            } else {
                toastr.error('An unexpected error occurred.');
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
{{-- new --}}
    {{-- <script>
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
    </script> --}}
{{-- new2 --}}
    <script>
        $(document).ready(function() {
            $('#search-button').click(function() {
                performSearch();
            });

            // Trigger search when a filter changes
            $('.toggleCheckbox, #input-keyword, #myInput, .toggleCheckboxIndia').on('change keyup', function() {
                performSearch();
            });

            // Function to perform AJAX search
            function performSearch() {
                let keyword = $('#input-keyword').val();
                let location = $('#myInput').val();
                let categories = [];
                let experience = '';

                // Get selected categories
                $('.categoryCheckbox:checked').each(function() {
                    categories.push($(this).closest('li').find('.check-content').text().trim());
                });

                // Get selected experience range
                $('.toggleCheckboxIndia:checked').each(function() {
                    experience = $(this).closest('li').find('.check-content').text()
                        .trim(); // Format: "1 years - 5 years"
                    experience = experience.replace('years', '').trim(); // Extract only the number range
                });

                $.ajax({
                    url: "{{ route('your.search.route') }}",
                    method: 'GET',
                    data: {
                        keyword: keyword,
                        location: location,
                        categories: categories,
                        experience: experience
                    },
                    success: function(response) {
                        $('#service-list').html(response.html);
                        $('#filter-section').html(response.filterHtml); // Update the filter section
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endsection
