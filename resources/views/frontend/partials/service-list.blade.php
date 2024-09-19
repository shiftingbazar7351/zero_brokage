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
                    <h5 class="title"><a>{{ $menu->name ?? '' }}</a></h5>
                    <p>{!! Str::limit($menu->description, 150, '') ?? '' !!}</p>
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
                                    <p>{!! $menu->details ?? 'No Data Found' !!}</p>
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
            {{-- <span class="close" id="closePopup-booking1">&times;</span>
             --}}
             <a><span class="close-icon" id="closePopup-booking1"><img src="{{ asset('assets/img/icons/close-detail.svg') }}" alt=""></span></a>
            <h4>To Book a Service</h4>
            <img src="{{ asset('assets/img/icons/signup.png') }}" alt="">
            <h5 class="sign-up-text mb-3">Enter your Mobile Number</h5>
            <input type="tel" id="phoneNumberInput-booking" class="phone-number-field form-group input-detailss"
                onkeyup="validateNumBookingg(this)" maxlength="10" placeholder="Enter Mobile Number" required>
            <div id="res-booking1"></div>
            <button id="saveChanges-booking1" class="btn mb-4">Continue</button>
        </div>
    </div>


    <div id="myPopup-booking" class="popup">
        <div class="popup-content">
            <a><span class="close-icon" id="closePopup-booking"><img src="{{ asset('assets/img/icons/close-detail.svg') }}" alt=""></span></a>

            <img src="{{ asset('assets/img/logofinal.webp') }}" alt="" width="120px" class="mb-4">
            <h4 class="">Enter Your Details</h4>

            <div class="row px-5 mb-4">
                <div class="col-md-6">
                    <div class="input-container">
                        <span class="icon-symbol"><i class='bx bx-user'><img src="{{ asset('assets/img/icons/user-details.svg') }}" alt=""></i></span>
                        <input type="text" required>
                        <label>Username</label>
                    </div>
                    <div class="error-message"></div>
                    <div class="input-container">
                        <span class="icon-symbol"><i class='bx bx-envelope'><img src="{{ asset('assets/img/icons/mail-details.svg') }}" alt=""></i></span>
                        <input type="email" required>
                        <label>Email</label>
                    </div>
                    <div class="error-message"></div>
                </div>
                <div class="col-md-6">
                    <div class="input-container">
                        <span class="icon-symbol"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAgNJREFUSEu11cnrzlEUx/HXz5wyxIYUEaHMysKUYaGQ2ChiY9iIDTv/gI2UKEk2JJkWEtmYUkoUyawoJAtDSTJzT91Hj8fzHcLvbL717dz7PsPnnNuhk62jk+9XBzAUK7AQE3NAN3AGh/G8LMgyQF8cxJKSC37gKNbgQzu/IkBvXMU4fMJe7MTjfMkIbMZ69Mi+s/ClFVIEOIDVeIYFuFeQxQScTQEMxg5sqQMYj1v4muo8DVHvhkVJwpoDm41L+IzheNEMaZfBLmzEbmxqiagdIFwOYWWCbMW2KsAjjMz1v1MTMBfncTl9I6Nf1i6DaGo0riu+oxF1kZjijgEp29d4g4FVgLfojz54XxMQvu8QZwNWmsF1TE1DNDrV9WHNEo3FXVzLwigF7EvTuS43OBrdbEVNDnluxx5sqMpgHs7hJibXAHTB/aSkUZiBK1WAaNoTDEuQpQlysqi7+f+qvFIeYEyrb9EkL8cRvEQM3qsCyBDczqJYjNN1AeF3AXPylM7Ht5bDPXM5piRRnCpaimXbdBBi0EJ2+/NiazS5G47lEj7FpCzRPxKteg+mpywuojtiAa5Fr/wOREliRUdjQxBtrQoQh5altXEcoZZ4ZOKdmJnX+KKsuEId1AHE4ejBCfTLN0Xz4yGKwSq1uoC4JKY1lPUx1/63tfwvJaoK8r9l8Fegn6PCYRm1a4cNAAAAAElFTkSuQmCC"/></span>
                        <input type="text" required>
                        <label>Location</label>
                    </div>
                    <div class="error-message"></div>
                    <div class="input-container">
                        <input type="date" style="font-weight: normal;padding: 0 10px 0 5px;" required>
                        <label></label>
                    </div>
                    <div class="error-message"></div>
                </div>
            </div>

            <button id="saveChanges-booking" class="btn mt-4">Continue</button>
        </div>
    </div>

    {{-- <div class="container-wrapper register popup" id="myPopup-booking1">
        <a href=""><span class="close-icon" id="closePopup-booking"><ion-icon name="close-outline"></ion-icon></span></a>

        <h3 style="text-align: center;">Enter your details</h3>

        <div class="input-container">
            <span class="icon-symbol"><i class='bx bx-user'></i></span>
            <input type="text" required>
            <label>Username</label>
        </div>

        <div class="input-container">
            <span class="icon-symbol"><i class='bx bx-envelope'></i></span>
            <input type="email" required>
            <label>Email</label>
        </div>

        <div class="input-container">
            <span class="icon-symbol"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAgNJREFUSEu11cnrzlEUx/HXz5wyxIYUEaHMysKUYaGQ2ChiY9iIDTv/gI2UKEk2JJkWEtmYUkoUyawoJAtDSTJzT91Hj8fzHcLvbL717dz7PsPnnNuhk62jk+9XBzAUK7AQE3NAN3AGh/G8LMgyQF8cxJKSC37gKNbgQzu/IkBvXMU4fMJe7MTjfMkIbMZ69Mi+s/ClFVIEOIDVeIYFuFeQxQScTQEMxg5sqQMYj1v4muo8DVHvhkVJwpoDm41L+IzheNEMaZfBLmzEbmxqiagdIFwOYWWCbMW2KsAjjMz1v1MTMBfncTl9I6Nf1i6DaGo0riu+oxF1kZjijgEp29d4g4FVgLfojz54XxMQvu8QZwNWmsF1TE1DNDrV9WHNEo3FXVzLwigF7EvTuS43OBrdbEVNDnluxx5sqMpgHs7hJibXAHTB/aSkUZiBK1WAaNoTDEuQpQlysqi7+f+qvFIeYEyrb9EkL8cRvEQM3qsCyBDczqJYjNN1AeF3AXPylM7Ht5bDPXM5piRRnCpaimXbdBBi0EJ2+/NiazS5G47lEj7FpCzRPxKteg+mpywuojtiAa5Fr/wOREliRUdjQxBtrQoQh5altXEcoZZ4ZOKdmJnX+KKsuEId1AHE4ejBCfTLN0Xz4yGKwSq1uoC4JKY1lPUx1/63tfwvJaoK8r9l8Fegn6PCYRm1a4cNAAAAAElFTkSuQmCC"/></span>
            <input type="password" required>
            <label>Location</label>
        </div>

        <div class="input-container">
            <input type="date" required>
            <label></label>
        </div>

        <div class="login-register-container">
            <a href=""  class="register-link"><button class="action-btn" id="saveChanges-booking">Continuee</button></a>
        </div>
    </div> --}}


    <div id="myPopup2-booking" class="popup">
        <div class="popup-content" style="width: 39%">
            {{-- <span class="close" id="closePopup2-booking">&times;</span> --}}
            <a><span class="close-icon" id="closePopup2-booking"><img src="{{ asset('assets/img/icons/close-detail.svg') }}" alt=""></span></a>
            <h4>Verify OTP</h4>
            <img src="{{ asset('assets/img/icons/lock-icon.png') }}" alt="">

            <h5 class="sign-up-text">We've Sent you a 4 Digit Pin On Your Number</h5>

            <div class="edit-phone-cont">
                <div class="Phone-Number"></div>
                <div class="edit-icon mb-4" id="editnumber-booking"><img
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
                <h6 class="resend-otp" id="resendOtpTextBooking">Resend OTP</h6>
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
