<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Kết quả</title>
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
        width: 100%;
        /*height: 1000px;*/
        margin-top: 20px;
    }

    .content {
        width: 90%;
        /*height: 200px;*/
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .page{
        margin: auto;
    }
    /*  */
    
    .list-cate-sidebar .active {
        color: #28a745;
    }

    .box-sm{ background: white}
    .panel-default { border-radius: 0;border-color: white;border: 0 !important;}
    .panel-heading { background-color: #fff !important;border: none}
    .title-nav {
        color: #000;
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .panel-body{ border: 0 !important;padding-top: 0!important;}
    .panel-group .panel { border: 0 !important;border-radius: 0!important;}
    .title_post_sub
    {
        color: #666;
        display: block;
        padding-bottom: 1px;
        padding-top: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .title-post a { color: #666; display: block; padding-bottom: 1px;  padding-top: 1px;  white-space: nowrap;  overflow: hidden; text-overflow: ellipsis;}
    .title-post a:hover {  color: #00a888 !important;}
    .title-new { text-transform: uppercase;font-size: 20px; text-align: center ;  border-bottom: 1px solid #dfdfdf;padding-bottom: 10px;}
    .title-footer { font-size: 20px;text-transform: uppercase;border-bottom: 2px solid #72c02c;padding-bottom: 15px;width: 90%}
    .box-active {
        border: 2px solid #4CAF50;
        margin-bottom: 20px;
    }
</style>
<script>
    var count = 3600;
    function countDown(){
        var timer = document.getElementById("timer");
        if(count > 0){
            count--;
            timer.innerHTML = " <i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>  <b>"+secondsToHms(count)+"</b> giây ";
            setTimeout("countDown()", 1000);
        }else{
            document.getElementById("myForm").submit();
        }
    }
    function secondsToHms(d) {
        d = Number(d);
        var h = Math.floor(d / 3600);
        var m = Math.floor(d % 3600 / 60);
        var s = Math.floor(d % 3600 % 60);

        var hDisplay = h > 0 ? h + (h == 1 ? " giờ - " : " giờ ") : "";
        var mDisplay = m > 0 ? m + (m == 1 ? " phút " : " phút ") : "";
        var sDisplay = s > 0 ? s + (s == 1 ? " giây " : " ") : "";
        return hDisplay + mDisplay + sDisplay;
    }
</script>
<body>
@include('frontend.component._inc_header')
<div class="main">
    <div class="slide-content">
        @if (isset($categoyParent) && $categoyParent)
            <div style="text-align:center;background-color:#28a745;color:white" class="shadow-none p-3 mb-5  rounded">{{ $categoyParent->cpo_name }}</div>
        @else
            <div style="text-align:center;background-color:#28a745;color:white" class="shadow-none p-3 mb-5  rounded">{{ $category->cpo_name }}</div>
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
            <div id="box-content">
                <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                    <h2> Kết quả thi  </h2>
                    <div class="row">
                        <style>
                            .wrap {
                                padding: 6px 14px;
                                border-radius: 5px;
                                border: 1px solid #ddd;
                                font-size: 12px;
                                text-align: center;
                                position: fixed;
                                background-color: #4CAF50;
                                right: 31px;
                                top: 100px;
                                color: white;
                                font-weight: bold;
                            }
                            .list-answer.active {
                                border: 2px solid #4CAF50;
                            }
                        </style>
                        @if (Request::get('view') === 'preview')
                            <ul>
                                <li> Tổng Số Câu Hỏi : 20 </li>
                                <li> Số câu chưa làm  : {{  $examResultItem->do_not }}</li>
                                <li> Số câu trả lời : {{ $examResultItem->did }}</li>
                                <li> Số câu đúng : {{  $examResultItem->correct }}</li>
                                <li> Số câu TL sai  : {{  $examResultItem->wrong }}</li>
                            </ul>
                        @else
                            <form id="myForm" action="" method="POST">
                                <div  class="col-sm-12 " >
                                    @foreach($exams_users as $key => $exams_user)
                                        @php $item = $exams_user->question;  @endphp

                                        <div style="padding: 0 20px;background-color: white " class="{{ $exams_user->selected_answer && $exams_user->selected_answer == $exams_user->correct_answer ? 'box-active' : ''  }}">
                                            <h4 style="display: inline-flex;font-weight: bold"> Câu {{  $key + 1 }} :  </h4>
                                            <p readonly='true' class="removeStyle" style="width: 100%;">{!! $item->qs_name  !!}</p>
                                            <div class="form-group clearfix" style="margin-top:10px">
                                                <div class="col-sm-10 list-answer">
                                                    @if( $item->qs_answer1)
                                                        <div style="border:1px solid {{ $item->qs_answer_true == 'qs_answer1' ? '#4CAF50' : '#dfdfdf' }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" checked class="input-dapan" value="qs_answer1" name="dapan-{{ $exams_user->id }}"> &nbsp
                                                            {{ $item->qs_answer1 }}
                                                        </div>
                                                    @endif
                                                    @if( $item->qs_answer2)
                                                        <div style="border:1px solid {{ $item->qs_answer_true == 'qs_answer2' ? '#4CAF50' : '#dfdfdf' }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer2" name="dapan-{{ $exams_user->id }}"> &nbsp
                                                            {{ $item->qs_answer2 }}
                                                        </div>
                                                    @endif
                                                    @if( $item->qs_answer3)
                                                        <div style="border:1px solid {{ $item->qs_answer_true == 'qs_answer3' ? '#4CAF50' : '#dfdfdf' }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer3" name="dapan-{{ $exams_user->id }}"> &nbsp
                                                            {{ $item->qs_answer3 }}
                                                        </div>
                                                    @endif
                                                    @if( $item->qs_answer4)
                                                        <div style="border:1px solid {{ $item->qs_answer_true == 'qs_answer4' ? '#4CAF50' : '#dfdfdf' }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer4" name="dapan-{{ $exams_user->id }}"> &nbsp
                                                            {{ $item->qs_answer4 }}
                                                        </div>
                                                    @endif
                                                    @if( $item->qs_answer5)
                                                        <div style="border:1px solid {{ $item->qs_answer_true == 'qs_answer5' ? '#4CAF50' : '#dfdfdf' }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer5"  name="dapan-{{ $exams_user->id }}"> &nbsp
                                                            {{ $item->qs_answer5 }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!--/ end -->
                                    @endforeach
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

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
