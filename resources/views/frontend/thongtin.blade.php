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
            <div class="col-sm-3" style="border: 1px solid #dedede;position: fixed;background-color: white">
                <div id="sidebar" style="min-height:600px;" >
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <h4 style="padding-left: 15px;color: #2e529c;font-size: 14px;text-transform: uppercase"> Bài viết liên quan </h4>
                                <ul>
                                    @foreach($postAbout as $item)
                                    <li><a href="">{{  $item->po_title }}</a></li>
                                    @endforeach
                                </ul>

                            </div>

                </div>
            </div>
            <div class="col-sm-9" style="margin-left: 24.9%;">

                <div id="box-content">
                    <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                        <h2>{{ $post->po_title }}</h2>
                        <div>
                            {!! $post->po_content !!}
                        </div>
                        <div>
                            <h3>  Bài viết liên quan </h3>
                            <ul>
                                @foreach($postAbout as $ab)
                                <li><a href="{{ route('thongtin',[$ab->id,$ab->po_slug]) }}" style="color: #222" class="post-lq">{{ $ab->po_title }}</a></li>
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
</body>
</html>
