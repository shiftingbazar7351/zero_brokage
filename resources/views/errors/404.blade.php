<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/error-404.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:12 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Truelysell | Template</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="mt-0">

    <div class="main-wrapper error-page">
        <div class="bg-img">
            <img src="{{ asset('assets/img/bg/work-bg-03.png') }}" alt="img" class="bgimg1">
            <img src="{{ asset('assets/img/bg/work-bg-03.png') }}" alt="img" class="bgimg2">
            <img src="{{ asset('assets/img/bg/feature-bg-03.png') }}" alt="img" class="bgimg3">
        </div>
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="error-wrap">
                            <div class="error-img">
                                <img class="img-fluid" src="{{ asset('assets/img/error-404.png') }}" alt="img">
                            </div>
                            <h2>404 Oops! Page Not Found</h2>
                            <p>This page doesn't exist or was removed! We suggest you back to home.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary"><i
                                    class="feather-arrow-left-circle me-2"></i>Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
</body>

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/error-404.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:12 GMT -->

</html>
