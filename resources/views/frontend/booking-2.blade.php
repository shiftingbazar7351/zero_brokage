<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/booking-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:20 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Truelysell | Template</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/feather.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="main-wrapper ">

<div class="modal custom-modal reshchedule-modal" data-bs-backdrop="static" id="reschedule-book-modal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content doctor-profile">
<div class="modal-body">
<div class="hide-show" id="show-first">
<div class="row">
<div class="col-lg-3 d-flex">
<div class="modal-active-dots text-center w-100">
<ul>
<li class="active-dot active" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Date & Time"></li>
<li class="active-dot"></li>
<li class="active-dot"></li>
<li class="active-dot"></li>
</ul>
<div class="calender-modal">
<img src="assets/img/icons/modal-calender-icon.svg" alt="calender Icon">
<h6>Date & time</h6>
<p>Select date & time to schedule appointment</p>
</div>
<div class="call-help">
<h6>Questions?
<span>Call 321 546 8764 for help</span>
</h6>
</div>
</div>
</div>
<div class="col-lg-5 d-flex">
<div class="main-booking-form w-100">
<div class="rechedule-calender">
<div class="book-title">
<h5>Select Date & Time</h5>
</div>
<div id="datetimepickershow"></div>
<div class="pick-slot">
<h6>Pick a Slot for <span> July 18</span></h6>
<div class="token-slot">
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">08:00 am</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">08:30 am</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">09:00 am</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">09:30 am</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">10:00 am</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">10:30 am</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">11:00 am</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment" checked>
<span class="visit-rsn">11:30 am</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">12:00 pm</span>
</label>
</div>
<div class="form-check-inline visits me-0">
<label class="visit-btns">
<input type="radio" class="form-check-input" name="appintment">
<span class="visit-rsn">12:30 pm</span>
</label>
</div>
</div>
</div>
</div>
<div class="field-bottom-btns select-timing justify-content-between">
<div class="field-btns">
<button class="btn btn-primary prev_btnn disabled" type="button"><i class="fa-solid fa-arrow-left"></i>Prev</button>
</div>
<div class="field-btns">
<button class="btn btn-primary next_btnn" type="button">Next <i class="fa-solid fa-arrow-right"></i></button>
</div>
</div>
</div>
</div>
<div class="col-lg-4 d-flex">
<div class="card booking-summary-card">
<div class="card-body">
<div class="sub-title">
<h5>Booking Summary</h5>
</div>
<div class="appointment-details">
<ul>
<li>
<div class="detail-list">
<h5>Appointment date & time</h5>
<h6 class="date-red">July 18, 11:30 am</h6>
</div>
</li>
<li>
<div class="detail-list">
<h5>Selected Service</h5>
<h6>Computer Services</h6>
</div>
<span>$40.00</span>
</li>
<li>
<div class="detail-list">
<h5>Additional Service</h5>
<h6>Changing Switch Boards</h6>
</div>
<span>$10.00</span>
</li>
</ul>
</div>
</div>
<div class="card-footer">
<ul>
<li>
<h6>Sub Total</h6>
<span>$257.00</span>
</li>
<li>
<h6>Tax @ 12.5%</h6>
<span>$5.36</span>
</li>
<li class="total-amount">
<h6>Total</h6>
<span>$251.36</span>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="hide-show">
<div class="row">
<div class="col-lg-3">
<div class="modal-active-dots text-center">
<ul>
<li class="active-dot activated" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Date & Time"></li>
<li class="active-dot active" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Information"></li>
<li class="active-dot"></li>
<li class="active-dot"></li>
</ul>
<div class="calender-modal">
<img src="assets/img/icons/booking-info-icon.svg" alt="calender Icon">
<h6>Enter Information</h6>
<p>Ad your information for the appointment Booking</p>
</div>
<div class="call-help">
<h6>Questions?
<span>Call 321 546 8764 for help</span>
</h6>
</div>
</div>
</div>
<div class="col-lg-5 d-flex">
<div class="main-booking-form d-flex w-100">
<div class="rechedule-calender h-100">
<div class="book-title">
<h5>Enter Information</h5>
</div>
<div class="card booking-info-tab h-100">
<ul class="nav nav-pills" id="pills-tab" role="tablist">
<li class="nav-item" role="presentation">
<button class="nav-link active" id="pills-guest-tab" data-bs-toggle="pill" data-bs-target="#pills-guest" type="button" role="tab" aria-controls="pills-guest" aria-selected="true">Book as Guest</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-user-tab" data-bs-toggle="pill" data-bs-target="#pills-user" type="button" role="tab" aria-controls="pills-user" aria-selected="false">Already have an account?</button>
</li>
</ul>
<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-guest" role="tabpanel" aria-labelledby="pills-guest-tab">
<form>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" placeholder="Name">
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="email" class="form-control" placeholder="Email Address">
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" placeholder="Phone Number">
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" placeholder="Address">
</div>
</div>
<div class="col-md-12">
<div class="guest-address d-flex">
<div class="guest-country w-100 me-2">
<div class="form-group">
<select class="select">
<option>Country</option>
<option>US</option>
<option>Kuwait</option>
</select>
</div>
</div>
<div class="guest-city w-100">
<div class="form-group">
<input type="text" class="form-control" placeholder="City">
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="guest-state-pin d-flex">
<div class="guest-state w-100 me-2">
<div class="form-group">
<input type="text" class="form-control" placeholder="State">
</div>
</div>
<div class="guest-pin w-100">
<div class="form-group">
<input type="text" class="form-control" placeholder="Zipcode">
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="form-group mb-0">
<textarea class="form-control" placeholder="Comments"></textarea>
</div>
</div>
</div>
</form>
</div>
<div class="tab-pane fade guest-user-tab" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
<form>
<div class="sub-title">
<h5>Login</h5>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="email" class="form-control" placeholder="Email Address">
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="password" class="form-control" placeholder="Password">
</div>
</div>
<div class="get-new-password">
<p>Forgot Password ? <a href> Click to Get Link</a></p>
</div>
<div class="form-group">
<button class="btn btn-primary w-100">Login</button>
</div>
</div>
<div class="join-user">
<a href="#"><i class="fa-solid fa-user me-2"></i>Join as a User</a>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="field-bottom-btns select-timing justify-content-between">
<div class="field-btns">
<button class="btn btn-primary prev_btnn" type="button"><i class="fa-solid fa-arrow-left"></i>Prev</button>
</div>
<div class="field-btns">
<button class="btn btn-primary next_btnn" type="button">Next <i class="fa-solid fa-arrow-right"></i></button>
</div>
</div>
</div>
</div>
<div class="col-lg-4 d-flex">
<div class="card booking-summary-card">
<div class="card-body">
<div class="sub-title">
<h5>Booking Summary</h5>
</div>
<div class="appointment-details">
<ul>
<li>
<div class="detail-list">
<h5>Appointment date & time</h5>
<h6 class="date-red">July 18, 11:30 am</h6>
</div>
</li>
<li>
<div class="detail-list">
<h5>Selected Service</h5>
<h6>Computer Services</h6>
</div>
<span>$40.00</span>
</li>
<li>
<div class="detail-list">
<h5>Additional Service</h5>
<h6>Changing Switch Boards</h6>
</div>
<span>$10.00</span>
</li>
</ul>
</div>
</div>
<div class="card-footer">
<ul>
<li>
<h6>Sub Total</h6>
<span>$257.00</span>
</li>
<li>
<h6>Tax @ 12.5%</h6>
<span>$5.36</span>
</li>
<li class="total-amount">
<h6>Total</h6>
<span>$251.36</span>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="hide-show">
<div class="row">
<div class="col-lg-3">
<div class="modal-active-dots text-center">
<ul>
<li class="active-dot activated" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Date & Time"></li>
<li class="active-dot activated" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Information"></li>
<li class="active-dot active" data-bs-toggle="tooltip" data-bs-placement="top" title="Payment Gateway"></li>
<li class="active-dot"></li>
</ul>
<div class="calender-modal">
<img src="assets/img/icons/payment-gateway-icon.svg" alt="calender Icon">
<h6>Payment Gateway</h6>
<p>Select your payment type to pay for appointment</p>
</div>
<div class="call-help">
<h6>Questions?
<span>Call 321 546 8764 for help</span>
</h6>
</div>
</div>
</div>
<div class="col-lg-5 d-flex">
<div class="main-booking-form d-flex w-100">
<div class="rechedule-calender h-100">
<div class="book-title">
<h5>Payment Gateway</h5>
</div>
<div class="card booking-info-tab h-100">
<div class="payment-card">
<div class="payment-head">
<div class="payment-title">
<label class="custom_radio">
<input type="radio" name="payment" class="card-payment" checked>
</label>
<h6>Paypal</h6>
</div>
<div class="card-icon">
<img src="assets/img/icons/paypal-icon.svg" alt="image">
</div>
</div>
</div>
<div class="payment-card payment-bg">
<div class="payment-head">
<div class="payment-title">
<label class="custom_radio">
<input type="radio" name="payment" class="card-payment">
</label>
<h6>Credit / Debit Card</h6>
</div>
<div class="card-icon">
<img src="assets/img/card-icon-1.png" alt="image">
</div>
</div>
</div>
<div class="payment-card">
<div class="payment-head">
<div class="payment-title">
<label class="custom_radio credit-card-option">
<input type="radio" name="payment" class="card-payment">
</label>
<h6>Cash on Delivery</h6>
</div>
<div class="card-icon">
<img src="assets/img/card-icon-2.png" alt="image">
</div>
</div>
</div>
</div>
</div>
<div class="field-bottom-btns select-timing justify-content-between">
<div class="field-btns">
<button class="btn btn-primary prev_btnn" type="button"><i class="fa-solid fa-arrow-left"></i>Prev</button>
</div>
<div class="field-btns">
<button class="btn btn-primary next_btnn submit-btn" type="button">Submit <i class="fa-solid fa-arrow-right"></i></button>
</div>
</div>
</div>
</div>
<div class="col-lg-4 d-flex">
<div class="card booking-summary-card">
<div class="card-body">
<div class="sub-title">
<h5>Booking Summary</h5>
</div>
<div class="appointment-details">
<ul>
<li class="droped-item">
<div class="detail-list">
<h5>Customer Details <i class="fa-solid fa-circle-info"></i></h5>
<h6 class="date-red">Testuser</h6>
</div>
<ul class="customer-detail-list">
<li>
<h6>Email Address</h6>
<p><a href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="442e2b2c2a04213c25293428216a272b29">[email&#160;protected]</a></p>
</li>
<li>
<h6>Phone Number</h6>
<p>+1 63993 35556</p>
</li>
<li>
<h6>Address</h6>
<p>578 Fleming StreetMontgomery, AL 36104</p>
</li>
<li>
<h6>Comments</h6>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</li>
</ul>
</li>
<li>
<div class="detail-list">
<h5>Appointment date & time</h5>
<h6 class="date-red">July 18, 11:30 am</h6>
</div>
</li>
<li>
<div class="detail-list">
<h5>Selected Service</h5>
<h6>Computer Services</h6>
</div>
<span>$40.00</span>
</li>
<li>
<div class="detail-list">
<h5>Additional Service</h5>
<h6>Changing Switch Boards</h6>
</div>
<span>$10.00</span>
</li>
</ul>
</div>
</div>
<div class="card-footer">
<ul>
<li>
<h6>Sub Total</h6>
<span>$257.00</span>
</li>
<li>
<h6>Tax @ 12.5%</h6>
<span>$5.36</span>
</li>
<li class="total-amount">
<h6>Total</h6>
<span>$251.36</span>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="hide-show">
<div class="row">
<div class="col-lg-3">
<div class="modal-active-dots text-center">
<ul>
<li class="active-dot activated" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top"></li>
<li class="active-dot activated" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Information"></li>
<li class="active-dot activated" data-bs-toggle="tooltip" data-bs-placement="top" title="Payment Gateway"></li>
<li class="active-dot active" data-bs-toggle="tooltip" data-bs-placement="top" title="Payment Gateway"></li>
</ul>
<div class="calender-modal">
<img src="assets/img/icons/payment-gateway-icon.svg" alt="calender Icon">
<h6>Payment Gateway</h6>
<p>Select your payment type to pay for appointment</p>
</div>
<div class="call-help">
<h6>Questions?
<span>Call 321 546 8764 for help</span>
</h6>
</div>
</div>
</div>
<div class="col-lg-5 d-flex">
<div class="main-booking-form d-flex w-100">
<div class="rechedule-calender h-100">
<div class="book-title">
<h5>Payment Gateway</h5>
</div>
<div class="card booking-info-tab h-100 justify-content-between">
<div>
<div class="sub-title">
<h5>Saved Cards</h5>
</div>
<div class="card-pay-save">
<div class="payment-card save-cards">
<div class="payment-head">
<div class="payment-title">
<label class="custom_radio">
<input type="radio" name="payments" class checked>
<span class="checkmark"></span>
</label>
<img src="assets/img/icons/saved-card-icon.svg" alt="image">
<h6>Mastercard</h6>
</div>
<div class="card-number">
<span> ********* 1234</span>
</div>
</div>
</div>
</div>
<div class="add-more-card-details">
<div class="add-more-card">
<a href="javascript:void(0);"><i class="fa-solid fa-circle-plus"></i> Add new card</a>
</div>
<div class="hide-cards-group">
<div class="form-group">
<input type="text" class="form-control" placeholder="Name On Card">
</div>
<div class="form-group">
<input type="number" class="form-control" placeholder="Card Number">
</div>
<div class="card-details d-flex">
<div class="expiry-date w-100 me-2">
<div class="form-group">
<input type="text" class="form-control" placeholder="Expiry Date">
</div>
</div>
<div class="cvv-num w-100">
<div class="form-group">
<input type="text" class="form-control" placeholder="CVV Number">
</div>
</div>
</div>
<div class="save-later">
<label class="custom_check">
<input type="checkbox" name="rememberme" class="rememberme">
<span class="checkmark"></span>Save for later
</label>
</div>
</div>
</div>
<div class="secure-transaction">
<span><i class="fa-solid fa-lock"></i></span>
<p>All transactions are secure and encrypted. Credit card information is never stored.</p>
</div>
</div>
<div class="total-price">
<h5>Total Booking Price : <span class="price-value"> $251.36</span></h5>
</div>
</div>
</div>
<div class="field-bottom-btns select-timing justify-content-between">
<div class="field-btns">
<button class="btn btn-primary prev_btnn" type="button"><i class="fa-solid fa-arrow-left"></i>Prev</button>
</div>
<div class="field-btns">
<button class="btn btn-primary next_btnn submit-btn" type="button">Next<i class="fa-solid fa-arrow-right"></i></button>
</div>
</div>
</div>
</div>
<div class="col-lg-4 d-flex">
<div class="card booking-summary-card">
<div class="card-body">
<div class="sub-title">
<h5>Booking Summary</h5>
</div>
<div class="appointment-details">
<ul>
<li class="droped-item">
<div class="detail-list">
<h5>Customer Details <i class="fa-solid fa-circle-info"></i></h5>
<h6 class="date-red">Testuser</h6>
</div>
<ul class="customer-detail-list">
<li>
<h6>Email Address</h6>
<p><a href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c7ada8afa987a2bfa6aab7aba2e9a4a8aa">[email&#160;protected]</a></p>
</li>
<li>
<h6>Phone Number</h6>
<p>+1 63993 35556</p>
</li>
<li>
<h6>Address</h6>
<p>578 Fleming StreetMontgomery, AL 36104</p>
</li>
<li>
<h6>Comments</h6>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</li>
</ul>
</li>
<li>
<div class="detail-list">
<h5>Appointment date & time</h5>
<h6 class="date-red">July 18, 11:30 am</h6>
</div>
</li>
<li>
<div class="detail-list">
<h5>Selected Service</h5>
<h6>Computer Services</h6>
</div>
<span>$40.00</span>
</li>
<li>
<div class="detail-list">
<h5>Additional Service</h5>
<h6>Changing Switch Boards</h6>
</div>
<span>$10.00</span>
</li>
</ul>
</div>
</div>
<div class="card-footer">
<ul>
<li>
<h6>Sub Total</h6>
<span>$257.00</span>
</li>
<li>
<h6>Tax @ 12.5%</h6>
<span>$5.36</span>
</li>
<li class="total-amount">
<h6>Total</h6>
<span>$251.36</span>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="hide-show">
<div class="row">
<div class="col-xl-4 col-lg-3">
<div class="modal-active-dots text-center">
<div class="calender-modal">
<img src="assets/img/icons/appointment-confirm-icon.svg" alt="calender Icon">
<h6>Confirm Order</h6>
<p>Handles different career a accordingly, after a of the for found customary feedback by happiness</p>
</div>
<div class="call-help">
<h6>Questions?
<span>Call 321 546 8764 for help</span>
</h6>
</div>
</div>
</div>
<div class="col-xl-8 col-lg-9 d-flex">
<div class="main-booking-form d-flex w-100">
<div class="rechedule-calender h-100">
<div class="book-title">
<h5>Confirmation</h5>
</div>
<div class="card booking-confirmation-info h-100 mb-0">
<div class="card-body">
<div class="appointment-details">
<div class="details-head">
<h6>Appointment Details</h6>
<span>UBID-52</span>
</div>
<div class="add-calender">
<a href><span><i class="fa-solid fa-calendar-days"></i></span>Add to Calender</a>
</div>
</div>
<div class="confirmation-product-card">
<div class="row align-items-center">
<div class="col-md-6">
<div class="service-item">
<span>
<img src="assets/img/product-confirm-img.jpg" class="img-fluid" alt="image">
</span>
<div class="product-info">
<h5>Computer Services</h5>
<span class="duration">Duration : 30 Min</span>
<span class="date-time">July 18, 11:30 am - 12:30 pm </span>
</div>
</div>
</div>
<div class="col-md-4">
<div class="product-info service-additional">
<h6>Additional Service</h6>
<span>Changing Switch Boards</span>
</div>
</div>
<div class="col-md-2">
<div class="product-info service-cost">
<h6>Total Paid</h6>
<span>$400</span>
</div>
</div>
</div>
</div>
<div class="customer-provider">
<div class="row">
<div class="col-md-6">
<div class="name-card">
<h6>Customer</h6>
<div class="profile-detail">
<span class="profile-pic"><img src="assets/img/profiles/avatar-21.jpg" class="img-fluid" alt="image"></span>
<div class="email-name">
<span>Adrian</span>
<p><a href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c9bdacbabdbcbaacbb89acb1a8a4b9a5ace7aaa6a4">[email&#160;protected]</a></p>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="name-card">
<h6>Provider</h6>
<div class="profile-detail">
<span class="profile-pic"><img src="assets/img/profiles/avatar-22.jpg" class="img-fluid" alt="image"></span>
<div class="email-name">
<span>Harrris</span>
<a href>Learn More</a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="payed-method">
<span>Payment Method : Debit card</span>
</div>
<div class="field-bottom-btns select-timing justify-content-end">
<div class="field-btns">
<button class="btn btn-primary next_btn submit-btn" type="button" data-bs-toggle="modal" data-bs-target="#successmodal">Confirm Order <i class="fa-solid fa-arrow-right"></i></button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="modal fade add-service-modal" data-bs-backdrop="static" id="successmodal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-body">
<span>
<i class="fa-regular fa-circle-check"></i>
</span>
<h3>Success</h3>
<p>Booking has been successfully Confirmed on</p>
<div class="booking-date-time">
<i class="fa-regular fa-clock"> </i> 25 July 2023, 19:00 pm
</div>
<div class="popup-btn">
<a href="customer-dashboard.html" class="btn btn-primary">Go to Dashboard <i class="fa-solid fa-arrow-right"></i></a>
</div>
</div>
</div>
</div>
</div>


<div class="mouse-cursor cursor-outer"></div>
<div class="mouse-cursor cursor-inner"></div>

</div>

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.7.0.min.js" type="cb9ec1744de4558c42168023-text/javascript"></script>

<script src="assets/js/bootstrap.bundle.min.js" type="cb9ec1744de4558c42168023-text/javascript"></script>

<script src="assets/js/feather.min.js" type="cb9ec1744de4558c42168023-text/javascript"></script>

<script src="assets/plugins/select2/js/select2.min.js" type="cb9ec1744de4558c42168023-text/javascript"></script>

<script src="assets/js/moment.min.js" type="cb9ec1744de4558c42168023-text/javascript"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js" type="cb9ec1744de4558c42168023-text/javascript"></script>

<script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js" type="cb9ec1744de4558c42168023-text/javascript"></script>
<script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js" type="cb9ec1744de4558c42168023-text/javascript"></script>

<script src="assets/js/script.js" type="cb9ec1744de4558c42168023-text/javascript"></script>
<script src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="cb9ec1744de4558c42168023-|49" defer></script></body>

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/booking-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:20 GMT -->
</html>