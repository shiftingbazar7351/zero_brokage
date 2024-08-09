@extends('frontend.layouts.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

    <div class="bg-img">
        <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg1">
        <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg2">
        <img src="assets/img/bg/feature-bg-03.png" alt="img" class="bgimg3">
    </div>


    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="serv-profile">
                        <h2>Car Repair Services</h2>
                        <ul>
                            <li>
                                <span class="badge">Car Wash</span>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-12 mx-auto border border-gray  rounded">
                    <div class="service-gal p-4">
                        <form id="enquiryForm">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="category">Select Services :</label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="">Select Services</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="move_from_origin" class="form-label">Location</label>
                                         <input type="text" id="move_from_origin" name="move_from_origin" class="form-control" placeholder="Enter your location">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Choose your Date</label>
                                        <input type="datetime-local" class="form-control" id="exampleInputPassword"
                                            placeholder="Choose your date" name="date_time">
                                    </div>

                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail"
                                        aria-describedby="emailHelp" placeholder="Enter email" name="email">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="category">Select Sub-services</label>
                                        <select class="form-control" id="subcategory" name="subcategory_id">
                                            <option value="">Select Subservices</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter your name" name="name">
                                    </div>
                                    <div class="form-group phone-div">
                                        <label for="">Mobile Number</label>
                                        <br>
                                        <div class="input-container">
                                            <input  name="mobile_number" type="text" class="form-control" id="phoneNumberInput-booking"
                                                aria-describedby="emailHelp" placeholder="Enter your Phone Number"
                                                autocomplete="off" data-intl-tel-input-id="0" style="padding-left: 84px;"
                                                onkeydown="return ( event.ctrlKey || event.altKey
                                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                            || (95<event.keyCode && event.keyCode<106)
                                            || (event.keyCode==8) || (event.keyCode==9)
                                            || (event.keyCode>34 && event.keyCode<40)
                                            || (event.keyCode==46) )"
                                            minlength="10" maxlength="10" >
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>


            <section class="work-section pt-0">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="section-heading aos " data-aos="fade-up">
                                <h2>How It Works</h2>

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

            <section class="blog-section">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="blog flex-fill aos" data-aos="fade-up">
                                <div class="blog-image">
                                    <a><img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">

                                    <h5>
                                        Resedential
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="blog flex-fill aos" data-aos="fade-up">
                                <div class="blog-image">
                                    <a href=""><img class="img-fluid" src="assets/img/blog/blog-02.jpg"
                                            alt="Post Image"></a>
                                </div>
                                <div class="blog-content">

                                    <h5>
                                        <a href="">Commercial</a>
                                    </h5>
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

                                    <h5>
                                        <a href="">International</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <div class="row">

                <div class="col-lg-12">
                    <div class="service-wrap">
                        <h5>Service Details</h5>
                        <p>Car wash is a facility used to clean the exterior and, in some cases, the interior of
                            motor vehicles. Car washes can be self-serve, fully automated, or full-service with
                            attendants who wash the vehicle.</p>
                        <p>Car wash is a facility used to clean the exterior and, in some cases, the interior of
                            motor vehicles. Car washes can be self-serve, fully automated, or full-service with
                            attendants who wash the vehicle.</p>
                        <p>Car wash is a facility used to clean the exterior and, in some cases, the interior of
                            motor vehicles. Car washes can be self-serve, fully automated, or full-service with
                            attendants who wash the vehicle.</p>



                    </div>



                    <div class="service-wrap">
                        <h5>Reviews</h5>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                    tempor
                                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis
                                                    nostrud exercitation ullamco laboris nisi </p>
                                                <h5>Sophie Moore</h5>
                                                <h6>Director</h6>
                                            </div>
                                            <div class="client-widget aos" data-aos="fade-up">

                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                    tempor
                                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis
                                                    nostrud exercitation ullamco laboris nisi </p>
                                                <h5>Mike Hussy</h5>
                                                <h6>Lead</h6>
                                            </div>
                                            <div class="client-widget aos" data-aos="fade-up">

                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                    tempor
                                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis
                                                    nostrud exercitation ullamco laboris nisi </p>
                                                <h5>John Doe</h5>
                                                <h6>CEO</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>

            </div>
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
                                <div class="service-widget aos" data-aos="fade-up">
                                    <div class="service-img p-2">
                                        <a href="service-details.html">
                                            <img class="img-fluid serv-img" alt="Service Image"
                                                src="{{ asset('assets/img/services/service-01.jpg') }}">
                                        </a>
                                        <div class="fav-item">
                                            <a href="categories.html"><span class="item-cat">Cleaning</span></a>
                                        </div>

                                    </div>
                                    <div class="service-content">
                                        <h3 class="title">
                                            <a href="service-details.html">Electric Panel Repairing Service</a>
                                        </h3>
                                        <p><i class="feather-map-pin"></i>New Jersey, USA<span class="rate"><i
                                                    class="fas fa-star filled"></i>4.9</span></p>
                                        <div class="serv-info">
                                            <h6>$25.00<span class="old-price">$35.00</span></h6>
                                            <a href="service-details.html" class="btn btn-book">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-widget aos" data-aos="fade-up">
                                    <div class="service-img p-2">
                                        <a href="service-details.html">
                                            <img class="img-fluid serv-img" alt="Service Image"
                                                src="{{ asset('assets/img/services/service-02.jpg') }}">
                                        </a>
                                        <div class="fav-item">
                                            <a href="categories.html"><span class="item-cat">Construction</span></a>

                                        </div>

                                    </div>
                                    <div class="service-content">
                                        <h3 class="title">
                                            <a href="service-details.html">Toughened Glass Fitting Services</a>
                                        </h3>
                                        <p><i class="feather-map-pin"></i>Montana, USA<span class="rate"><i
                                                    class="fas fa-star filled"></i>4.9</span></p>
                                        <div class="serv-info">
                                            <h6>$45.00</h6>
                                            <a href="service-details.html" class="btn btn-book">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-widget aos" data-aos="fade-up">
                                    <div class="service-img p-2">
                                        <a href="service-details.html">
                                            <img class="img-fluid serv-img" alt="Service Image"
                                                src="{{ asset('assets/img/services/service-03.jpg') }}">
                                        </a>
                                        <div class="fav-item">
                                            <a href="categories.html"><span class="item-cat">Carpentry</span></a>

                                        </div>

                                    </div>
                                    <div class="service-content">
                                        <h3 class="title">
                                            <a href="service-details.html">Wooden Carpentry Work</a>
                                        </h3>
                                        <p><i class="feather-map-pin"></i>Montana, USA<span class="rate"><i
                                                    class="fas fa-star filled"></i>4.9</span></p>
                                        <div class="serv-info">
                                            <h6>$45.00</h6>
                                            <a href="service-details.html" class="btn btn-book">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-widget aos" data-aos="fade-up">
                                    <div class="service-img p-2">
                                        <a href="service-details.html">
                                            <img class="img-fluid serv-img" alt="Service Image"
                                                src="{{ asset('assets/img/services/service-11.jpg') }}">
                                        </a>
                                        <div class="fav-item">
                                            <a href="categories.html"><span class="item-cat">Construction</span></a>
                                            <a href="javascript:void(0)" class="fav-icon">
                                                <i class="feather-heart"></i>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <a href="providers.html"><span class="item-img"><img
                                                        src="{{ asset('assets/img/profiles/avatar-04.jpg') }}"
                                                        class="avatar" alt="User"></span></a>
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h3 class="title">
                                            <a href="service-details.html">Plumbing Services</a>
                                        </h3>
                                        <p><i class="feather-map-pin"></i>Georgia, USA<span class="rate"><i
                                                    class="fas fa-star filled"></i>4.9</span></p>
                                        <div class="serv-info">
                                            <h6>$45.00</h6>
                                            <a href="service-details.html" class="btn btn-book">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="blog-section">
                <div class="container">
                    <h2 class="text-center pb-3">How <span class="text-danger">ZeroBroker</span> Hire Packer and Mover
                        Services Work?</h2>
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="blog flex-fill aos" data-aos="fade-up">
                                <div class="blog-image">
                                    <a><img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">

                                    <h4>
                                        Share Your Requirment
                                    </h4>
                                    <p>Tell us where and when do you want to move</p>
                                    <div>Rating : </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="blog flex-fill aos" data-aos="fade-up">
                                <div class="blog-image">
                                    <a href=""><img class="img-fluid" src="assets/img/blog/blog-02.jpg"
                                            alt="Post Image"></a>
                                </div>
                                <div class="blog-content">

                                    <h4>
                                        <a href="">Schedule and confirm</a>
                                    </h4>
                                    <p>Pick a slot and pick a token amount to confirm and move</p>
                                    <div>Rating : </div>
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

                                    <h4>
                                        <a href="">We get you moved</a>
                                    </h4>
                                    <p>Pick a slot and pick a token amount to confirm and move</p>
                                    <div>Rating : </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const input = document.querySelector("#phoneNumberInput-booking");
        window.intlTelInput(input, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>


<script>
    $(document).ready(function() {
        $('#category').on('change', function() {
            var subcategoryId = $(this).val();

            if (subcategoryId) {
                $.ajax({
                    url: '/fetch-subcategory/' + subcategoryId, // Adjusted URL based on route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        if (response.status === 1) {
                            var subcategory = response.data;
                            $('#subcategory').find('option').remove(); // Clear existing options
                            var options =
                                '<option value="">Select subcategory</option>'; // Default option
                            $.each(subcategory, function(key, subcateg) {
                                options += "<option value='" + subcateg.id + "'>" + subcateg.name + "</option>";
                            });
                            $('#subcategory').append(options);
                        }
                    }
                });
            } else {
                $('#subcategory').find('option').remove(); // Clear options if no state is selected
                $('#subcategory').append('<option value="">Select subcategory</option>');
            }
        });
    });

      // Handle form submission
      $('#enquiryForm').off('submit').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('enquiry.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 1) {
                    alert(response.message);
                    $('#addEnquiryModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error occurred while submitting the enquiry.');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });
</script>

@endsection

