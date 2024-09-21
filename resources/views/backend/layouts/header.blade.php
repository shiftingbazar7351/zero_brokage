<div class="header">
    <div class="header-left">
        <a href="index.html" class="logo">
            <img src="{{asset('admin/assets/img/logo.svg')}}" alt="Logo" width="30" height="30">
        </a>
        <a href="index.html" class=" logo-small">
            <img src="{{asset('admin/assets/img/logo-small.svg')}}" alt="Logo" width="30" height="30">
        </a>
    </div>
    <a class="mobile_btn" id="mobile_btn" href="javascript:void(0);">
        <i class="fas fa-align-left"></i>
    </a>
    <div class="header-split">
        <div class="page-headers">
            <a href="{{route('cache.clear')}}" class="btn btn-primary">
                Cache Clear
            </a>
        </div>
        <ul class="nav user-menu">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="viewsite"><i class="fe fe-globe me-2"></i>View Site</a>
            </li>

            <li class="nav-item  has-arrow dropdown-heads ">
                <a href="javascript:void(0);" class="win-maximize">
                    <i class="fe fe-maximize"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle" src="{{asset('admin/assets/img/user.jpg')}}" width="40" alt="Admin">
                        <span class="animate-circle"></span>
                    </span>
                    <span class="user-content">
                        <span class="user-name">{{ Auth::user()->name ??'No Name' }}</span>
                        <span class="user-details">{{ Auth::user()->designation ??'' }}</span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilemenu ">
                        <div class="user-detials">
                            <a href="account.html">
                                <span class="profile-image">
                                    <img src="{{asset('admin/assets/img/user.jpg')}}" alt="img" class="profilesidebar">
                                </span>
                                <span class="profile-content">
                                    <span>{{ Auth::user()->name ??'' }}</span>
                                    {{-- <span><span class="__cf_email__"
                                            data-cfemail="b7fdd8dfd9f7d2cfd6dac7dbd299d4d8da">[email&#160;protected]</span></span>
                                </span> --}}
                                <span>
                                    <span class="__cf_email__">
                                        {{ Auth::user()->email ?? '' }}
                                    </span>
                                </span>

                            </a>
                        </div>
                        <div class="subscription-menu">
                            <ul>
                                <li>
                                    <a href="account-settings.html">Profile</a>
                                </li>
                                {{-- <li>
                                    <a href="localization.html">Settings</a>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="subscription-logout">
                            <a href="{{ route('logout') }}">Log Out</a>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>
