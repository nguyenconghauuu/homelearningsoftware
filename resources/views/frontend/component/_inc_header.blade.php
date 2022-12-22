<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
    li a:hover:not(.avtive){
        background-color: #d9eee1;
        
    }
    li a.active {
        color: white;
        background-color: #d9eee1;
    }
    
    .item a{
        text-decoration: none;
        color: black;
    }
    a:hover{
        color: #FF4500;
        text-decoration: none;
    }

    .navbar-nav{
        font-weight: 700;
    }
</style>
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="header-logo" style="margin-left:30px">
            <a href="/"><img  style="width:95px" src="{{ asset('logo_home.jpg') }}" alt=""></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div  class=" collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="active navbar-nav mr-auto" style="margin: 0 auto;justify-content: space-between; font-size:18px" >
                
                @foreach($categoryLevel1 as $key => $cateLevel1)
                    @if ($key == 4)
                        @break
                    @endif
                    <li class="{{ Request::segment('3') == $cateLevel1->id || Request::segment('2') == $cateLevel1->id ? 'active' : '' }} nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" id="navbarDropdown"
                           aria-haspopup="true" aria-expanded="false" href="#">{{ $cateLevel1->cpo_name }}</a>
                        @php
                            $child = \App\CategoryPosts::where('cpo_parent_id',$cateLevel1->id)->get();
                        @endphp
                        @if (!$child->isEmpty())
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:#d9eee1;font-size:18px">
                                @foreach($child ?? [] as $item)
                                        <?php $arrChild[] = $item ?>
                                    <a class="dropdown-item"
                                       href="/danh-muc/{{ $item->cpo_slug }}/{{ $item->id }}">{{ $item->cpo_name }}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
                <li class="nav-item">
                    <a href="{{ route('get.quiz.list.view') }}" class="nav-link">Làm bài quiz</a>
                </li>
                <form class="form-inline my-2 my-lg-0" action="{{ route('searchTypehead') }}" style="margin:0px 20px 0 0 ;">
                    <input class="form-control mr-sm-2" style="width:300px" type="search" name="k" placeholder="Tu khoa: html ,css..."
                           aria-label="Search" value="{{ Request::get('k') }}">
                    <button style = "" class="btn btn-outline-danger my-2 my-sm-0" type="submit"><svg style="width:40px;height:20px ;color:white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/></svg></button>
                </form>
                @if(Auth::guard('web')->check())
                    <li class="dropdown">
                        <a style="text-decoration: none;
                        color: black;r" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            Xin Chào {{ Auth::guard('web')->user()->u_name }} <span class="caret"></span>
                        </a>
                        <ul class="item dropdown-menu" style="padding: 10px">
                            <li><a href="{{ route('get.profile') }}"> Thông tin </a></li>
                            <li><a href="{{ route('get.password') }}"> Cập nhật mật khẩu </a></li>
                            <li><a href="{{ route('get.kq.list') }}"> Lịch sử làm bài</a></li>
                            <li><a href="{{ route('logout_user') }}"> Đăng Xuất</a></li>
                        </ul>
                    </li>
                @else
                    <a href="{{ route('get.dangky.user') }}" type="button" class="btn btn-success">Đăng nhập</a>
                @endif
            </ul>
        </div>
    </nav>
</div>
