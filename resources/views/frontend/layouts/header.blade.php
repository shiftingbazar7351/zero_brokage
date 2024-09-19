<header class="header header-one">
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav" style="justify-content: space-between">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="{{ asset('assets/img/logofinal.webp') }}" class="img-fluid" alt="Logo">
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo-small">
                    <img src="{{ asset('assets/img/logofinal.webp') }}" class="img-fluid" alt="Logo" />
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ route('home') }}" class="menu-logo">
                        <img src="{{ asset('assets/img/logofinal.webp') }}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
                </div>
                <ul class="main-nav">


                    <li class="has-submenu" >
                        <a href="javascript:void(0);" style="color: black;font-weight:bold"><img src="{{ asset('assets/img/icons/get-quotes.svg') }}" alt="" class="suuport-icons">Get Quote
                        </a>

                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void(0);" style="color: black;font-weight:bold"><img src="{{ asset('assets/img/icons/about-us-blue.svg') }}" alt="" class="suuport-icons"> About Us
                        </a>

                    </li>
                    <li class="has-submenu">

                        <a href="{{ route('contact-us') }}" style="color: black;font-weight:bold;"><img src="{{ asset('assets/img/icons/call-blue.svg') }}" alt="" class="suuport-icons"> Support
                        </a>
                    </li>
                    <li><a href="{{ route('admin_page') }}">Admin</a></li>
                </ul>
            </div>
            {{-- @include('frontend.layouts.login-popup') --}}
        </nav>
    </div>
</header>
