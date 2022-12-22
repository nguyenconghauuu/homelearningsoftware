<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        {{-- <span class="logo-mini"><b>A</b>LT</span> --}}
        <!-- logo for regular state and mobile devices -->
{{--        <span class="logo-lg"><b>Khoá Luận</b>TN</span>--}}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{-- <img src="{{ asset('admin/images/user2-160x160.jpg') }}" class="user-image" alt="User Image"> --}}
                        <span class="hidden-xs">{{  Auth::guard('admins')->check() ? Auth::guard('admins')->user()->name : '' }}</span>
                    </a>
                    <ul class="dropdown-menu">
             
                        <li class="user-footer">
                            <div class="pull-left">
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout.admins') }}" class="btn btn-danger btn-flat"> Đăng xuất </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
