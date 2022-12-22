<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm</title>
    <!-- JavaScript Bundle with Popper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fragment+Mono&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
    .container {
        margin: 0;
        padding: 0;
        max-width: 100%;
        height: auto;
        display: flex;
        padding: 0px 20px 0px 20px;
        padding-bottom: 50px;
    }

    .nav-bar {
        width: 20%;
        padding-left: 10px;
        padding-right: 30px;
        height: auto;

    }
    .nav-bar a {
        text-decoration: none;
        display: inline-block;
        color: black;
    }
    .nav-bar-header {
        width: 100%;
        height: 50px;

    }

    .nav-bar-main {
        width: 100%;
        height: 100px;
        background-color: rgb(155, 155, 133);
        display: none;
    }

    .nav-bar-main.active {
        display: block;
    }

    .content-main {
        width: 80%;
        height: auto;
        
    }

    .container-main {
        width: 100%;
        height: 250px;
        margin-bottom: 20px;
        background-color: #d9eee1;
        padding-top: 1px;
        border: 2px;
        border-radius:20px 0px 0px 20px;
        overflow: hidden;
         text-overflow: ellipsis;
    }

    .container-main h2 {
        margin: 2.5% 0px 0px 2.5%;
    }

    .main-text {
        width: 95%;
        height: 150px;
        background-color:white;
        margin: 0px 0px 0px 2.5%;
        border-radius: 20px 20px 20px 20px;
        padding: 10px;
    }
    .main-text a{
       
    }
    .content-button {

        width: 10%;
        height: 500px;
        
    }
    .content-btn-click {
        width: 100%;
        height: 250px;
        background-color: #f2f2f2;
        margin-bottom: 20px;
    }

    .content-btn-click {
        padding: 100px 0px 0px 20px;


    }

    .contianer2 {
        width: 100%;
        display: flex;
        margin-left: 50px;
    }

    .contianer2 a {
        text-align: center;
        text-decoration: none;
    }

    .item {
        padding-top: 30px;
        border-radius: 20px;
        margin: 5px;

    }

    
</style>

<body>
@include('frontend.component._inc_header')
<div class="container ">
    <div class="nav-bar">
        @foreach($categoryLevel1 as $cateLevel1)
            <p>
                <button style="width: 100%;height: 50px;" class="btn btn-success" type="button" data-toggle="collapse"
                        data-target="#collapse{{ $cateLevel1->id }}" aria-expanded="false"
                        aria-controls="collapse{{ $cateLevel1->id }}">{{ $cateLevel1->cpo_name }}
                </button>
            </p>

            @php
                $child = \App\CategoryPosts::where('cpo_parent_id',$cateLevel1->id)->get();
            @endphp
            @if (!$child->isEmpty())
                <div style="text-align:left;" class="collapse shadow p-3 mb-5 bg-white rounded" id="collapse{{ $cateLevel1->id }}">
                    <div class="card-body">
                        @foreach($child ?? [] as $item)
                            <a href="/danh-muc/{{ $item->cpo_slug }}/{{ $item->id }}">{{ $item->cpo_name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="content-main">
        <div class="container-main" style="height: auto;margin-top: 20px;">
            <h2 style="margin: 0;padding: 10px;background-color:white">Kết quả tìm kiếm {{ Request::get('k') }}</h2>
        </div>

        @foreach($posts as $item)
            <div class="container-main">
                <h2>
                    <a href="/danh-muc/{{ $item->cpo_slug }}/{{ $item->id }}">{{ $item->cpo_name }}</a>
                </h2>
                <div class="main-text">
                    <div style="    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    color: #333;
    display: -webkit-box;
    font-size: 14px;
    line-height: 24px;
    margin-bottom: 20px;
    overflow: hidden;
    text-overflow: ellipsis;">
                        {!! $item->cpo_content !!}
                    </div>
                </div>
            </div>
        @endforeach
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

</html>
