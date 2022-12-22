@extends('admin.layouts.app')
@section('title','Danh sách câu hỏi ')
@section('main-content')
    <style>
        .active {
            color: red !important;
        }
    </style>
    <section class="content-header">
        <h1>
            Danh sách câu hỏi
        </h1>
        
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header border">

                <form action="" method="get" class="form-inline">
                    <input type="text" class="form-control"  placeholder=" Nhập tên câu hỏi tìm kiếm " name="title"  value="{{ Request::get('title') }}" style="width: 100%;margin:5px 0"/>
                    
                    
                    <div class="" style="margin-top: 5px;display: inline-block">
                        <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-search"></i> Tìm kiếm </button>
                        <a href="{{ route('admin.questions.index') }}" class="btn btn-xs btn-danger"><i class="fa fa-refresh"></i> Làm mới </a>

                    </div>
                </form>
                <div>
                    <a href="{{ route('admin.questions.add') }}" style="margin-top: 5px" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>
                </div>
            </div>
            @include('admin.notification.index')
            <div class="box-body border mr-t-10">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr class="bg-tr">
                            <th>ID</th>
                            <th style="width: 20%">Câu hỏi</th>
                            <th style="width: 40%">Câu trả lời && đáp án </th>
                            <td> Thông tin </td>
                            <th>Action</th>
                        </tr>
                        @foreach($questions as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td> {!! $item->qs_name !!}</td>
                                <td>
                                    <ul style="list-style: none;padding-left: 0;margin-bottom: 0">
                                        <li class="{{ $item->qs_answer_true == 'qs_answer1' ? 'active' : '' }}"> 1.1 - {{ $item->qs_answer1  }}</li>
                                        <li class="{{ $item->qs_answer_true == 'qs_answer2' ? 'active' : '' }}"> 1.2 - {{ $item->qs_answer2  }}</li>
                                        @if($item->qs_answer3)
                                            <li class="{{ $item->qs_answer_true == 'qs_answer3' ? 'active' : '' }}"> 1.3 - {{ $item->qs_answer3  }}</li>
                                        @endif
                                        @if($item->qs_answer4)
                                            <li class="{{ $item->qs_answer_true == 'qs_answer4' ? 'active' : '' }}"> 1.4 - {{ $item->qs_answer4  }}</li>
                                        @endif
                                        @if($item->qs_answer5)
                                            <li class="{{ $item->qs_answer_true == 'qs_answer5' ? 'active' : '' }}"> 1.5 - {{ $item->qs_answer5  }}</li>
                                        @endif

                                    </ul>
                                </td>
                                <td>
                                    <span class="label label-success"> Chương :  {{ $item->cpo_name }} </span><br>
                                </td>
                                <td>
                                    {!! renderBtnEdit(route('admin.questions.edit',$item->id)) !!}
                                    {!! renderBtnDelete(route('admin.questions.delete',$item->id)) !!}
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! renderPaginate($questions,$finter) !!}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <div class="modal fade custome-modal" id="modal-view-posts"></div>
@endsection
@section('main-js')
<script>
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $("#category_post_id").change(function(){
            $this = $(this);
            $cate = $(this).val();
            console.log($cate);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType : 'json',
                url:  '/admins/questions/loadPost',
                data: {cate: $cate },
                success: function( msg ) {
                    let $string = '<option value="0"> - Danh sách bài học - </option>';
                    $.each(msg.posts, function(index,value){
                        $string += '<option value="'+value.id+'"> '+value.po_title+' </option>'
                    });
                    $("#post_id").html('').append($string);
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
        })
    });

</script>
@endsection
