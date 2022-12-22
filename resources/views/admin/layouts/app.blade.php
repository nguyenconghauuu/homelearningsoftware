<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title> @yield('title','Theme admin')  </title>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            {{-- @include('admin.layouts.inc_css') --}}
            <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">
            @yield('main-css')
            <style>
                .sidebar-menu>li>a {
                    padding: 10px 5px 10px 15px !important;
                }
            </style>
        </head>
        <body class="hold-transition skin-blue fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            @include('admin.layouts.inc_header')
            <!-- ======================HEADER========================= -->
            @include('admin.layouts.inc_sidebar')
            <!-- =======================SIDEBAR======================== -->

            <!-- ======================= CONTENT======================== -->
            <div class="content-wrapper">
                @yield('main-content')
            </div>
            <!-- =======================END CONTENT======================== -->

            {{-- @include('admin.layouts.inc_footer') --}}
            {{-- <script type="text/javascript" src="{{  asset('js/all.js') }}"></script> --}}
            <div class="control-sidebar-bg"></div>
        </div>

        @include ('admin.layouts.inc_js')
        @yield('main-js')
    </body>
</html>
