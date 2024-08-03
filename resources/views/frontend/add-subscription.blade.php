<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/add-subscription.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:59:28 GMT -->
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

<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="provider-body">
<div class="main-wrapper">

<div class="header">
<div class="header-left">
<div class="sidebar-logo">
<a href="index.html">
<img src="assets/img/logo.svg" class="img-fluid logo" alt="Logo">
</a>
<a href="index.html">
<img src="assets/img/logo-small.png" class="img-fluid logo-small" alt="Logo">
</a>
</div>
<div class="siderbar-toggle">
<label class="switch" id="toggle_btn">
<input type="checkbox">
<span class="slider round"></span>
</label>
</div>
</div>
<a class="mobile_btns" id="mobile_btns" href="javascript:void(0);">
<i class="fas fa-align-left"></i>
</a>
<div class="header-split">
<div class="page-headers">
<div class="search-bar">
<span><i class="feather-search"></i></span>
<input type="text" placeholder="Search" class="form-control">
</div>
</div>
<ul class="nav user-menu">

<li class="nav-item">
<a href="index.html" class="viewsite"><i class="feather-globe me-2"></i>View Site</a>
</li>
<li class="nav-item dropdown has-arrow dropdown-heads flag-nav">
<a class="nav-link" data-bs-toggle="dropdown" href="#" role="button">
<img src="assets/img/flags/us1.png" alt="Flag" height="20">
</a>
<div class="dropdown-menu dropdown-menu-right">
<a href="javascript:void(0);" class="dropdown-item">
<img src="assets/img/flags/us.png" class="me-2" alt="Flag" height="16"> English
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="assets/img/flags/fr.png" class="me-2" alt="Flag" height="16"> French
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="assets/img/flags/es.png" class="me-2" alt="Flag" height="16"> Spanish
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="assets/img/flags/de.png" class="me-2" alt="Flag" height="16"> German
</a>
</div>
</li>
<li class="nav-item  has-arrow dropdown-heads ">
<a href="#">
<i class="feather-moon"></i>
</a>
</li>

<li class="nav-item  has-arrow dropdown-heads dropdown logged-item noti-nav noti-wrapper">
<a href="#" class="dropdown-toggled nav-link notify-link" data-bs-toggle="dropdown">
<span class="noti-message">1</span>
<img src="assets/img/icons/bell-icon.svg" alt="Bell">
</a>
<div class="dropdown-menu notify-blk notifications">
<div class="topnav-dropdown-header">
<div>
<p class="notification-title">Notifications <span> 3 </span></p>
</div>
<a href="javascript:void(0)" class="clear-noti"><i class="fa-regular fa-circle-check"></i> Mark all as read </a>
</div>
<div class="noti-content">
<ul class="notification-list">
<li class="notification-message">
<a href="notification.html">
<div class="media noti-img d-flex">
<span class="avatar avatar-sm flex-shrink-0">
<img class="avatar-img rounded-circle img-fluid" alt="User Image" src="assets/img/notifications/avatar-01.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details">Lex Murphy left 6 comments on Isla Nublar SOC2 compliance report</p>
<p class="noti-time"><span class="notification-time">1m ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<div class="media noti-img d-flex">
<a href="notification.html">
<span class="avatar avatar-sm flex-shrink-0">
<img class="avatar-img rounded-circle img-fluid" alt="User Image" src="assets/img/notifications/avatar-02.jpg">
</span>
</a>
<div class="media-body flex-grow-1">
<a href="notification.html"><p class="noti-details">Ray Arnold requested access to UNIX directory tree hierarchy</p></a>
<p class="noti-time"><span class="notification-time">1 min</span></p>
<div class="notify-btns">
<button class="btn btn-secondary">Decline</button>
<button class="btn btn-primary">Accept</button>
</div>
</div>
</div>
</li>
<li class="notification-message">
<a href="notification.html">
<div class="media noti-img d-flex">
<span class="avatar avatar-sm flex-shrink-0">
<img class="avatar-img rounded-circle img-fluid" alt="User Image" src="assets/img/notifications/avatar-03.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details">Dennis Nedry commented on Isla Nublar SOC2 compliance report</p>
<p class="noti-time"><span class="notification-time">1m ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="notification.html">
<div class="media noti-img d-flex">
<span class="avatar avatar-sm flex-shrink-0">
<img class="avatar-img rounded-circle img-fluid" alt="User Image" src="assets/img/notifications/avatar-04.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details">John Hammond created Isla Nublar SOC2 compliance report </p>
<p class="noti-time"><span class="notification-time">1m ago</span></p>
</div>
</div>
</a>
</li>
</ul>
</div>
<div class="topnav-dropdown-footer">
<a href="notification.html">View All Notifications <img src="assets/img/icons/arrow-right-01.svg" alt="Arrow"></a>
</div>
</div>
</li>

<li class="nav-item  has-arrow dropdown-heads ">
<a href="#" class="win-maximize">
<i class="feather-maximize"></i>
</a>
</li>

<li class="nav-item dropdown has-arrow account-item">
<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<div class="user-infos">
<span class="user-img">
<img src="assets/img/profiles/avatar-02.jpg" class="rounded-circle" alt="User Image">
</span>
<div class="user-info">
<h6>John Smith</h6>
<p>Demo User</p>
</div>
</div>
</a>
<div class="dropdown-menu dropdown-menu-end emp">
<a class="dropdown-item" href="provider-profile-settings.html">
<i class="feather-user me-2"></i> Profile
</a>
<a class="dropdown-item" href="index.html">
<i class="feather-log-out me-2"></i> Logout
</a>
</div>
</li>

</ul>
</div>
</div>


<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li>
<a href="provider-dashboard.html"><i class="feather-grid"></i> <span>Dashboard</span></a>
</li>
<li>
<a href="provider-services.html"><i class="feather-briefcase"></i> <span>My Services</span></a>
</li>
<li>
<a href="provider-booking.html"><i class="feather-calendar"></i> <span>Bookings </span></a>
</li>
<li>
<a href="provider-payout.html"><i class="feather-credit-card"></i> <span>Payout</span></a>
</li>
<li>
<a href="provider-availability.html"><i class="feather-clock"></i> <span>Availability</span></a>
</li>
<li>
<a href="provider-holiday.html"><i class="feather-calendar"></i> <span>Holidays & Leave</span></a>
</li>
<li>
<a href="provider-coupons.html"><i class="feather-bookmark"></i> <span>Coupons</span></a>
</li>
<li class="active">
<a href="provider-subscription.html"><i class="feather-dollar-sign"></i> <span>Subscription</span></a>
</li>
<li>
<a href="provider-offers.html"><i class="feather-percent"></i> <span>Offers</span></a>
</li>
<li>
<a href="provider-reviews.html"><i class="feather-star"></i> <span>Reviews</span></a>
</li>
<li>
<a href="provider-earnings.html"><i class="feather-dollar-sign"></i> <span>Earnings</span></a>
</li>
<li>
<a href="provider-chat.html"><i class="feather-message-circle"></i> <span>Chat</span></a>
</li>
<li class="submenu">
<a href="provider-settings.html"><i class="feather-settings"></i> <span>Settings</span> <span class="menu-arrow"></span></a>
<ul>
<li>
<a href="provider-appointment-settings.html">Appointment Settings</a>
</li>
<li>
<a href="provider-profile-settings.html">Account Settings</a>
</li>
<li>
<a href="provider-social-profile.html">Social Profiles</a>
</li>
<li>
<a href="provider-security-settings.html">Security Setting</a>
</li>
<li>
<a href="provider-plan.html">Plan & Billings</a>
</li>
<li>
<a href="payment-settings.html">Payment Settings</a>
</li>
<li>
<a href="provider-notifcations.html">Notifications</a>
</li>
<li>
<a href="provider-connected-apps.html">Connected Apps</a>
</li>
<li>
<a href="verification.html">Profile Verification</a>
</li>
</ul>
</li>
<li>
<a href="index.html"><i class="feather-log-out"></i> <span>Logout</span></a>
</li>
</ul>
<div class="menu-bottom">
<div class="menu-user">
<div class="menu-user-img avatar-online">
<img src="assets/img/profiles/avatar-02.jpg" alt="user">
</div>
<div class="menu-user-info">
<h6>John Smith</h6>
<p><a href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="8ce6e3e4e2ffe1e5f8e4cce9f4ede1fce0e9a2efe3e1">[email&#160;protected]</a></p>
</div>
</div>
<a href="#" class="select-set"><i class="feather-settings"></i></a>
<div class="dropdown-menu user-drop" id="dropboxes">
<div class="menu-user">
<div class="menu-user-img avatar-online">
<img src="assets/img/profiles/avatar-02.jpg" alt="user">
</div>
<div class="menu-user-info">
<h6>John Smith</h6>
<p>Active</p>
</div>
</div>
<div class="set-user">
<p>Set as Away</p>
<div class="status-toggle">
<input type="checkbox" id="active-user" class="check">
<label for="active-user" class="checktoggle">checkbox</label>
</div>
</div>
<ul class="set-menu">
<li>
<a href="provider-security-settings.html">
<i class="feather-settings me-2"></i> Settings
</a>
</li>
<li>
<a href="provider-profile-settings.html">
<i class="feather-user me-2"></i> Your Account
</a>
</li>
<li>
<a href="javascript:void(0)">
<i class="feather-check-circle me-2"></i> Identity Verification
</a>
</li>
</ul>
<ul class="help-menu">
<li>
<a href="#">
Help Center
</a>
</li>
<li>
<a href="terms-condition.html">
Terms of Condition
</a>
</li>
<li>
<a href="privacy-policy.html">
Privacy Policy
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="page-wrapper">
<div class="content container-fluid">
<div class="row">

<div class="col-md-7">
<div class="payment-methods">
<h6>Payments Methods</h6>
<label class="custom_radio">
<input type="radio" name="payment" class="payment-card" checked>
<span class="checkmark"></span>
Debit or Credit Card
</label>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="col-form-label">Name on Card</label>
<input class="form-control" type="text" placeholder="John Smith">
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label class="col-form-label">Card Number</label>
<input class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" type="text">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label class="col-form-label">Expire Month</label>
<input class="form-control" placeholder="MM" type="text">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label class="col-form-label">Expire Year</label>
<input class="form-control" placeholder="YYYY" type="text">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label class="col-form-label">Expire Year</label>
<input class="form-control" placeholder="****" type="text">
</div>
</div>
</div>
<label class="custom_radio">
<input type="radio" name="payment" class="payment-card">
<span class="checkmark"></span>
Paypal
</label>
<label class="custom_radio">
<input type="radio" name="payment" class="payment-card">
<span class="checkmark"></span>
Bank Transfer
</label>
<h6>Billing Address <span>(Optional)</span></h6>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="col-form-label">Company Name</label>
<input class="form-control" type="text" placeholder="Enter company Name">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-form-label">Address</label>
<input class="form-control" placeholder="Enter Your Address" type="text">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-form-label">City</label>
<input class="form-control" placeholder="Enter your city" type="text">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-form-label">Zipcode</label>
<input class="form-control" placeholder="Enter Your Zipcode" type="text">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-form-label">Country</label>
<input class="form-control" placeholder="Enter your Country" type="text">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-form-label">VAT Number</label>
<input class="form-control" placeholder="Enter Your VAT Nymber" type="text">
</div>
</div>
</div>
</div>
</div>


<div class="col-md-5">
<div class="payment-subscribe">
<h6>Subscription Details</h6>
<div class="subscribe-box">
<ul>
<li>Plan Name: <span class="me-0">Professional <a href="#" class="ms-3">Edit</a></span></li>
<li>Plan Amount: <span>$89.00</span></li>
<li>Tax: <span>$10.00</span></li>
<li>Plan Amount: <span>$99.00</span></li>
</ul>
</div>
<a href="provider-dashboard.html" class="btn btn-primary">Proceed to Pay $99.00</a>
<label class="custom_check mb-0">
<input type="checkbox" name="rememberme" class="rememberme" checked>
<span class="checkmark"></span>By confirming you to agree Terms & Privacy you will be change $60
every month until you cancel your subscription.
</label>
</div>
</div>

</div>
</div>
</div>

<div class="mouse-cursor cursor-outer"></div>
<div class="mouse-cursor cursor-inner"></div>

</div>

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.7.0.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>

<script src="assets/js/bootstrap.bundle.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>

<script src="assets/js/feather.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>

<script src="assets/plugins/select2/js/select2.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>

<script src="assets/js/moment.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>

<script src="assets/plugins/datatables/jquery.dataTables.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>
<script src="assets/plugins/datatables/datatables.min.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>

<script src="assets/js/script.js" type="2f60cd7be6f3d20c68a40264-text/javascript"></script>
<script src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="2f60cd7be6f3d20c68a40264-|49" defer></script></body>

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/add-subscription.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:59:28 GMT -->
</html>