@include('frontend.layouts.inc_header')
{{-- <meta http-equiv="refresh" content="0; url=http://example.com/" /> --}}
{{-- <script type="text/javascript">
           // window.location.href = "http://example.com"
</script> --}}
<style type="text/css">
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
<script type="text/javascript">

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
<section style="background-color: #f1f1f16e;margin-bottom: 100px;">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- <div class="col-sm-12">


            </div> --}}
            <div class="clearfix"></div>
            <div class="col-sm-3" id="fix-left" style="border: 1px solid #dedede;position: fixed;background-color: white">
                <div id="sidebar" style="min-height:600px;" >
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <h4 style="padding-left: 15px;color: #4285f4;font-size: 14px;text-transform: uppercase"> Chương tình học Javascipt </h4>
                        @foreach($sortCategory as $key => $cate)
                            @if($cate->level == 2)
                                <div class="panel panel-default">

                                    <div class="panel-heading" role="tab" id="headingOne{{ $key }}">
                                        <h4 class="panel-title">
                                            <a role="button" style="color: #4285f4;font-weight: bold" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $key }}" class="title-nav" aria-expanded="true" aria-controls="collapseOne">
                                                {{ $cate->cpo_name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne{{$key}}" class="panel-collapse collapse {!!  $key == 1 ? 'in' : '' !!}" role="tabpanel" aria-labelledby="headingOne{{ $key }}">
                                        <div class="panel-body">
                                                <?php
                                                $posts = DB::table('posts')
                                                    ->leftJoin('categoryposts', 'categoryposts.id', '=', 'posts.po_category_post_id')
                                                    ->select('posts.id','posts.po_title','posts.po_slug','posts.po_category_post_id','categoryposts.cpo_slug')
                                                    ->where('po_category_post_id',$cate->id)->orderBy('po_sort','ASC')->get();
                                                ?>
                                            @if($posts->count() > 0 )
                                                <ul style="list-style: none;padding-left: 17px;">
                                                    @foreach($posts as $post)
                                                        <li><a class="title_post_sub" href="/bai-viet/{{ $cate->cpo_parent_id }}/{{ $post->po_slug }}/{{ $post->id }}" title="{{ $post->po_title }}" style="color: #222">{{ $post->po_title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach

                    </div>

                </div>
            </div>
            <div class="col-sm-9" style="margin-left: 24.9%;">
                <div id="box-content">
                    <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                        <h2> Làm bài thi  </h2>
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
                            </style>

                            <form id="myForm" action="" method="POST">
                                <div  class="col-sm-12" >
                                    @foreach($cauHoi as $key => $item)

                                        <div style="padding: 0 20px;background-color: white">
                                            <h4 style="display: inline-flex;font-weight: bold"> Câu {{  $key + 1 }} :  </h4>
                                            <p readonly='true' class="removeStyle" style="width: 100%;">{!! $item->qs_name  !!}</p>
                                            <div class="form-group clearfix" style="margin-top:10px">
                                                <div class="col-sm-10 list-answer">
                                                    @if( $item->qs_answer1)
                                                        <div style="border:1px solid #dfdfdf;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer1" name="dapan-{{ $item->id }}"> &nbsp
                                                            {{ $item->qs_answer1 }}
                                                        </div>
                                                    @endif
                                                    @if( $item->qs_answer2)
                                                        <div style="border:1px solid #dfdfdf;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer2" name="dapan-{{ $item->id }}"> &nbsp
                                                            {{ $item->qs_answer2 }}
                                                        </div>
                                                    @endif
                                                    @if( $item->qs_answer3)
                                                        <div style="border:1px solid #dfdfdf;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer3" name="dapan-{{ $item->id }}"> &nbsp
                                                            {{ $item->qs_answer3 }}
                                                        </div>
                                                    @endif
                                                    @if( $item->qs_answer4)
                                                        <div style="border:1px solid #dfdfdf;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer4" name="dapan-{{ $item->id }}"> &nbsp
                                                            {{ $item->qs_answer4 }}
                                                        </div>
                                                    @endif
                                                    @if( $item->qs_answer5)
                                                        <div style="border:1px solid #dfdfdf;padding: 5px;border-radius: 5px;margin-bottom: 2px;" class="box-answer">
                                                            <input type="radio" class="input-dapan" value="qs_answer5"  name="dapan-{{ $item->id }}"> &nbsp
                                                            {{ $item->qs_answer5 }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!--/ end -->
                                    @endforeach
                                </div>

                                <div class="wrap">
                                    <p id="timer" style="margin-bottom: 0"><script type="text/javascript">countDown();</script></p>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token()  }}">
                                <button type="submit" style="position: fixed;right: 30px;top: 50%;transform: translateY(50%);padding:6px 14px;background-color: #4CAF50;color: white;font-weight: bold" class="btn btn-xs btn-default"> Nộp bài </button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="footer" style="padding: 20px ;border: 1px solid #dedede;background-color: white;position: fixed;bottom: 0;width: 97%">
                    <p style="color: #333"> Thực Hành Dự Án <a href="">  </a></p>
                </div>
            </div>
        </div>

    </div>
</section>
</div>


<script type="text/javascript" src="/frontend/js/jquery.js"></script>
<script type="text/javascript" src="/frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/frontend/js/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</body>
</html>
<script>
    $(function() {
        $('.input-dapan').click(function() {
            $(this).parents('.list-answer').find(".box-answer").removeClass('bg-radio');
            $(this).parent().addClass("bg-radio");
        })
        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 50) {
                $('#main-menu').addClass('fixed-menu');
                $("#fix-left").addClass('fix-left');
            } else {
                $('#main-menu').removeClass('fixed-menu');
                $("#fix-left").removeClass('fix-left');
            }
        });
    })
</script>

