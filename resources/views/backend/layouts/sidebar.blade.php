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

                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fe fe-briefcase"></i>
                        <span>Services</span>
                        <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                    </a>
                    <ul>

                        <li>
                            <a href="{{ route('categories.index') }}"
                                class="{{ Route::currentRouteName() === 'categories.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Category</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('subcategories.index') }}"
                                class="{{ Route::currentRouteName() === 'subcategories.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Sub Category</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('menus.index') }}"
                                class="{{ Route::currentRouteName() === 'menus.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Menu</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('submenu.index') }}"
                                class="{{ Route::currentRouteName() === 'submenu.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Sub-Menu</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('service-detail.index') }}"
                                class="{{ Route::currentRouteName() === 'service-detail.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Service details</span>
                            </a>
                        </li>
                    </ul>

                </li>



                <li class="{{ Route::currentRouteName() === 'enquiry.index' ? 'active' : '' }}{{ Route::currentRouteName() === 'enquiry.show' ? 'active' : '' }}">
                    <a href="{{ route('enquiry.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Enquiry</span>
                    </a>
                </li>


                {{-- <li class="{{ Route::currentRouteName() === 'report.index' ? 'active' : '' }}">
                    <a href="{{ route('report.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Report</span>
                    </a>
                </li> --}}
                <li class="{{ Route::currentRouteName() === 'faq.index' ? 'active' : '' }}">
                    <a href="{{ route('faq.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>FAQ</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'meta.index' ? 'active' : '' }}">
                    <a href="{{ route('meta.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Meta Data</span>
                    </a>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['products.index', 'products.create', 'products.edit']) ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Products</span>
                    </a>
                </li>




                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fe fe-briefcase"></i>
                        <span>Vendors</span>
                        <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                    </a>
                    <ul>

                        <li>
                            <a href="{{ route('vendors.index') }}"
                                class="{{ in_array(Route::currentRouteName(), ['vendors.index', 'vendors.create', 'vendors.edit']) ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Vendor</span>
                            </a>

                        </li>

                        <li>
                            <a href="{{ route('verified.index') }}"
                                class="{{ Route::currentRouteName() === 'verified.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span> Verified</span>
                            </a>
                        </li>


                    </ul>

                </li>

                <li class="{{ Route::currentRouteName() === 'reviews.index' ? 'active' : '' }}">
                    <a href="{{ route('reviews.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Review</span>
                    </a>
                </li>



                <li class="{{ Route::currentRouteName() === 'newsletter.index' ? 'active' : '' }}">
                    <a href="{{ route('newsletter.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Newsletter</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'ipaddress.index' ? 'active' : '' }}">
                    <a href="{{ route('ipaddress.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Ip Address</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'transaction.index' ? 'active' : '' }}">
                    <a href="{{ route('transaction.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'invoice.index' ? 'active' : '' }}">
                    <a href="{{ route('invoice.index') }}">
                        <i class="fe fe-file-text"></i>
                        <span>Invoices</span>
                    </a>
                </li>



            </ul>
        </div>
    </div>
</div>
