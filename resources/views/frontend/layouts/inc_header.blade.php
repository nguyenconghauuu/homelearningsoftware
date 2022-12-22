<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  @yield('title_main','Trang chủ ') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/css/font-awesome.min.css">
    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,700i,900&amp;subset=vietnamese" rel="stylesheet"> --}}
    <style type="text/css">
        body { font-family: font-family: 'Roboto', sans-serif; }
        a:hover { text-decoration: none !important }
        .bg-radio { background-color: #d6d6d6 }
        .fixed-menu { overflow: hidden;position: fixed;top: 0;background: #f8f8f8;z-index: 999;width: 98%}

        #sidebar { padding-top: 10px;padding-bottom:10px; }
        #sidebar > ul { padding-left: 10px; }
        #sidebar > ul > li > a { display: block;text-transform: uppercase;font-size: 13px;font-weight: 500 ;color: #000;padding-top: 10px;padding-bottom: 10px;}

        #sidebar > ul > li ul { padding-left: 15px;list-style: none }
        #sidebar > ul > li > ul a { color: #666 ;display: block;padding-bottom: 1px;padding-top: 1px;}
        #nav_main >li>a {padding-right: 3px}
        #users .accout-user {font-size: 11px;display: block;padding: 5px 13px;border: 1px solid #dedede;margin-top: 9px;margin-right: 5px;font-weight: bold}
        #users .accout-user:hover { color: #00a888;border:1px solid #00a888 !important; }
        #ul-sidebar a { white-space: nowrap;overflow: hidden;text-overflow: ellipsis}
        .no-drop {cursor: no-drop;}
        .title-detail-post { border-bottom: 1px solid #dedede ;padding-bottom: 20px;}
        .active-detail { color: #4CAF50 !important }
        .box-item-question { margin-left:30px;color:red;display: none}
        a.box-item-question:hover ,a.box-item-question:active ,a.box-item-question:focus,a.box-item-question:visited{ text-decoration: none !important;}
        #main-menu #nav_main a { text-transform: uppercase}
        .btn-action{ font-size: 11px;
            padding: 7px 13px;
            border: 1px solid #dedede;
            margin-top: 9px;
            margin-right: 5px;
            font-weight: bold;
            background-color: #4285F4;
            color: white;
        }
        .btn-input-action { padding: 4px 5px;width: 200px;border-radius: 4px;}
        .btn-input-action:focus{ outline: none}
        .btn-action:hover {

        }
        #main-menu a { color: white !important;}
        #main-menu a:hover { background-color: rgba(33, 72, 189, 0.64)}
        #main-menu #nav_main li.active a { background-color: rgba(33, 72, 189, 0.64)}
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover
        {
            background: #4266b2;
        }
        .fix-left {
            top: 70px;
        }

        #result { display: none}
        #result
        {
            width: 85%;
            border: 1px solid #dedede;
            margin-top: 5px;
            z-index: 99999;
            position: absolute;
            background: white;
        }
        #result li {
            list-style: none;
            padding: 5px;
            border-bottom: 1px dotted #dedede;
        }
        #result li a {
            text-transform: capitalize;
            display: inline-block;
            padding: 7px 10px;
            color: #666;
        }
        #result li:hover a{
            color: #337ab7;
            padding-left: 20px;
        }
    </style>
</head>
<body>
<div id="main-content" style="width: 100%;margin: 0 auto;">
    <section id="header" style="border-top: 2px solid #4266b2">
    @foreach(['success','danger'] as $item)
        @if(session($item))
            <div class="flash-message">
                <div class="alert alert-{{ $item }}" role="alert" style="position: absolute;right: 10px;top: 20px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong class="font-weight-100 font-size-14">{{ session($item) }}  </strong>
                </div>
            </div>

        @endif
    @endforeach
    <section>
        <nav class="navbar navbar-default" role="navigation" style="border-radius: 0;background-color: #4285F4" id="main-menu">
            <div class="container-fluid" style="width: 90%">
                <a class="navbar-brand" style="text-transform: uppercase;font-size: 14px;" href="/">Trang chủ </a>
                <ul class="nav navbar-nav" id="nav_main">
                    <!-- show ra danh mục cấp 1  -->
                    @foreach($categoryLevel1 as $cateLevel1)
                        <li class="{{ Request::segment('3') == $cateLevel1->id || Request::segment('2') == $cateLevel1->id ? 'active' : '' }}"><a href="/danh-muc/{{ $cateLevel1->cpo_slug }}/{{ $cateLevel1->id }}">{{ $cateLevel1->cpo_name }}</a></li>
                    @endforeach
                    <li class="{{ Request::segment('2') == 'lam-bai-thi' ||  Request::segment('2') == 'vao-thi'? 'active' : '' }} ">
                        <a href="{{ route('indexbaithi') }}"> Làm bài tập </a>
                    </li>
                    <li><a href="/gioi-thieu.html">Giới thiệu</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right" id="users" >
                    
                    @if(Auth::guard('web')->check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                Xin Chào {{ Auth::guard('web')->user()->u_name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="padding: 0">
                                <li style="background: #4266b2"><a href="#"> Cập nhật thông tin </a></li>
                                <li style="background: #4266b2"><a href="#"> Xem điểm thi </a></li>
                                <li style="background: #4266b2"><a href="{{ route('logout_user') }}"> Đăng Xuất</a></li>
                            </ul>
                        </li>
                    @else
                        {{--<li>--}}
                            {{--<form action="{{ route('post_login') }}" method="POST">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<input type="text" autocomplete="off" placeholder=" Email " name="u_email" non-unique class="btn-input-action">--}}
                                {{--<input type="password" autocomplete="off" placeholder=" Mật khẩu " style="width:150px" name="u_password" non-unique class="btn-input-action">--}}
                                {{--<input class="btn-action" type="submit" value="Đăng nhập" >--}}
                            {{--</form>--}}
                        {{--</li>--}}
                        <li>
                            <a  href="{{ route('dangky.user') }}" class="btn-action" style="padding: 4.5px 19px;">Đăng ký </a>
                        </li>
                        <li>
                            <a  href="{{ route('get.dangky.user') }}" class="btn-action" style="padding: 4.5px 19px;"> Đăng nhập </a>
                        </li>
                    @endif

                </ul>
            </div>
        </nav>
    </section>
