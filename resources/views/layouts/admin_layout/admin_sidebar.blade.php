    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/admin/dashboard') }}" class="brand-link">
            <img src="{{ asset('/images/admin_images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Advance E Commerce</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="@if(!empty(Auth::guard('admin')->user()->image)) {{ asset('/images/admin_images/admin_photos/' . Auth::guard('admin')->user()->image) }} @else /images/admin_images/user2-160x160.jpg  @endif" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ ucwords(Auth::guard('admin')->user()->name) }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ url('/admin/dashboard') }}" class="nav-link @if(Session::get('page') == "dashboard") active @endif">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item @if(Session::get('page') == "settings" || Session::get('page') == "account") menu-open @endif">
                        <a href="#" class="nav-link @if(Session::get('page') == "settings" || Session::get('page') == "account") active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings') }}" class="nav-link @if(Session::get('page') == "settings") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Password Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/update-admin-details') }}" class="nav-link @if(Session::get('page') == "account") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Details Update</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @if(Session::get('page') == "view-brands" || Session::get('page') == "view-sections" || Session::get('page') == "view-categories" || Session::get('page') == "add-edit-category" || Session::get('page') == "view-products" || Session::get('page') == "add-edit-product" || Session::get('page') == "add-attributes" || Session::get('page') == "add-images") menu-open @endif">
                        <a href="#" class="nav-link @if(Session::get('page') == "view-sections" || Session::get('page') == "edit-sections") active @endif">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Catalogue
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/admin/view-brands') }}" class="nav-link @if(Session::get('page') == "view-brands") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Brands</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/view-sections') }}" class="nav-link @if(Session::get('page') == "view-sections") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sections</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/view-categories') }}" class="nav-link @if(Session::get('page') == "view-categories" || Session::get('page') == "add-edit-category") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/view-products') }}" class="nav-link @if(Session::get('page') == "view-products" || Session::get('page') == "add-edit-product" || Session::get('page') == "add-attributes" || Session::get('page') == "add-images") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Products</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
