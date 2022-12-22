@include('frontend.layouts.inc_header')
<style>
    #ul-sidebar a li
    {
        color: #2e529cdb;
    }
    .active_detail
    {
        color: red !important;
    }
</style>
<section style="background-color: #f1f1f16e">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-sm-3" id="fix-left" style="border: 1px solid #dedede;position: fixed;background-color: white;padding-left: 20px">
                <div id="sidebar" style="">
                    <ul style="padding-left: 20px;height: 600px;overflow-y:auto; overflow-x:hidden;" id="ul-sidebar">
                        @foreach($abouts as $ab)
                            <li><a href="/gioi-thieu/{{ $ab->po_slug }}-{{ $ab->id }}.html" class="{{ $id == $ab->id ? "active_detail" : "" }}" style="color: #4285F4;font-weight: 500 !important;padding: 5px 0">{{ $ab->po_title }}</a></li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="col-sm-9" style="margin-left: 24.9%;">

                <div id="box-content">
                    <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                        <h3 style="border-bottom: 1px solid #dedede;padding-bottom: 20px;">  {{ $detail->po_title }}</h3>
                        <div id="content-about">
                            {!! $detail->po_content !!}
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
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
    console.log($(window).height() - 115);
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
</script>
