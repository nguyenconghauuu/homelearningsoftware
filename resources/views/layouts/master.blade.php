<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Trangchu</title>
</head>
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Fragment Mono', monospace;
    }

    .header {
        width: 100%;
        height: auto;
        display: flex;
    }

    .navbar {
        width: 100%;
    }

    .collapse {
        margin-left: 0px;
    }

    /*  */
    .main {
        display: flex;
        width: 100%;

    }

    .slide-content {
        width: 15%;
        height: 500px;
        padding: 20px;

        display: flex;
        flex-direction: column;


    }

    .slide-content a {
        text-decoration: none;
        color: #000;
    }

    .container {
        display: flex;
        width: 100%;
        margin-top: 20px;
    }

    .content {
        width: 90%;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .btn-content {
        width: 20%;
        height: 200px;
        padding: 20px;

        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /*  */
    
</style>

<body>
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="header-logo">
            <a href=""><img style="width:120px" src="./hls.jpg" alt=""></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div style="margin-left:100px ;" class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach($categoryLevel1 as $cateLevel1)
                    <li class="{{ Request::segment('3') == $cateLevel1->id || Request::segment('2') == $cateLevel1->id ? 'active' : '' }} nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" id="navbarDropdown"
                           aria-haspopup="true" aria-expanded="false" href="#">{{ $cateLevel1->cpo_name }}</a>
                        @php
                            $child = \App\CategoryPosts::where('cpo_parent_id',$cateLevel1->id)->get();
                        @endphp
                        @if (!$child->isEmpty())
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($child ?? [] as $item)
                                    <a class="dropdown-item"
                                       href="/danh-muc/{{ $cateLevel1->cpo_slug }}/{{ $cateLevel1->id }}">{{ $item->cpo_name }}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>

            <form class="form-inline my-2 my-lg-0" style="margin:0px 100px 0 0 ;">
                <input class="form-control mr-sm-2" style="width:300px" type="search" placeholder="Tim kiem"
                       aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
            </form>
            <button type="button" class="btn btn-success">Đăng nhập</button>

        </div>
    </nav>
</div>
<div class="main">
    <div class="slide-content">
        @foreach($categorys as $key => $cate)
            <p>
                <button style="width:180px; height: 50px;" class="btn btn-success" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false"
                        aria-controls="collapseExample">{{ $cate->cpo_name }} </button>
            </p>
                <?php
                $posts = DB::table('posts')
                    ->leftJoin('categoryposts', 'categoryposts.id', '=', 'posts.po_category_post_id')
                    ->select('posts.id', 'posts.po_title', 'posts.po_slug', 'posts.po_category_post_id', 'categoryposts.cpo_slug', 'posts.po_content')
                    ->where('po_category_post_id', $cate->id)->orderBy('po_sort', 'ASC')->get();
                ?>

            @if($posts->count() > 0 )
                <div style="text-align:center ;" class="collapse shadow p-3 mb-5 bg-white rounded" id="collapseExample">
                    <div class="card-body">
                        @foreach($posts as $post)
                            <a href="/bai-viet/{{ $cate->cpo_parent_id }}/{{ $post->po_slug }}/{{ $post->id }}">{{ $post->po_title }}</a>
                        @endforeach


                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="container shadow p-3 mb-5 bg-white rounded" style="background-color: whitesmoke;">
        @if (isset($posts[0]))
            <div class="content">

                <h1>{{ $posts[0]->po_title }}</h1>
                <div>
                    {!! $posts[0]->po_content !!}
                </div>
            </div>
            <div class="btn-content">
                {{--                <button type="button" style="margin-bottom:5px ;" class="btn btn-outline-success">Học bài</button>--}}
                <a href="{{ route('indexbaithi') }}" type="button" class="btn btn-outline-success">Làm bài</a>
            </div>
        @endif
    </div>


</div>
<div class="footer" style="padding: 20px ; width: 100%;
    height: auto;
    display: flex;
    flex-direction: column;
    background-color: rgb(2, 2, 2);
    text-align: center;
    color: white;">
        <p> Homelearningsoftware được tối ưu hóa cho việc học tập. Các ví dụ có thể được đơn giản hóa để cải thiện khả
            năng đọc và hiểu cơ bản. Các hướng dẫn, tài liệu tham khảo nhưng chúng tôi không thể đảm bảo tính chính xác
            hoàn toàn của tất cả nội dung. Trong khi sử dụng trang web này, bạn đồng ý đã đọc và chấp nhận các điều
            khoản sử dụng, cookie và chính sách bảo mật của chúng tôi.
            </p>
            <p>Copyright by Nam & Hau</p>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script>

</script>

</html>
