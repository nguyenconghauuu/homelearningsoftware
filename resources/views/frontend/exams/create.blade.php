@include('frontend.layouts.inc_header')
<style>
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
    a.post-lq:hover{ color: #00a888 !important;}
</style>
<section style="background-color: #f1f1f16e;margin-bottom: 100px;">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-sm-3" id="fix-left" style="border: 1px solid #dedede;position: fixed;background-color: white">
                <div id="sidebar" style="min-height:600px;" >
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <h4 style="padding-left: 15px;color: #4285f4;font-size: 14px;text-transform: uppercase;font-weight: bold"> Chương tình học Javascrip </h4>
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
                                                            <li><a class="title_post_sub" href="/bai-viet/{{ $cate->cpo_parent_id }}/{{ $post->po_slug }}/{{ $post->id }}" title="{{ $post->po_title }}"  style="color: #000">{{ $post->po_title }}</a></li>
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
                        <h2 style="text-align: center;text-transform: uppercase">CHÀO MỪNG BẠN ĐẾN VỚI HỆ THỐNG LUYỆN THI HOME LEARNING SOFTWARE</h2>

                        <div class="clearfix">
                            <div class="col-sm-8 col-sm-offset-2 clearfix">
                                <form class="form-horizontal" action="{{ route('taodethi') }}" method="POST">
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-4" for="email" style="text-align: left"> Bạn luyện thi phần </label>
                                        <div class="col-sm-8">
                                            <select name="category" id="" class="form-control">
                                                @foreach($categoryLevel1 as $cate)
                                                    <option value="">{{ $cate->cpo_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-5 col-sm-8">
                                            <button type="submit" class="btn btn-success"> Thi Thử  </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div>
                            <h3>  Bài viết liên quan </h3>
                            <ul>
                                @foreach($postAbout as $ab)
                                <li><a href="{{ route('thongtin',[$ab->id,$ab->po_slug]) }}" style="color: #0053f9" class="post-lq">{{ $ab->po_title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="footer" style="padding: 20px ;border: 1px solid #dedede;background-color: white;position: fixed;bottom: 0;width: 79.6%">
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
<script>
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 50) {
            $('#main-menu').addClass('fixed-menu');
            $("#fix-left").addClass('fix-left');
        } else {
            $('#main-menu').removeClass('fixed-menu');
            $("#fix-left").removeClass('fix-left');
        }
    });
</script>
</body>
</html>
