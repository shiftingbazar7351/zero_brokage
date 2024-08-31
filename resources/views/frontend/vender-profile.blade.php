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
            <div class="row bg-light rounded">
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

    <div class="container mt-4 border">
        <div class="row">
            <div class="col-md-3 d-flex align-items-center">
                <div class="img-prof">
                    <img src="{{ asset('assets/img/profiles/avatar-07.jpg') }}" alt=""
                        class="w-100 object-fit-contain">
                </div>

            </div>
            <div class="col-md-9">

                <div class="provider-info">
                    <h2>Dev Home Packer and Mover</h2>
                    <h5>Mover</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                        do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo dolor in reprehenderit
                        in voluptate consequat.
                    </p>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="provide-box">
                                <span><i class="feather-mail"></i></span>
                                <div class="provide-info">
                                    <h6>Email</h6>
                                    <p>
                                        <a href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="baced2d5d7dbc9d2fadfc2dbd7cad6df94d9d5d7">[email&#160;protected]</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="provide-box">
                                <span><i class="feather-phone"></i></span>
                                <div class="provide-info">
                                    <h6>Phone</h6>
                                    <p>+1 888 888 8888</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="provide-box">
                                <span><i class="feather-map-pin"></i></span>
                                <div class="provide-info">
                                    <h6>Address</h6>
                                    <p>Hanover, Maryland</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="provide-box">
                                <span><i class="feather-globe"></i></span>
                                <div class="provide-info">
                                    <h6>Website</h6>
                                    <p>wwww.examplewebsite.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="provide-box">
                                <span><i class="feather-book-open"></i></span>
                                <div class="provide-info">
                                    <h6>Language</h6>
                                    <p>English, Arabic</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="provide-box">
                                <span></span>
                                <div class="provide-info">
                                    <button class="btn btn-primary">Get Best Quotes</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ..............................Provider about section................................... --}}

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="provider-details">
                    <h5>Service Details</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                        do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                        irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                        cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum.
                    </p>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusantium doloremque laudantium, totam rem aperiam, eaque
                        ipsa quae ab illo inventore veritatis et quasi architecto
                        beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                        quia voluptas sit aspernatur aut odit aut fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi
                        nesciunt.
                    </p>
                    <p>
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui
                        blanditiis praesentium voluptatum deleniti atque corrupti quos
                        dolores et quas molestias excepturi sint occaecati cupiditate
                        non provident, similique sunt in culpa qui officia deserunt
                        mollitia animi, id est laborum et dolorum fuga. Et harum
                        quidem rerum facilis est et expedita distinctio. Nam libero
                        tempore, cum soluta nobis est eligendi optio cumque nihil
                        impedit quo minus id quod maxime placeat facere possimus,
                        omnis voluptas assumenda est, omnis dolor repellendus.
                    </p>
                </div>



                <div class="contact-queries mb-4">
                    <h2>Give review to this Company</h2>
                    <form action="https://truelysell.dreamstechnologies.com/html/template/contact-us.html">
                        <div class="row p-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Name</label>
                                    <div class="form-icon">
                                        <input class="form-control" type="text" placeholder="Enter Your Full Name" />
                                        <span class="cus-icon"><i class="feather-user"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <div class="form-icon">
                                        <input class="form-control" type="email" placeholder="Enter Email Address" />
                                        <span class="cus-icon"><i class="feather-mail"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Phone Number</label>
                                    <div class="form-icon">
                                        <input class="form-control" type="text" placeholder="Enter Phone Number" />
                                        <span class="cus-icon"><i class="feather-phone"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Message</label>
                                    <div class="form-icon form-msg">
                                        <textarea class="form-control" rows="4" placeholder="Enter your Comments"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="m-0 p-0">Overall Rating</h4>
                                <div class="star-rating">
                                    <span class="star" data-value="1">&#9733;</span>
                                    <span class="star" data-value="2">&#9733;</span>
                                    <span class="star" data-value="3">&#9733;</span>
                                    <span class="star" data-value="4">&#9733;</span>
                                    <span class="star" data-value="5">&#9733;</span>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="submit">
                                    Submit<i class="feather-arrow-right-circle ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
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
    </div>


    {{-- ..............................For blue horizontal line..................... --}}

    <div class="container-fluid border border-primary w-75 mx-auto mt-5"></div>

    <div class="section mt-4">
        <div class="container">
            <h1 class="text-center">Areas of Expertise</h1>
            <div class="row text-center align-items-center">
                <div class="col-lg-2 col-md-4 col-sm-6 d-flex">
                    <div class="construct-box flex-fill ">
                        <img src="assets/img/home-06.jpg" alt="img" style="width: 150px; height:150px;" />
                        <h6>Construction</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 d-flex">
                    <div class="construct-box flex-fill">
                        <img src="assets/img/home-07.jpg" alt="img" style="width: 150px; height:150px;" />
                        <h6>Car Wash</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 d-flex">
                    <div class="construct-box flex-fill">
                        <img src="assets/img/mobile.png" alt="img" style="width: 150px; height:150px;" />
                        <h6>Electrical</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 d-flex">
                    <div class="construct-box flex-fill">
                        <img src="assets/img/icons/feature-icon-04.svg" alt="img"
                            style="width: 150px; height:150px;" />
                        <h6>Cleaning</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 d-flex">
                    <div class="construct-box flex-fill">
                        <img src="assets/img/icons/feature-icon-05.svg" alt="img"
                            style="width: 150px; height:150px;" />
                        <h6>Carpentry</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 d-flex">
                    <div class="construct-box flex-fill">
                        <img src="assets/img/icons/feature-icon-06.svg" alt="img"
                            style="width: 150px; height:150px;" />
                        <h6>Plumbing</h6>
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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until
                            the collapse plugin adds the appropriate classes that we use to style each element.
                            These classes control the overall appearance, as well as the showing and hiding via CSS
                            transitions. You can modify any of this with custom CSS or overriding our default
                            variables. It's also worth noting that just about any HTML can go within the
                            <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden by default,
                            until the collapse plugin adds the appropriate classes that we use to style each
                            element. These classes control the overall appearance, as well as the showing and hiding
                            via CSS transitions. You can modify any of this with custom CSS or overriding our
                            default variables. It's also worth noting that just about any HTML can go within the
                            <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                            the collapse plugin adds the appropriate classes that we use to style each element.
                            These classes control the overall appearance, as well as the showing and hiding via CSS
                            transitions. You can modify any of this with custom CSS or overriding our default
                            variables. It's also worth noting that just about any HTML can go within the
                            <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
