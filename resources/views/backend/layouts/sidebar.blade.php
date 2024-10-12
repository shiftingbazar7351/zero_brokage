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
