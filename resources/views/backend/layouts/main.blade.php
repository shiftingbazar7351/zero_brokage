<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from truelysell.dreamstechnologies.com/html/template/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jul 2024 07:56:36 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Zero Brokage</title>
    <link rel="shortcut icon" href=" {{ asset('admin/assets/img/favicon.png') }} ">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('admin/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/all.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap4.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/feather/feather.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @yield('styles')
</head>

<body>
    <div class="main-wrapper">
        @include('backend.layouts.header')
        @include('backend.layouts.sidebar')
        @yield('content')

    </div>
    <!-- <div id="overlayer">
        <span class="loader">
            <span class="loader-inner"></span>
        </span>
    </div> -->
    <script>
        $(document).ready(function() {
            $('#price, #discount').on('input', function() {
                // Allow only numbers and up to one decimal point
                var value = $(this).val();
                var newValue = value.replace(/[^0-9.]/g,
                ''); // Remove non-numeric characters except for decimal point
                var parts = newValue.split('.');
                if (parts.length > 2) {
                    newValue = parts[0] + '.' + parts[1]; // Remove extra decimal points
                }
                $(this).val(newValue);
            });
        });


        // for no paste in passwords fields
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            if (passwordField) {
                passwordField.addEventListener('paste', function(e) {
                    e.preventDefault();
                });
                passwordField.addEventListener('contextmenu', function(e) {
                    e.preventDefault();
                });
            }
        });
    </script>
    @include('backend.layouts.scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>


</html>
