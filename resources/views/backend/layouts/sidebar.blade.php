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
        <!-- <div class="siderbar-toggle">
            <label class="switch" id="toggle_btn">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </div> -->
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

                <li>
                    <a href="javascript:void(0);"><i class="fe fe-briefcase"></i>
                        <span>Meta</span>
                        <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                    </a>
                    <ul>
                        <li class="{{ Route::currentRouteName() === 'meta.index' ? 'active' : '' }}">
                            <a href="{{ route('meta.index') }}">
                                <i class="fe fe-file-text"></i>
                                <span>Meta Description</span>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'subcategories.index' ? 'active' : '' }}">
                            <a href="{{ route('subcategories.index') }}">
                                <i class="fe fe-file-text"></i>
                                <span>Meta Url</span>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'subcategories.index' ? 'active' : '' }}">
                            <a href="{{ route('subcategories.index') }}">
                                <i class="fe fe-file-text"></i>
                                <span>Meta Title</span>
                            </a>
                        </li>
                    </ul>
                </li>

            
            </ul>
        </div>
    </div>
</div>
