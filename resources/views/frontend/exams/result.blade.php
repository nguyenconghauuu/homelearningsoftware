<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Content</title>
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
        height: auto;
        margin-top: 20px;
    }

    .content {
        width: 90%;
        height: auto;
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
            <div style="text-align:center;background-color:#28a745;color:white" class="shadow-none p-3 mb-5  rounded">{{ $category->cpo_name ?? "" }}</div>
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
            <h2 class="text-center"> Kết Quả Thi </h2>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="col-sm-6">
                        <ul>
                            <li> Tổng Số Câu Hỏi : 20</li>
                            <li> Số câu chưa làm  : {{  $socauchulam }}</li>
                            <li> Số câu trả lời : {{  20 - $socauchulam }}</li>
                            <li> Số câu đúng : {{  $count }}</li>
                            <li> Số câu TL sai  : {{  20 - $socauchulam - $count }}</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul>
                            <li> Người làm  : <b>{{ Auth::guard('web')->user()->u_name }}</b></li>
                        </ul>
                    </div>
                </div>
            </div>
            <form id="myForm" action="" method="POST">
                <div  class="col-sm-12" >
                    @foreach($ketquan as  $key => $item)
                        <div style="padding: 0 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                            <h4 style="display: inline-flex"> Câu {{  $key + 1 }} :  </h4>
                            <p disabled name="area2" class="removeStyle" style="width: 100%;">{!! $item['data']->qs_name  !!}</p>
                            <div class="form-group clearfix" style="margin-top:20px">
                                <div class="col-sm-10 list-answer">
                                        <?php $border= '#dedede'; ?>
                                    @if( $item['dapan']['check'] == true || $item['dapan']['check'] == 'none')


                                        @if( $item['data']->qs_answer1)
                                            <div style="border:3px solid  {{ $item['dapan']['dapan'] == 'qs_answer1' || $item['data']->qs_answer_true == 'qs_answer1' ? '#4CAF50' : $border  }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                <input type="radio" class="input-dapan" {{ $item['data']->qs_answer_true == 'qs_answer1' ? "checked" : "" }} value="qs_answer1" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                {{ $item['data']->qs_answer1 }}
                                            </div>
                                        @endif
                                        @if( $item['data']->qs_answer2)

                                            <div style="border:3px solid {{ $item['dapan']['dapan'] == 'qs_answer2' || $item['data']->qs_answer_true == 'qs_answer2' ? '#4CAF50' : $border  }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                <input type="radio" class="input-dapan" {{ $item['data']->qs_answer_true == "qs_answer2" ? "checked" : "" }} value="qs_answer2" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                {{ $item['data']->qs_answer2 }}
                                            </div>
                                        @endif
                                        @if( $item['data']->qs_answer3)


                                            <div style="border:3px solid {{ $item['dapan']['dapan'] == 'qs_answer3'  || $item['data']->qs_answer_true == 'qs_answer3' ? '#4CAF50' : $border }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                <input type="radio" class="input-dapan" {{ $item['data']->qs_answer_true == "qs_answer3" ? "checked" : "" }} value="qs_answer3" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                {{ $item['data']->qs_answer3 }}
                                            </div>
                                        @endif
                                        @if( $item['data']->qs_answer4)


                                            <div style="border:3px solid {{ $item['dapan']['dapan'] == 'qs_answer4' || $item['data']->qs_answer_true == 'qs_answer4' ? '#4CAF50' : $border }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                <input type="radio" class="input-dapan" {{ $item['data']->qs_answer_true == "qs_answer4" ? "checked" : "" }} value="qs_answer4" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                {{ $item['data']->qs_answer4 }}
                                            </div>
                                        @endif
                                        @if( $item['data']->qs_answer5)

                                            <div style="border:3px solid {{ $item['dapan']['dapan'] == 'qs_answer5' || $item['data']->qs_answer_true == 'qs_answer5' ? '#4CAF50' : $border }};padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                <input type="radio" class="input-dapan" {{ $item['data']->qs_answer_true == "qs_answer5" ? "checked" : "" }} value="qs_answer5" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                {{ $item['data']->qs_answer5 }}
                                            </div>
                                        @endif
                                    @else
                                        @if( $item['data']->qs_answer1)

                                            @if($item['data']->qs_answer_true == 'qs_answer1')
                                                <div style="border:3px solid #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                    <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer1' ? 'checked' : '' }}  value="qs_answer1" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                    {{ $item['data']->qs_answer1 }}
                                                </div>
                                            @else
                                                @if($item['dapan']['dapan'] == 'qs_answer1')
                                                    <div style="border:3px solid  red ;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer1' ? 'checked' : '' }}  value="qs_answer1" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer1 }}
                                                    </div>
                                                @else
                                                    <div style="border:3px solid #dedede;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer1' ? 'checked' : '' }}  value="qs_answer1" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer1 }}
                                                    </div>
                                                @endif

                                            @endif
                                        @endif
                                        @if( $item['data']->qs_answer2)

                                            @if($item['data']->qs_answer_true == 'qs_answer2')
                                                <div style="border:3px solid #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                    <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer2' ? 'checked' : '' }}  value="qs_answer2" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                    {{ $item['data']->qs_answer2 }}
                                                </div>
                                            @else
                                                @if($item['dapan']['dapan'] == 'qs_answer2')
                                                    <div style="border:3px solid  red ;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer2' ? 'checked' : '' }}  value="qs_answer2" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer2 }}
                                                    </div>
                                                @else
                                                    <div style="border:3px solid #dedede;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer2' ? 'checked' : '' }}  value="qs_answer2" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer2 }}
                                                    </div>
                                                @endif

                                            @endif
                                        @endif
                                        @if( $item['data']->qs_answer3)


                                            @if($item['data']->qs_answer_true == 'qs_answer3')
                                                <div style="border:3px solid #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                    <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer3' ? 'checked' : '' }}  value="qs_answer3" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                    {{ $item['data']->qs_answer3 }}
                                                </div>
                                            @else
                                                @if($item['dapan']['dapan'] == 'qs_answer3')
                                                    <div style="border:3px solid  red ;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer3' ? 'checked' : '' }}  value="qs_answer3" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer3 }}
                                                    </div>
                                                @else
                                                    <div style="border:3px solid #dedede;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer3' ? 'checked' : '' }}  value="qs_answer3" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer3 }}
                                                    </div>
                                                @endif

                                            @endif
                                        @endif
                                        @if( $item['data']->qs_answer4)


                                            @if($item['data']->qs_answer_true == 'qs_answer4')
                                                <div style="border:3px solid #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                    <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer4' ? 'checked' : '' }}  value="qs_answer4" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                    {{ $item['data']->qs_answer4 }}
                                                </div>
                                            @else
                                                @if($item['dapan']['dapan'] == 'qs_answer4')
                                                    <div style="border:3px solid  red ;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer4' ? 'checked' : '' }}  value="qs_answer4" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer4 }}
                                                    </div>
                                                @else
                                                    <div style="border:3px solid #dedede;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer4' ? 'checked' : '' }}  value="qs_answer4" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer4 }}
                                                    </div>
                                                @endif

                                            @endif
                                        @endif
                                        @if( $item['data']->qs_answer5)

                                            @if($item['data']->qs_answer_true == 'qs_answer5')
                                                <div style="border:3px solid #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                    <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer5' ? 'checked' : '' }}  value="qs_answer5" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                    {{ $item['data']->qs_answer5 }}
                                                </div>
                                            @else
                                                @if($item['dapan']['dapan'] == 'qs_answer5')
                                                    <div style="border:3px solid  red ;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer5' ? 'checked' : '' }}  value="qs_answer5" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer5 }}
                                                    </div>
                                                @else
                                                    <div style="border:3px solid #dedede;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                        <input type="radio" class="input-dapan" {{ $item['dapan']['dapan'] == 'qs_answer5' ? 'checked' : '' }}  value="qs_answer5" name="dapan-{{ $item['data']->id }}"> &nbsp
                                                        {{ $item['data']->qs_answer5 }}
                                                    </div>
                                                @endif

                                            @endif
                                        @endif

                                    @endif
                                    @if($item['data']->qs_suggestion)
                                        <div>
                                            <p><span style="color:#000;font-weight: bold">Gợi ý</span> <span style="color: red">{{ $item['data']->qs_suggestion }}</span></p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!--/ end -->
                    @endforeach

                </div>
            </form>
        </div>

    </div>

</div>
<div class="footer">
    <div class="logo-footer">
        <a href=""><img style="width:300px" src="./hls.jpg" alt=""></a>
    </div>
    <div class="content-footer">
        <h5>Thông tin liên hệ</h5>
        <h5>Địa chỉ</h5>
        <h5>Email</h5>
        <h5>Hotline</h5>
    </div>
    <div class="icon-footer" style="margin-top:-150px ;" >

        <svg style="margin-left:10px ;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path
                    d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
        </svg>

        <svg style="margin-left:10px ;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path
                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
        </svg>
        <svg style="margin-left:10px " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path
                    d="M524.531,69.836a1.5,1.5,0,0,0-.764-.7A485.065,485.065,0,0,0,404.081,32.03a1.816,1.816,0,0,0-1.923.91,337.461,337.461,0,0,0-14.9,30.6,447.848,447.848,0,0,0-134.426,0,309.541,309.541,0,0,0-15.135-30.6,1.89,1.89,0,0,0-1.924-.91A483.689,483.689,0,0,0,116.085,69.137a1.712,1.712,0,0,0-.788.676C39.068,183.651,18.186,294.69,28.43,404.354a2.016,2.016,0,0,0,.765,1.375A487.666,487.666,0,0,0,176.02,479.918a1.9,1.9,0,0,0,2.063-.676A348.2,348.2,0,0,0,208.12,430.4a1.86,1.86,0,0,0-1.019-2.588,321.173,321.173,0,0,1-45.868-21.853,1.885,1.885,0,0,1-.185-3.126c3.082-2.309,6.166-4.711,9.109-7.137a1.819,1.819,0,0,1,1.9-.256c96.229,43.917,200.41,43.917,295.5,0a1.812,1.812,0,0,1,1.924.233c2.944,2.426,6.027,4.851,9.132,7.16a1.884,1.884,0,0,1-.162,3.126,301.407,301.407,0,0,1-45.89,21.83,1.875,1.875,0,0,0-1,2.611,391.055,391.055,0,0,0,30.014,48.815,1.864,1.864,0,0,0,2.063.7A486.048,486.048,0,0,0,610.7,405.729a1.882,1.882,0,0,0,.765-1.352C623.729,277.594,590.933,167.465,524.531,69.836ZM222.491,337.58c-28.972,0-52.844-26.587-52.844-59.239S193.056,219.1,222.491,219.1c29.665,0,53.306,26.82,52.843,59.239C275.334,310.993,251.924,337.58,222.491,337.58Zm195.38,0c-28.971,0-52.843-26.587-52.843-59.239S388.437,219.1,417.871,219.1c29.667,0,53.307,26.82,52.844,59.239C470.715,310.993,447.538,337.58,417.871,337.58Z" />
        </svg>
        <svg style="margin-left:10px " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
        <svg style="margin-left:10px " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg>
    </div>
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
