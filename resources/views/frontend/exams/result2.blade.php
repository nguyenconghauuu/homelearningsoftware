@include('frontend.layouts.inc_header')
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
    .title-post a:hover {  color: #4CAF50 !important;}
    .title-new { text-transform: uppercase;font-size: 20px; text-align: center ;  border-bottom: 1px solid #dfdfdf;padding-bottom: 10px;}
    .title-footer { font-size: 20px;text-transform: uppercase;border-bottom: 2px solid #72c02c;padding-bottom: 15px;width: 90%}
</style>
<section style="background-color: #f1f1f16e;margin-bottom: 100px;">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-sm-12">

                <div id="box-content">
                    <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                        {{--<h2 class="text-center">  Kết quả thi  </h2>--}}



                        <div class="row">
                            <div class="col-sm-3" id="fix-left" style="border: 1px solid #dedede;position: fixed;background-color: white">
                                <div id="sidebar" style="min-height:600px;" >
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <h4 style="padding-left: 15px;color: #4285f4;font-size: 14px;text-transform: uppercase"> Chương tình học Javascrip cơ bản</h4>
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
                                <h2 class="text-center"> Kết Quả Thi </h2>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class="col-sm-6">
                                            <ul>
                                                <li> Tổng Số Câu Hỏi : 40</li>
                                                <li> Số câu chưa làm  : {{  $socauchulam }}</li>
                                                <li> Số câu trả lời : {{  40 - $socauchulam }}</li>
                                                <li> Số câu đúng : {{  $count }}</li>
                                                <li> Số câu TL sai  : {{  40 - $socauchulam - $count }}</li>

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
                            <a href="{{ route('indexbaithi') }}" style="position: fixed;right: 30px;top: 50%;transform: translateY(50%);padding:6px 14px;background-color: #4CAF50;color: white;font-weight: bold" class="btn btn-xs btn-default"> Trở về  </a>
                        </div>
                    </div>

                </div>
                <div class="footer" style="padding: 20px ;border: 1px solid #dedede;background-color: white;position: fixed;bottom: 0;width: 97%">
                    <p style="color: #333"> Thực Hành Dự Án <a href="">  </a></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</section>
</div>


<script type="text/javascript" src="/frontend/js/jquery.js"></script>
<script type="text/javascript" src="/frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/frontend/js/nicEdit.js"></script>
<script type="text/javascript">
    // bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

</body>
</html>
<script>
    $(function() {
        $('.input-dapan').click(function() {
            $(this).parents('.list-answer').find(".box-answer").removeClass('bg-radio');
            $(this).parent().addClass("bg-radio");
        })
        $(".removeStyle").removeClass();
        $(".removeStyle").removeAttr('class');
        $(".removeStyle").attr('class', '');

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

