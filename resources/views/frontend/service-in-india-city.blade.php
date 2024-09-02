@extends('frontend.layouts.main')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/service-in-india-city.css') }}">
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

                        <div class="city-select d-flex gap-3 w-50">
                            <select class="form-control" id="state" name="state">
                                <option value="" selected disabled>Select state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id ?? '' }}">{{ ucwords($state->name ?? '') }}</option>
                                @endforeach
                            </select>
                            <div id="state-error" class="text-danger"></div>
                            <select class="form-control" id="city" name="city">
                                <option value="" selected disabled>Select City</option>
                            </select>
                            <div id="city-error" class="text-danger"></div>

                            <button type="button" class="btn btn-primary btn-lg">Submit</button>
                        </div>
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


    @if ($description)
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="serviceIndiaContainer">

                        {{-- <h2 class="text-center">Here are Top 10 Packers and Movers Companies in India</h1> --}}
                        {!! $description->description ?? '' !!}

                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="container-fluid border border-primary w-75 mx-auto mt-5"></div>

    @if ($subcategory)
        <div class="section mt-4">
            <div class="container">
                <h1 class="text-center">Top {{ $subcategory->name ?? '' }} In India</h1>
                <div class="row mt-4">
                    @foreach ($cities as $city)
                        <div class="col-md-6 mb-4">
                            <div class="bangalore-con border-3 border-bottom border-primary mb-4">
                                <a href="{{ route('services-in-india',$vendors->id) }}" class="uppercase">
                                    <h4>{{ $subcategory->slug ?? '' }} {{ strtoupper($city->name) }}</h4>
                                </a>
                                <p>{{ Str::limit($vendors->description, 300, '...') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $cities->appends(request()->query())->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    @endif


    <div class="container-fluid bg-light shadow">

        <div class="row">
            <div class="col-md-6">
                <div class="row text-center p-4" style="background-color: #b3c8e0;">
                    <div class="col-md-10 mx-auto">
                        <div class="service-img mb-4 text-center" style="width: 400px; margin: 0 auto;">
                            <img class="w-100" src="{{ asset('assets/img/serviceImage.png') }}" alt="">
                        </div>
                        <h3>Schedule your Appointment Today</h3>
                        <h3>Call: +91-9481998354</h3>
                        <p class="text-dark">
                            Experience an easy way to connect with our professional logistic experts and get the best deals
                            instantly
                            on services like packing and moving, car transportation, cargo, transport, and warehousing.
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-md-6" style="background-color: #c7d2df;">
                <div class="row text-center p-4">
                    <div class="col-md-10 mx-auto">
                        <div class="service-img mb-4 text-center" style="width: 300px; margin: 0 auto;">
                            <img class="w-100" src="{{ asset('assets/img/app-img.png') }}" alt="">
                        </div>
                        <h3>Download the zerobrokage App</h3>
                        <p class="text-dark">Fill your shifting details, Check quotation within 5-10 minutes,check moving
                            company and reviews
                            Rating score</p>
                        <div class="service-img text-center" style="width: 150px; margin: 0 auto;">
                            <img class="w-100" src="{{ asset('assets/img/playstore.png') }}" alt="">
                        </div>

                    </div>
                </div>
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
    {{-- .........................................What our Client said (review section)...................................... --}}

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

    <script>
        $('#state').on('change', function() {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: '/fetch-city/' + stateId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#city').empty().append(
                            '<option value="">Select city</option>');
                        if (response.status === 1) {
                            $.each(response.data, function(key, city) {
                                $('#city').append("<option value='" +
                                    city.id +
                                    "'>" + city.name + "</option>");
                            });
                        }
                    },
                    error: function() {
                        $('#city').empty().append(
                            '<option value="" disabled>Error loading cities</option>'
                        );
                    }
                });
            } else {
                $('#city').empty().append('<option value="">Select city</option>');
            }
        });
    </script>

    {{-- <script>
        function create_custom_dropdowns() {
            $('select').each(function(i, select) {
                if (!$(this).next().hasClass('dropdown-select')) {
                    $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') +
                        '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function(j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ?
                                'selected' : '') + '" data-value="' + $(o).val() +
                            '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });

            $('.dropdown-select ul').before(
                '<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>'
            );
        }

        // Event listeners

        // Open/close
        $(document).on('click', '.dropdown-select', function(event) {
            if ($(event.target).hasClass('dd-searchbox')) {
                return;
            }
            $('.dropdown-select').not($(this)).removeClass('open');
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $(this).find('.option').attr('tabindex', 0);
                $(this).find('.selected').focus();
            } else {
                $(this).find('.option').removeAttr('tabindex');
                $(this).focus();
            }
        });

        // Close when clicking outside
        $(document).on('click', function(event) {
            if ($(event.target).closest('.dropdown-select').length === 0) {
                $('.dropdown-select').removeClass('open');
                $('.dropdown-select .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        function filter() {
            var valThis = $('#txtSearchValue').val();
            $('.dropdown-select ul > li').each(function() {
                var text = $(this).text();
                (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show(): $(this).hide();
            });
        };
        // Search

        // Option click
        $(document).on('click', '.dropdown-select .option', function(event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select').find('.current').text(text);
            $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
        });

        // Keyboard events
        $(document).on('keydown', '.dropdown-select', function(event) {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[
                0]);
            // Space or Enter
            //if (event.keyCode == 32 || event.keyCode == 13) {
            if (event.keyCode == 13) {
                if ($(this).hasClass('open')) {
                    focused_option.trigger('click');
                } else {
                    $(this).trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    focused_option.next().focus();
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find(
                        '.list .option.selected')[0]);
                    focused_option.prev().focus();
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($(this).hasClass('open')) {
                    $(this).trigger('click');
                }
                return false;
            }
        });

        $(document).ready(function() {
            create_custom_dropdowns();
        });
    </script> --}}

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
