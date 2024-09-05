@if ($submenus && $submenus->isNotEmpty())
    @foreach ($submenus as $menu)
        <!-- Repeat the HTML structure of the service list here -->
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
                    <h5 class="title"><a href="service-details.html">{{ $menu->name ?? '' }}</a></h5>
                    <p>{!! $menu->description ?? '' !!}</p>
                    <a href="#" class="text-primary text-decoration-underline" data-bs-toggle="modal"
                        data-bs-target="#modal-{{ $menu->id }}">View
                        Details</a>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-{{ $menu->id }}" tabindex="-1"
                        aria-labelledby="modalLabel-{{ $menu->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel-{{ $menu->id }}">
                                        Service Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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

                    <!-- Modal and other details -->
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
            <input type="tel" id="phoneNumberInput-booking" class="phone-number-field form-group input-detailss"
                onkeyup="validateNumBookingg(this)" maxlength="10" placeholder="Enter Mobile Number" required>
            <div id="res-booking1"></div>
            <button id="saveChanges-booking1" class="btn mb-4">Continue</button>
        </div>
    </div>


    <div id="myPopup-booking" class="popup">
        <div class="popup-content" style="width: 39%;">
            <span class="close" id="closePopup-booking">&times;</span>
            <h3>Enter Your Details</h3>
            <img src="{{ asset('assets/img/icons/write-icons.svg') }}" alt="" width="75px" class="mb-4">

            <div class="row px-5">
                <div class="col-md-6">
                    <input type="text" class="input-detailss form-control mb-4" aria-label="Sizing example input"
                        name="name" aria-describedby="inputGroup-sizing-default" placeholder="Enter your name"
                        required>
                    <div class="error-message"></div>
                    <input type="text" class="form-control mb-4 input-detailss" aria-label="Sizing example input"
                        name="location" aria-describedby="inputGroup-sizing-default" placeholder="Enter your Location"
                        required>
                    <div class="error-message"></div>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control mb-4 input-detailss" aria-label="Sizing example input"
                        name="email" aria-describedby="inputGroup-sizing-default" placeholder="Enter your email"
                        required>
                    <div class="error-message"></div>
                    <input type="date" class="form-control mb-4 input-detailss" aria-label="Sizing example input"
                        name="date_time" aria-describedby="inputGroup-sizing-default" required>
                    <div class="error-message"></div>
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
@else
    <div class="text-center">
        <img class="align-item-center" src="https://tycove.com/public/assets/images/no-data-found.svg"
            alt="No Data Found" style="margin-top: 50px;">
        <div style="color: #6978dd; margin-top: 20px;">
            <b>No Data Found</b>
        </div>
    </div>
@endif
