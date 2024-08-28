<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <a href="#">
                <img src="{{ asset('admin/assets/img/logo.svg') }}" class="img-fluid logo" alt="Logo">
            </a>
            <a href="#">
                <img src="{{ asset('admin/assets/img/logo-small.svg') }}" class="img-fluid logo-small" alt="Logo">
            </a>
        </div>

    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title m-0">
                    <h6>Home</h6>
                </li>
                <li class ="{{ Route::currentRouteName() === 'admin_page' ? 'active' : '' }}">
                    <a href="{{ route('admin_page') }}"><i class="fe fe-grid"></i> <span>Dashboard</span></a>
                </li>

                <li class="menu-title">
                    <h6>Services</h6>
                </li>

                <li class="{{ Route::currentRouteName() === 'categories.index' ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Category</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'subcategories.index' ? 'active' : '' }}">
                    <a href="{{ route('subcategories.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Sub Category</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'menus.index' ? 'active' : '' }}">
                    <a href="{{ route('menus.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Menu</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'submenu.index' ? 'active' : '' }}">
                    <a href="{{ route('submenu.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Sub-menu</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'service-detail.index' ? 'active' : '' }}">
                    <a href="{{ route('service-detail.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Service details</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'enquiry.index' ? 'active' : '' }}">
                    <a href="{{ route('enquiry.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Enquiry</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() === 'faq.index' ? 'active' : '' }}">
                    <a href="{{ route('faq.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>FAQ</span>
                    </a>
                </li>


                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fe fe-briefcase"></i>
                        <span>Meta</span>
                        <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('meta.index') }}" class="{{ Route::currentRouteName() === 'meta.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Meta Description</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('meta-url.index') }}" class="{{ Route::currentRouteName() === 'meta-url.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Meta Url</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('meta-title.index') }}" class="{{ Route::currentRouteName() === 'meta-title.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Meta Title</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="vendor">
                    <a href="javascript:void(0);"><i class="fe fe-briefcase"></i>
                        <span>Vendors</span>
                        <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('vendors.index') }}" class="{{ Route::currentRouteName() === 'vendors.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fe fe-file-text"></i>
                                <span>Approved</span>
                            </a>
                        </li>
                     
                    </ul>
                </li>

                <li class="review">
                    <a href="javascript:void(0);"><i class="fe fe-briefcase"></i>
                        <span>Review</span>
                        <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('reviews.index') }}" class="{{ Route::currentRouteName() === 'reviews.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Services</span>
                            </a>
                        </li>
                     
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
