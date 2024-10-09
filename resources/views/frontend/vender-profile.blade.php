@extends('frontend.layouts.main')
@section('styles')

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

        .star-rating {
            direction: ltr;
            /* Ensures stars align left to right */
            display: inline-flex;
        }

        .star {
            font-size: 40px;
            color: #ccc;
            /* Default star color (grey) */
            cursor: pointer;
        }

        .star.selected {
            color: #00aaff;
            /* Highlighted star color (blue) */
        }
    </style>
@endsection
@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            {{-- <div class="row bg-light rounded">
                <div class="col-md-12  my-4">
                    <div class=" breadcrumb-title text-dark">Fill this form to get the best quotes</div>
                    <div id="div1"
                        class="d-flex flex-column flex-sm-row justify-content-center gap-3 col-12 col-md-9 mx-auto my-4">

                        <div class="col-md-3"><input class="form-control" type="text" placeholder="Enter your name"></div>
                        <div class="col-md-3">
                            <input class="form-control" type="Email" placeholder="Enter your email">
                        </div>
                        <div class="col-md-3 d-flex flex-column">
                            <div><input class="form-control" id="venderprofileNum" type="text"
                                    placeholder="Enter Mobile No" maxlength="10"></div>
                            <div class="text-danger">Don't use +91</p>
                            </div>
                        </div>
                        <div>
                            <button id="ClickBtn" type="button" class="btn btn-primary btn-lg text-nowrap"
                                style="margin-left:7%;">Get
                                OTP</button>
                        </div>

                    </div>

                    <div id="div2" class="d-flex justify-content-center col-12 col-md-9   mx-auto d-none gap-4 my-4">
                        <input class="form-control text-center w-25 inputOTP" type="text" placeholder="Enter your OTP"
                            maxlength="4">
                        <button id="ClickBtn" type="button" class="btn btn-primary btn-lg text-nowrap">Verify
                            OTP</button>
                    </div>

                </div>
            </div> --}}

            <div class="row bg-light rounded">
                <div class="col-md-12 my-4">
                    <div class="breadcrumb-title text-dark">Fill this form to get the best quotes</div>
                    <div id="div1"
                        class="d-flex flex-column flex-sm-row justify-content-center align-items-baseline gap-3 col-12 col-md-9 mx-auto my-4">
                        <div class="col-md-3">
                            <input id="name" class="form-control" type="text" placeholder="Enter your name">
                            <span id="name-error" class="text-danger"></span>
                        </div>
                        <div class="col-md-3">
                            <input id="email" class="form-control" type="email" placeholder="Enter your email">
                            <span id="email-error" class="text-danger"></span>
                        </div>
                        {{-- <div class="col-md-3 d-flex flex-column">
                            <input id="mobile" class="form-control" type="text" placeholder="Enter Mobile No"
                                maxlength="10">
                            <span id="mobile-error" class="text-danger">Don't use +91</span>
                        </div> --}}

                        <div class="col-md-3 d-flex flex-column">
                            <div><input class="form-control" id="venderprofileNum" name="mobile_number" type="text"
                                    placeholder="Enter Mobile No" maxlength="10"></div>
                            <div class="text-danger" id="mobile-error"></p>
                            </div>
                        </div>
                        <div>
                            <button id="getOtpBtn" type="button" class="btn btn-primary btn-lg text-nowrap">Get
                                OTP</button>
                        </div>
                    </div>

                    <div id="div2" class="d-flex justify-content-center col-12 col-md-9 mx-auto d-none gap-4 my-4">
                        <input id="otp" class="form-control text-center w-25 inputOTP" type="text"
                            placeholder="Enter your OTP" maxlength="4">
                        <button id="verifyOtpBtn" type="button" class="btn btn-primary btn-lg text-nowrap">Verify
                            OTP</button>
                    </div>
                </div>
            </div>
            <script>
                // $(document).ready(function() {
                //     // Get OTP button click event
                //     $('#getOtpBtn').click(function() {
                //         // Clear previous errors
                //         $('#name-error').text('');
                //         $('#email-error').text('');
                //         $('#mobile-error').text('');

                //         // Collect form data
                //         var name = $('#name').val();
                //         var email = $('#email').val();
                //         var mobile = $('#venderprofileNum').val(); // Updated ID

                //         // Client-side validation
                //         if (!name) {
                //             $('#name-error').text('Name is required.');
                //             return;
                //         }
                //         if (!email) {
                //             $('#email-error').text('Email is required.');
                //             return;
                //         }
                //         if (!mobile || mobile.length != 10) {
                //             $('#mobile-error').text('Valid mobile number is required.');
                //             return;
                //         }

                //         // Send AJAX request to get OTP
                //         $.ajax({
                //             url: '{{ route('getOtp') }}',
                //             method: 'POST',
                //             data: {
                //                 _token: '{{ csrf_token() }}',
                //                 name: name,
                //                 email: email,
                //                 mobile_number: mobile // Updated key to match server-side expectation
                //             },
                //             success: function(response) {
                //                 if (response.success) {
                //                     $('#div1').addClass('d-none');
                //                     $('#div2').removeClass('d-none');
                //                     alert('OTP sent successfully.');
                //                 } else {
                //                     alert('Failed to send OTP. Please try again.');
                //                 }
                //             },
                //             error: function(xhr) {
                //                 alert('An error occurred. Please try again.');
                //             }
                //         });
                //     });

                //     // Verify OTP button click event
                //     $('#verifyOtpBtn').click(function() {
                //         var otp = $('#otp').val();

                //         if (!otp || otp.length != 4) {
                //             alert('Please enter a valid 4-digit OTP.');
                //             return;
                //         }

                //         // Send AJAX request to verify OTP
                //         $.ajax({
                //             url: '{{ route('verifyOtp') }}',
                //             method: 'POST',
                //             data: {
                //                 _token: '{{ csrf_token() }}',
                //                 otp: otp
                //             },
                //             success: function(response) {
                //                 if (response.success) {
                //                     alert('OTP verified successfully.');
                //                     // Redirect or perform next action
                //                 } else {
                //                     alert('Invalid OTP. Please try again.');
                //                 }
                //             },
                //             error: function(xhr) {
                //                 alert('An error occurred. Please try again.');
                //             }
                //         });
                //     });
                // });


                $(document).ready(function() {
                    // Get OTP button click event
                    $('#getOtpBtn').click(function() {
                        // Clear previous errors
                        $('#name-error').text('');
                        $('#email-error').text('');
                        $('#mobile-error').text('');

                        // Collect form data
                        var name = $('#name').val();
                        var email = $('#email').val();
                        var mobile = $('#venderprofileNum').val(); // Correct ID

                        // Client-side validation
                        if (!name) {
                            $('#name-error').text('Name is required.');
                            return;
                        }
                        if (!email) {
                            $('#email-error').text('Email is required.');
                            return;
                        }
                        if (!mobile || mobile.length != 10) {
                            $('#mobile-error').text('Valid mobile number is required.');
                            return;
                        }

                        // Send AJAX request to get OTP
                        $.ajax({
                            url: '{{ route('getOtp') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                name: name,
                                email: email,
                                mobile_number: mobile // Updated key to match server-side expectation
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('#div1').addClass('d-none');
                                    $('#div2').removeClass('d-none');
                                    alert('OTP sent successfully.');
                                } else {
                                    alert('Failed to send OTP. Please try again.');
                                }
                            },
                            error: function(xhr) {
                                alert('An error occurred. Please try again.');
                            }
                        });
                    });

                    // Verify OTP button click event
                    $('#verifyOtpBtn').click(function() {
                        // Collect form data
                        var otp = $('#otp').val();
                        var mobile = $('#venderprofileNum').val(); // Ensure the mobile number is included

                        if (!otp || otp.length != 4) {
                            alert('Please enter a valid 4-digit OTP.');
                            return;
                        }
                        if (!mobile || mobile.length != 10) {
                            alert('Valid mobile number is required.');
                            return;
                        }

                        // Send AJAX request to verify OTP
                        $.ajax({
                            url: '{{ route('verifyOtp') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                otp: otp,
                                mobile_number: mobile // Include mobile number in the request
                            },
                            success: function(response) {
                                if (response.success) {
                                    // alert('OTP verified successfully.');
                                    toastr.success('OTP verified successfully.')
                                    location.reload();
                                    // Redirect or perform next action
                                } else {
                                    toastr.error('Incorrect OTP entered.');
                                }
                            },
                            error: function(xhr) {
                                // alert('An error occurred. Please try again.');
                                toastr.error('Incorrect OTP entered.')
                            }
                        });
                    });
                });
            </script>
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
                        <strong class="card-text">Daily Customer</strong>

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
                        <strong class="card-text">Verified Service Provider</strong>

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
                        <strong class="card-text">Average Rating</strong>

                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- ..........................Provider Details container start...................... --}}

    @if ($vendor)
        <div class="container mt-4 border shadow">
            <div class="row">
                <div class="col-md-3 d-flex align-items-center">
                    <div class="img-prof w-100">
                        <img src="{{ asset('storage/vendor/vendor_image/' . ($vendor->vendor_image ?? 'default-placeholder.png')) }}"
                            alt="" class="w-100 object-fit-contain">
                    </div>

                </div>
                <div class="col-md-9 m-0 p-0">

                    <div class="provider-info">
                        <h2>{{ $vendor->vendor_name ?? '' }}</h2>
                        <h5>{{ $vendor->company_name ?? '' }}</h5>
                        <p>
                            {{ $vendor->address ?? '' }}
                        </p>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="provide-box">
                                    <span><i class="feather-mail"></i></span>
                                    <div class="provide-info">
                                        <h6>Email</h6>
                                        <p>
                                            <a href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection"
                                                {{-- class="__cf_email__" --}}
                                                data-cfemail="baced2d5d7dbc9d2fadfc2dbd7cad6df94d9d5d7">{{ $vendor->email ?? '' }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="provide-box">
                                    <span><i class="feather-phone"></i></span>
                                    <div class="provide-info">
                                        <h6>Phone</h6>
                                        <p>+91 {{ $vendor->number ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="provide-box">
                                    <span><i class="feather-map-pin"></i></span>
                                    <div class="provide-info">
                                        <h6>Address</h6>
                                        {{-- <p>Hanover, Maryland</p> --}}

                                        <p>
                                            {{ ucwords($vendor->cityName->name ?? '') }},
                                            {{ ucwords($vendor->cityName->state->name ?? '') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="provide-box">
                                    <span><i class="feather-globe"></i></span>
                                    <div class="provide-info">
                                        <h6>Website</h6>
                                        <p>{{ $vendor->website ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6 col-md-12">
                            <div class="provide-box">
                                <span><i class="feather-book-open"></i></span>
                                <div class="provide-info">
                                    <h6>Language</h6>
                                    <p>English, Arabic</p>
                                </div>
                            </div>
                        </div> --}}
                            <div class="col-lg-6 col-md-12">
                                <div class="provide-box">
                                    <span></span>
                                    <a href="#">
                                        <div class="provide-info">
                                            <button class="btn btn-primary">Get Best Quotes</button>
                                        </div>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- ..............................Provider about section................................... --}}

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                @if ($vendor)
                    <div class="provider-details">
                        {{-- <h5>Service Details</h5> --}}
                        <p>
                            {!! $vendor->description ?? '' !!}
                        </p>
                    </div>
                @endif


                <div class="contact-queries mb-4">
                    <h2>Give review to this Company</h2>
                    <form id="reviewForm" enctype="multipart/form">
                        @csrf
                        <div class="row p-3">
                            <!-- Name Field -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Name</label>
                                    <div class="form-icon">
                                        <input class="form-control" type="text" name="name"
                                            placeholder="Enter Your Full Name" required />
                                        <span class="cus-icon"><i class="feather-user"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Email Field -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <div class="form-icon">
                                        <input class="form-control" type="email" name="email"
                                            placeholder="Enter Email Address" required />
                                        <span class="cus-icon"><i class="feather-mail"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Phone Number Field -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Phone Number</label>
                                    <div class="form-icon">
                                        <input class="form-control" type="text" name="phone_number"
                                            placeholder="Enter Phone Number" maxlength="10" required />
                                        <span class="cus-icon"><i class="feather-phone"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Message Field -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Message</label>
                                    <div class="form-icon form-msg">
                                        <textarea class="form-control" name="description" rows="4" placeholder="Enter your Comments" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Rating Field -->
                            <div class="col-md-12">
                                <h4 class="m-0 p-0">Overall Rating</h4>
                                <div class="star-rating">
                                    <span class="star" data-value="1">&#9733;</span>
                                    <span class="star" data-value="2">&#9733;</span>
                                    <span class="star" data-value="3">&#9733;</span>
                                    <span class="star" data-value="4">&#9733;</span>
                                    <span class="star" data-value="5">&#9733;</span>
                                </div>
                                <input type="hidden" name="rating" id="ratingValue" value="5">

                            </div>
                            <!-- Submit Button -->
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="submit">
                                    Submit<i class="feather-arrow-right-circle ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <script>
                    $(document).ready(function() {
                        // Handle star rating selection
                        $('.star').on('click', function() {
                            let rating = $(this).data('value');
                            $('#ratingValue').val(rating);
                            $('.star').each(function(index) {
                                if (index < rating) {
                                    $(this).addClass('selected');
                                } else {
                                    $(this).removeClass('selected');
                                }
                            });
                        });

                        // Handle form submission
                        $('#reviewForm').on('submit', function(e) {
                            e.preventDefault(); // Prevent the default form submission

                            let formData = $(this).serialize(); // Serialize the form data

                            $.ajax({
                                url: "{{ route('reviewstore') }}", // Your form action URL
                                type: "POST",
                                data: formData,
                                success: function(response) {
                                    // Handle success - show a message, reset form, etc.
                                    // alert('Thank you for your review!');
                                    toastr.success('Thank you for your review!')
                                    $('#reviewForm')[0].reset();
                                    $('.star').removeClass('selected');
                                },
                                error: function(xhr, status, error) {
                                    // Handle error - show a message, log the error, etc.
                                    alert('There was an error submitting your review. Please try again.');
                                }
                            });
                        });
                    });
                </script>

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
                                <img src="{{ asset('assets/img/icons/work-icon.svg') }}" alt="img">
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
                                <img src="{{ asset('assets/img/icons/find-icon.svg') }}" alt="img">
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
                                <img src="{{ asset('assets/img/icons/place-icon.svg') }}" alt="img">
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
                                <img src="{{ asset('assets/img/icons/next-icon.svg') }}" alt="img">
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


    {{-- <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="serviceIndiaContainer">

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
    </div> --}}


    {{-- ..............................For blue horizontal line..................... --}}

    <div class="container-fluid border border-primary w-75 mx-auto mt-5"></div>

    <div class="section mt-4">
        <div class="container">
            <h1 class="text-center">Areas of Expertise</h1>
            <div class="row text-center align-items-center">
                @foreach ($subcategories as $subcategory)
                    <div class="col-lg-2 col-md-4 col-sm-6 d-flex">
                        <div class="construct-box flex-fill rounded">
                            <img src="{{ asset('storage/icon/' . $subcategory->icon ?? '') }}" alt="img"
                                style="width: 150px; height:150px;" />
                            <h6>{{ $subcategory->name ?? '' }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    <!-- ..............................FAQ section............................ -->

    @if (count($faqs) > 0)
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
    @endif

    {{-- ...........................best quotes form hide........................... --}}
    <script>
        document.getElementById('ClickBtn').onclick = function() {
            document.getElementById('div1').classList.add('d-none');
            document.getElementById('div2').classList.remove('d-none');
        }
    </script>

    {{-- .........................Rating Star.................... --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    stars.forEach((s, i) => {
                        if (i <= index) {
                            s.classList.add('selected');
                        } else {
                            s.classList.remove('selected');
                        }
                    });
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const venderProfilenum = document.querySelector("#venderprofileNum");
        window.intlTelInput(venderProfilenum, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>
@endsection
