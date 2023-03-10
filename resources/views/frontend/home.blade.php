<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HLS</title>
    <!-- JavaScript Bundle with Popper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
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
    .nav-bar a{
        text-decoration: none;
        color: black;
        display: inline-block;
        font-size:18px;
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
        height: 280px;
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
        height: 170px;
        background-color:white;
        margin: 0px 0px 0px 2.5%;
        border-radius: 20px 20px 20px 20px;
        padding: 10px 10px 0px 10px;
    }
    .main-text a{
        display: inline;
        font-size: 13.5px;
        text-decoration: none;
        color: red;
       
    }
    .main-text a:hover{
        box-shadow: 0 1px rgb(10, 120, 65);
    }
    .link{
       display:inline;
    }
    .content-button {

        width: 10%;
        height: 500px;
        
    }

    .content-btn-click {
        width: 100%;
        height: 280px;
        background-color: #d9eee1;
        margin-bottom: 20px;
        border: 2px;
        border-radius:0px 20px 20px 0px;
    }

    .content-btn-click {
        padding: 100px 0px 0px 20px;


    }

    .contianer2 {
        width: 100%;
        display: flex;
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

   
    

    .content-btn-click a{
        
    }
    
    
</style>

<body>
    @php
        $arrChild = [];
    @endphp
    <div>
        <div style="position: fixed; top: 0px; width: 100%; z-index: 100;">
            @include('frontend.component._inc_header')
        </div>
        <div class="container" style="min-height: 120vh; margin-top: 10px">
            <div class="nav-bar">
                <div  style="position: sticky; top: 120px">
                    @foreach ($categoryLevel1 as $cateLevel1)
                    <p>
                        <button style="width: 100%;height: 50px;" class="btn btn-success" type="button"
                            data-toggle="collapse" data-target="#collapse{{ $cateLevel1->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $cateLevel1->id }}">{{ $cateLevel1->cpo_name }}
                        </button>
                    </p>
    
                    @php
                        $child = \App\CategoryPosts::where('cpo_parent_id', $cateLevel1->id)->get();
                    @endphp
                    @if (!$child->isEmpty())
                        <div style="text-align:left ;" class="collapse shadow p-3 mb-5 bg-white rounded"
                            id="collapse{{ $cateLevel1->id }}">
                            <div class="card-body">
                                @foreach ($child ?? [] as $item)
                                    <a href="/danh-muc/{{ $item->cpo_slug }}/{{ $item->id }}">{{ $item->cpo_name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
               
            </div>
            <div class="content-main" style="margin-top: 120px">  
                @foreach ($categoryLevel1 as $cateL1)
                    <div class="container-main ">
                        <h2>{{ $cateL1->cpo_name }}</h2>
                        <div class="main-text ">
                            <div
                                style="    -webkit-line-clamp: 3;
                                -webkit-box-orient: vertical;
                                color: #333;
                                display: -webkit-box;
                                font-size: 14px;
                                line-height: 24px;
                                margin-bottom: 20px;
                                overflow: hidden;
                                padding-top:10px;
                                text-overflow: ellipsis;">
                                {!! $cateL1->cpo_content !!}
                            </div>
                            @php
                                $child = \App\CategoryPosts::where('cpo_parent_id', $cateL1->id)->get();
                                //
                            @endphp
                            @if (!$child->isEmpty())
                                @foreach ($child ?? [] as $item)
                                    <div class="link"><a style="" href="/danh-muc/{{ $item->cpo_slug }}/{{ $item->id }}">{{ $item->cpo_name }}</a></div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="content-button"  style="margin-top: 120px">
                @foreach ($categoryLevel1 as $item)
                    <div class="content-btn-click">
                        <a href="/danh-muc/{{ $item->cpo_slug }}/{{ $item->id }}" style="margin-bottom:5px ;"
                            class="btn btn-outline-success">H???c b??i</a>
                        <a href="{{ route('post.quiz', $item->id) }}" class="btn btn-outline-danger">L??m b??i</a>
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
            <p> Homelearningsoftware ???????c t???i ??u h??a cho vi???c h???c t???p. C??c v?? d??? c?? th??? ???????c ????n gi???n h??a ????? c???i thi???n kh???
                n??ng ?????c v?? hi???u c?? b???n. C??c h?????ng d???n, t??i li???u tham kh???o nh??ng ch??ng t??i kh??ng th??? ?????m b???o t??nh ch??nh x??c
                ho??n to??n c???a t???t c??? n???i dung. Trong khi s??? d???ng trang web n??y, b???n ?????ng ?? ???? ?????c v?? ch???p nh???n c??c ??i???u
                kho???n s??? d???ng, cookie v?? ch??nh s??ch b???o m???t c???a ch??ng t??i.
                </p>
                <p>Copyright by Nam & Hau</p>
        </div>
    </div>
   


   
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>

</html>
