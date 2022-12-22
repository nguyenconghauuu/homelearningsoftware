@include('frontend.layouts.inc_header')
<style>

</style>
<section style="background-color: #f1f1f16e">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-sm-3" id="fix-left" style="border: 1px solid #dedede;position: fixed;background-color: white">
                <div id="sidebar" style="">
                    <ul style="padding-left: 10px;list-style: none;height: 600px;overflow-y:auto; overflow-x:hidden;" id="ul-sidebar">
                        @if( count($CategoryChildrens) > 0)

                            @foreach($CategoryChildrens as $key => $childrenCate)
                                <li>
                                    <?php
                                    $posts = DB::table('posts')
                                        ->leftJoin('categoryposts', 'categoryposts.id', '=', 'posts.po_category_post_id')
                                        ->select('posts.id','posts.po_title','posts.po_slug','posts.po_category_post_id','categoryposts.cpo_slug')
                                        ->where('po_category_post_id',$childrenCate->id)->orderBy('po_sort','ASC')->get();
                                    ?>
                                    <a href="{{ route('show-category-cap2',[$childrenCate->cpo_slug,$childrenCate->id]) }}" style="color: #4285f4;font-weight: bold" >{{ $childrenCate->cpo_name }}</a>
                                    @if($posts->count() > 0 )
                                        <ul>
                                            @foreach($posts as $post)
                                                <li><a href="/bai-viet/{{ $childrenCate->cpo_parent_id }}/{{ $post->po_slug }}/{{ $post->id }}" title="{{ $post->po_title }}" style="color: #000">{{ $post->po_title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @else
                            <li>
                                <a href=""> Chưa có dữ liệu  </a>
                            </li>
                        @endif

                    </ul>

                </div>
            </div>
            <div class="col-sm-9" style="margin-left: 24.9%;">
                <div id="box-content">
                    <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                        <h3>Giới thiệu  <a href="" class="btn btn-xs btn-success text-center questions-modail"  style="margin-left: 300px" data-id=<?= $category->id ?> > Câu hỏi ôn tập chương </a> </h3>
                        <div>
                            {!! $category->cpo_content !!}
                        </div>
                        <h3> Bài viết của chương <a href="" class="btn btn-xs btn-success text-center questions-modail" data-id=<?= $category->id ?> style="margin-left:200px"> Câu hỏi ôn tập chương</a></h3>
                        <ul>

                            @foreach($postsCategory as $abpost)
                                <li><a href="/bai-viet/{{ $id_parent }}/{{ $abpost->po_slug }}/{{ $abpost->id }}" style="color: #0053f9" class="post-lq">{{ $abpost->po_title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
<div id="myModal-question" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-transform: uppercase"> Câu hỏi ôn tập : {{ $category->cpo_name }}</h4>
            </div>
            <div class="modal-body" id="content-question" style="height: 500px;overflow-y: auto">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="/frontend/js/jquery.js"></script>
<script type="text/javascript" src="/frontend/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
</body>
</html>
<script type="text/javascript">
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 50) {
            $('#main-menu').addClass('fixed-menu');
            $("#fix-left").addClass('fix-left');
        } else {
            $('#main-menu').removeClass('fixed-menu');
            $("#fix-left").removeClass('fix-left');
        }
    });
    $("#ul-sidebar").css("height",$(window).height() - 115);

    $(function(){
        $("#sidebar ul").first().addClass('menu-level1').attr('id','ul-sidebar');
    })

    $(document).on('click','.qs_answer_true', function(){
        $(this).parent().find(".box-item-question").toggle();
    })

    $(function(){
        var path = "{{ route('searchTypehead') }}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {

                return $.get(path, { query: query }, function (data) {
                    console.log(data);
                    $("#result").show();
                    $html  = '';
                    if(data && data.length > 0)
                    {
                        $.each(data , function(index, value){
                            $html += "<li><a href='/bai-viet/1/"+value.po_slug+"/"+value.id+"'>"+value.po_title+"</a></li>"
//                            $html += "<li><a href='/san-pham/"+value.po_slug+"-"+value.id+".html'>"+value.po_title+"</a></li>"
                        });
                    }else {
                        $("#result").html('').append('<li><a href="#"> Không có dữ liệu </a></li>');
                    }
                    $("#result").html('').append($html);
                });
            }
        });
    })
    $(function(){
        $(".questions-modail").on('click',function(e){
            e.preventDefault();
            $("#myModal-question").modal("show");
            let $idPost = $(this).attr('data-id');
            console.log($idPost);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType : 'json',
                url:  '/bai-viet/question-ajax-2/' + $idPost,
                data: { 'idpost': $idPost },
                success: function( msg ) {
                    let string  = '';
                    if( msg && msg.questions.length > 0)
                    {
                        console.log(msg.questions);
                        function  convertQuestion(string)
                        {
                            switch (string)
                            {
                                case 'qs_answer1':
                                    return ' Đáp án A';
                                    break;
                                case 'qs_answer2':
                                    return ' Đáp án B';
                                    break;
                                case 'qs_answer3':
                                    return ' Đáp án C';
                                    break;
                                default:
                                    return ' Đáp án D';
                            }
                        }
                        $.each(msg.questions , function (index, value ) {
                            $key = index + 1;
                            string += ' <div class="modal-item">\n' +
                                '                    <h5 style="display: inline-flex;font-weight: bold"> '+$key+'. '+value.qs_name+' : '+ ' '+' ( K'+ value.qs_level +' ) </h5>\n' +
                                '                    <p><b>a</b> '+value.qs_answer1+' </p>\n' +
                                '                    <p><b>b</b> '+value.qs_answer2+' </p>\n' +
                                '                    <p><b>c</b> '+value.qs_answer3+' </p>\n' +
                                '                    <p><b>d</b> '+value.qs_answer4+' </p>\n' +
                                '                    <a href="javascript:void(0)" class="qs_answer_true">Xem đáp án </a>'+
                                '                            <div class="box-item-question">'+
                                '                                <span> '+convertQuestion(value.qs_answer_true)+'</span>'+
                                '                                <div> Gợi ý : '+value.qs_suggestion+' </div>'+
                                '                          </div>'+
                                '                </div>'
                        })
                        $("#content-question").html('').append($(string));
                    }
                },
                processData: false,
                contentType: false,
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
        });
    });
</script>
