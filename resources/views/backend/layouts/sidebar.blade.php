<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <a href="{{ route('admin_page') }}">
                <img src="{{ asset('assets/img/logofinal.webp') }}" class="img-fluid logo rounded" alt="Logo"
                    style="background-color: white">
            </a>
            <a href="{{ route('admin_page') }}">
                <img src="{{ asset('assets/img/logofinal.webp') }}" class="img-fluid logo-small" alt="Logo">
            </a>
        </div>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="mb-4">
                <li class="menu-title m-0">
                    <h6>Home</h6>
                </li>
                <li class ="{{ Route::currentRouteName() === 'admin_page' ? 'active' : '' }}">
                    <a href="{{ route('admin_page') }}"><i class="fe fe-grid"></i> <span>Dashboard</span></a>
                </li>

                @can(['permission-list'])
                    <li class ="{{ Route::currentRouteName() === 'role.permission.list' ? 'active' : '' }}">
                        <a href="{{ route('role.permission.list') }}"><i class="fa fa-flag" aria-hidden="true"></i> <span>Assign
                                Permission</span></a>
                    </li>
                @endcan
                @can(['user-list'])
                    <li class ="{{ Route::currentRouteName() === 'user.index' ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>Users</span></a>
                    </li>
                @endcan
                @canany(['categories-list', 'subcategory-list', 'menus-list', 'submenu-list', 'india-services-list',
                    'service-detail-list'])
                    <li class="submenu">
                        <a href="javascript:void(0);"><i class="fe fe-briefcase"></i>
                            <span>Services</span>
                            <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                        </a>
                        <ul>

                            @can(['categories-list'])
                                <li>
                                    <a href="{{ route('categories.index') }}"
                                        class="{{ Route::currentRouteName() === 'categories.index' ? 'active' : '' }}">
                                        <i class="fe fe-file-text"></i>
                                        <span>Category</span>
                                    </a>
                                </li>
                            @endcan
                            @can(['subcategory-list'])
                                <li>
                                    <a href="{{ route('subcategories.index') }}"
                                        class="{{ Route::currentRouteName() === 'subcategories.index' ? 'active' : '' }}">
                                        <i class="fe fe-file-text"></i>
                                        <span>Sub Category</span>
                                    </a>
                                </li>
                            @endcan
                            @can(['menus-list'])
                                <li>
                                    <a href="{{ route('menus.index') }}"
                                        class="{{ Route::currentRouteName() === 'menus.index' ? 'active' : '' }}">
                                        <i class="fe fe-file-text"></i>
                                        <span>Menu</span>
                                    </a>
                                </li>
                            @endcan
                            @can(['submenu-list'])
                                <li>
                                    <a href="{{ route('submenu.index') }}"
                                        class="{{ Route::currentRouteName() === 'submenu.index' ? 'active' : '' }}">
                                        <i class="fe fe-file-text"></i>
                                        <span>Sub-Menu</span>
                                    </a>
                                </li>
                            @endcan
                            {{-- ---------------------This Route currently not in use --------------------------------------------------}}
                            {{-- @can(['service-detail-list'])
                                <li>
                                    <a href="{{ route('service-detail.index') }}"
                                        class="{{ Route::currentRouteName() === 'service-detail.index' ? 'active' : '' }}">
                                        <i class="fe fe-file-text"></i>
                                        <span>Service details</span>
                                    </a>
                                </li>
                            @endcan --}}
                            {{-- ----------------------------------------------------------------------------------------------------- --}}
                            @can(['india-services-list'])
                                <li>
                                    <a href="{{ route('india-services.index') }}"
                                        class="{{ Route::currentRouteName() === 'india-services.index' ? 'active' : '' }} {{ Route::currentRouteName() === 'india-services.edit' ? 'active' : '' }}">
                                        <i class="fe fe-file-text"></i>
                                        <span>India Services</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['employee-headoffice-list', 'employee-company-list', 'employee-product-list', 'employee-branch-list', 'employee-department-list','employee-list'])
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fa fa-database" aria-hidden="true"></i>
                        <span>Employee Data</span>
                        <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                    </a>
                    <ul>
                        @can(['employee-headoffice-list'])
                        <li>
                            <a href="{{ route('employee-headoffice.index') }}"
                                class="{{ Route::currentRouteName() === 'employee-headoffice.index' ? 'active' : '' }}">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                <span>Office Head</span>
                            </a>
                        </li>
                        @endcan
                        @can(['employee-company-list'])
                        <li>
                            <a href="{{ route('employee-company.index') }}"
                                class="{{ Route::currentRouteName() === 'employee-company.index' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Company</span>
                            </a>
                        </li>
                        @endcan
                        @can(['employee-product-list'])
                        <li>
                            <a href="{{ route('employee-product.index') }}"
                                class="{{ Route::currentRouteName() === 'employee-product.index' ? 'active' : '' }}">
                                <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                <span>Product</span>
                            </a>
                        </li>
                        @endcan
                        @can(['employee-branch-list'])
                        <li>
                            <a href="{{ route('employee-branch.index') }}"
                                class="{{ Route::currentRouteName() === 'employee-branch.index' ? 'active' : '' }}">
                                <i class="fa fa-code-fork" aria-hidden="true"></i>
                                <span>Branch</span>
                            </a>
                        </li>
                        @endcan
                        @can(['employee-department-list'])
                        <li>
                            <a href="{{ route('employee-department.index') }}"
                                class="{{ Route::currentRouteName() === 'employee-department.index' ? 'active' : '' }}">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                <span>Department</span>
                            </a>
                        </li>
                        @endcan
                        @can(['employee-list'])
                        <li>
                            <a href="{{ route('employee.index') }}"
                                class="{{ Route::currentRouteName() === 'employee.index' ? 'active' : '' }}
                                {{ Route::currentRouteName() === 'employee.create' ? 'active' : '' }}">
                                <i class="fe fe-file-text"></i>
                                <span>Employee</span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcanany

                @can(['enquiry-list'])
                    <li
                        class="{{ Route::currentRouteName() === 'enquiry.index' ? 'active' : '' }}{{ Route::currentRouteName() === 'enquiry.show' ? 'active' : '' }}">
                        <a href="{{ route('enquiry.index') }}">
                            <i class="fa fa-phone-square" aria-hidden="true"></i>
                            <span>Enquiry</span>
                        </a>
                    </li>
                @endcan
                @can(['faq-list'])
                    <li class="{{ Route::currentRouteName() === 'faq.index' ? 'active' : '' }}">
                        <a href="{{ route('faq.index') }}">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <span>FAQ</span>
                        </a>
                    </li>
                @endcan
                @can('meta-list')
                    <li class="{{ Route::currentRouteName() === 'meta.index' ? 'active' : '' }}">
                        <a href="{{ route('meta.index') }}">
                            <i class="fa fa-cloud" aria-hidden="true"></i>
                            <span>Meta Data</span>
                        </a>
                    </li>
                @endcan
                @can('product-list')
                    <li
                        class="{{ in_array(Route::currentRouteName(), ['products.index', 'products.create', 'products.edit','products.show']) ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-product-hunt" aria-hidden="true"></i>
                            <span>Products</span>
                        </a>
                    </li>
                @endcan
                @canany(['vendors-list', 'verified-list'])
                    <li class="submenu">
                        <a href="javascript:void(0);"><i class="fa fa-venus-double" aria-hidden="true"></i>
                            <span>Vendors</span>
                            <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                        </a>
                        <ul>
                            @can('vendors-list')
                                <li>
                                    <a href="{{ route('vendors.index') }}"
                                        class="{{ in_array(Route::currentRouteName(), ['vendors.index', 'vendors.create', 'vendors.edit','vendors.show']) ? 'active' : '' }}">
                                        <i class="fe fe-file-text"></i>
                                        <span>Vendor</span>
                                    </a>

                                </li>
                            @endcan
                            @can('verified-list')
                                <li>
                                    <a href="{{ route('verified.index') }}"
                                        class="{{ Route::currentRouteName() === 'verified.index' ? 'active' : '' }}">
                                        <i class="fe fe-file-text"></i>
                                        <span> Verified</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @can('reviews-list')
                    <li class="{{ Route::currentRouteName() === 'reviews.index' ? 'active' : '' }}">
                        <a href="{{ route('reviews.index') }}">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span>Review</span>
                        </a>
                    </li>
                @endcan
                <li class="{{ Route::currentRouteName() === 'newsletter.index' ? 'active' : '' }}">
                    <a href="{{ route('newsletter.index') }}">
                        <i class="fa fa-newspaper" aria-hidden="true"></i>
                        <span>Newsletter</span>
                    </a>
                </li>
                @can('ipaddress-list')
                    <li class="{{ Route::currentRouteName() === 'ipaddress.index' ? 'active' : '' }}">
                        <a href="{{ route('ipaddress.index') }}">
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <span>Ip Address</span>
                        </a>
                    </li>
                @endcan
                @can('transaction-list')
                    <li class="{{ Route::currentRouteName() === 'transaction.index' ? 'active' : '' }}">
                        <a href="{{ route('transaction.index') }}">
                            <i class="fa fa-exchange" aria-hidden="true"></i>
                            <span>Transactions</span>
                        </a>
                    </li>
                @endcan
                @can('invoice-list')
                    <li class="{{ Route::currentRouteName() === 'invoice.index' ? 'active' : '' }}">
                        <a href="{{ route('invoice.index') }}">
                            <i class="fa fa-sticky-note" aria-hidden="true"></i>
                            <span>Invoices</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
