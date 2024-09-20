<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ ucwords($meta->title ??'') ?? 'Zero Brokage' }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <meta name="description" content="{{ ucwords($meta->description ?? '') }}">
    <meta name="keywords" content="{{ ucwords($meta->keyword ??'') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/aos/aos.css') }} ">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @yield('styles')
</head>

<body class="body-one">
    <div class="main-wrapper" style="background-color: white">
        <style>
            .uppercase {
                text-transform: uppercase;
            }

            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            /* Popup Background */
            .popup {
                display: none;
                /* Hidden by default */
                position: fixed;
                /* Stay in place */
                z-index: 1000;
                /* Sit on top */
                left: 0;
                top: 0;
                width: 100%;
                /* Full width */
                height: 100%;
                /* Full height */
                background-color: rgba(0, 0, 0, 0.5);
                /* Black background with opacity */
                opacity: 0;
                /* Start invisible */
                transition: opacity 0.3s ease;
                /* Smooth transition for opacity */
            }

            /* Popup Content */
            .popup-content {
                background-color: white;
                margin: 11% auto;
                /* 15% from the top and centered */
                padding: 20px;
                border: 1px solid #888;
                width: 42%;
                /* Could be more or less, depending on screen size */
                text-align: center;
                /* Center text */
                /* margin: auto; */
                border-radius: 5px;
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

            .input-div input:focus {
                border-color: #238af8;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }
        </style>

        @include('frontend.layouts.header')
        {{-- <div class="bg-img">
            <img src="{{ asset('assets/img/bg/work-bg-03.png') }}" alt="img" class="bgimg1">
            <img src="{{ asset('assets/img/bg/work-bg-03.png') }}" alt="img" class="bgimg2">
            <img src="{{ asset('assets/img/bg/feature-bg-03.png') }}" alt="img" class="bgimg3">
        </div> --}}

        @yield('content')


        @include('frontend.layouts.footer')


        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>

    </div>

    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;">
            </path>
        </svg>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 1500;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 1500;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 1500;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 1500;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
    </script>

    @include('frontend.layouts.scripts')
    @yield('scripts')
</body>

</html>
