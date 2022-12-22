<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>{{ $category->cpo_name }}</title>
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



    /*  */
    .main {
        display: flex;
        width: 100%;

    }

    .slide-content {
        width: 21%;
        height: auto;
        padding:20px 0px 0px 20px;
        display: flex;
        flex-direction: column;
    }

    .slide-content a {
        text-decoration: none;
        color: #000;
        display: block;
    }

    .container {
        display: flex;
        width: 80%;
        height: auto;
        margin-top: 20px;
    }

    .content {
        width: 80%;
        height: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .page{
        margin: auto;
    }
    /*  */
    .footer {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        background-color: rgb(2, 2, 2);
        text-align: center;
        
    }
    .footer p{
        color: white;
    }
    .list-cate-sidebar .active {
        color: #28a745;
    }

    .btn {
        background-color: #04aa6d;
    }
</style>

<body>
@include('frontend.component._inc_header')
<div class="main">
    <div class="slide-content">
        @if (isset($categoyParent) && $categoyParent)
            <div style="text-align:center; background-color: #04aa6d; color:white" class="shadow-none p-3 mb-5  rounded">{{ $categoyParent->cpo_name }}</div>
        @else
            <div style="text-align:center; background-color: #04aa6d; color:white" class="shadow-none p-3 mb-5  rounded">{{ $category->cpo_name }}</div>
        @endif

        <div style="text-align:left; margin-top: -40px;" class="collapse show shadow p-3 mb-5 bg-white rounded" >
            <div class="card-body list-cate-sidebar">
                @foreach($CategoryChildrens as $key => $childrenCate)
                <a class="{{ $childrenCate->id == $id ? 'active' : '' }}" href="/danh-muc/{{ $childrenCate->cpo_slug }}/{{ $childrenCate->id }}">{{ $childrenCate->cpo_name }}</a>
                @endforeach
            </div>
        </div>

    </div>
    <div class="container shadow p-3 mb-5 bg-white rounded" style="background-color: whitesmoke;">
        <div class="content">
            <h1>{{ $category->cpo_name }}</h1>
            <div>
                {!! $category->cpo_content !!}
            </div>
        </div>

    </div>

</div>
<div class="footer" style="padding: 20px">
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
