<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    /* Popup Background */
    .popup {
        display: none;
        position: fixed;
        z-index: 9999999999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Popup Content */
    .popup-content {
        background-color: #fcfcf5;
        margin: 11% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 42%;
        /* Could be more or less, depending on screen size */
        text-align: center;
        /* Center text */
        /* margin: auto; */
        border-radius: 10px;
        /* Rounded corners */
        transform: translateY(-30px);
        /* Start slightly above */
        transition: transform 0.3s ease;
        /* Smooth transition for movement */
    }

    .popup.show {
        display: block;
        /* Show the popup */
        opacity: 1;
        /* Make it visible */
    }

    .popup.show .popup-content {
        transform: translateY(0);
        /* Move to original position */
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
        /* Bootstrap primary color */
        color: white;
        border: none;
        padding: 10px 15px;
        margin: 5px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: #1573d6;
        /* Darker blue on hover */
    }
    .main-div{
    display: flex;
    justify-content: center;
    align-items: center;
    /* border: 2px solid rgb(85, 184, 60); */
    margin: 5px;
    gap: 8px;
    margin: auto;
}
.input-div{
    width: 10%;
    /* border-radius: 2px solid rgb(18, 163, 107); */
    /* background-color: blue; */
    display: flex;
    gap: 10px;
}
.input-div input{
    width: 100%;
    text-align: center;
    padding: 5px;
    font-size: 22px;
    border-radius: 15px;
    gap: 4px;
}
@media only screen and (max-width: 991.98px) {
    .input-div{
    width: 14%;
    }
}
@media only screen and (max-width: 480.98px){
    .input-div{
    width: 14%;
    }
}
</style>

<ul class="nav header-navbar-rht">
    <li class="nav-item">
        <button id="openPopup" class="btn">Login</button>
        <div id="myPopup" class="popup">
            <div class="popup-content">
                <span class="close" id="closePopup">&times;</span>
                <h3>Login/Sign up</h3>
                <img src="{{ asset('assets/img/icons/signup.png') }}" alt="">
                <h5 class="sign-up-text mb-4">Enter your Mobile Number</h5>
                <input type="tel" id="phoneNumberInput" class="phone-number-field" onkeyup="validateNum(this)"
                    maxlength="10" placeholder="Enter Mobile Number" required>
                <div id="res"></div>
                <button id="saveChanges" class="btn" onclick="startCountdown(60)">Continue</button>
                <!-- <button id="closePopupBtn" class="btn">Close</button> -->
                <div class="term-condition">
                    <input type="checkbox" class="checkbox" id="checkbox-login">
                    <p>By Continuing, you agree to our <span class="term">Term and Condition</span>
                    </p>
                </div>
            </div>
        </div>
        <div id="myPopup2" class="popup">
            <div class="popup-content">
                <span class="close" id="closePopup2">&times;</span>
                <h3>Verify OTP</h3>
                <img src="{{ asset('assets/img/icons/lock-icon.png') }}" alt="">

                <h5 class="sign-up-text">We've Sent you a 4 Digit Pin On Your Number</h5>

                <div class="edit-phone-cont">
                    <div class="Phone-Number">8303361853</div>
                    <div class="edit-icon" id="editnumber"><img src="{{ asset('assets/img/icons/edit-icon.svg') }}"
                            alt="">Edit</div>
                </div>
                <div class="main-div">
                    <div class="input-div"><input type="text" value="4"  maxlength="1"/></div>

                    <div class="input-div"><input type="text" value="4" maxlength="1"/></div>

                    <div class="input-div"><input type="text" value="4" maxlength="1"/></div>

                    <div class="input-div"><input type="text" value="4" maxlength="1"/></div>
                  </div>
                <div class="resend">
                    <div class="get-otp">Don't get OTP?</div>
                    <div id="counter"></div>
                </div>
                <div class="resend-container">
                    <h5 class="resend-otp" id="resendOtpText">Resend OTP</h5>
                    <p class="whatsapp-otp" id="otpOnWhatsapp">Get OTP on <img
                            src="{{ asset('assets/img/icons/icons8-whatsapp.gif') }}" alt=""></p>
                </div>
                <button type="button" class="btn btn-primary btn-lg" id="verify-otp">Verify
                    OTP</button>

                <!-- <button id="closePopupBtn" class="btn">Close</button> -->
                <div class="term-condition">
                    <input type="checkbox" class="checkbox">
                    <p>By Continuing, you agree to our <span class="term">Term and Condition</span>
                    </p>
                </div>
            </div>
        </div>
</ul>

<script src="{{ asset('assets/js/popup.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    const inputtest = document.querySelector("#phoneNumberInput");
    window.intlTelInput(inputtest, {
        initialCountry: "in",
        separateDialCode: true
    });
</script>
