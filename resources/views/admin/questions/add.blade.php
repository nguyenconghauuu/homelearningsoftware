@extends('admin.layouts.app')
@section('title',' Thêm mới câu hỏi ')
@section('main-content')
@section('main-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <style type="text/css">
        .select2-selection__choice { background-color: red !important ;border: 1px solid !important;}
        .select2-selection__choice__remove { color: white !important }
        #cke_37 { display: none !important }
        .control-label{ text-align: left !important;}
    </style>
@endsection
<section class="content-header">
    <h1>
        Thêm mới câu hỏi
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <!-- Horizontal Form -->
            <div class="box box-primary">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"> Nội dung câu hỏi </label>
                            <div class="col-sm-9">
                                <textarea name="qs_name" id="my-editor" cols="10" rows="10" class="form-control" placeholder=" Nội dung câu hỏi ">{{ old('qs_name') }}</textarea>
                                @if($errors->first('qs_name'))
                                    <span class="text-danger">{{ $errors->first('qs_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"> Thunbar   </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="qs_thunbar" id="imgInp">
                                    @if($errors->first('qs_thunbar'))
                                        <span class="text-danger">{{ $errors->first('qs_thunbar') }}</span>
                                    @endif
                                </div>
                                <div class="col-sm-10" style="margin-top: 10px;margin-left: 17%">
                                    <img src="" alt="" class="img img-responsive" id="blah" title=" Logo " style="width: 100%;height: 258px;border: 1px solid #dedede">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Danh mục </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="ps_category_post_id" id="category_post_id">
                                        <option value=""> - Chọn danh mục  - </option>
                                        @if(count($sortCategoryPost) > 0)
                                            @foreach($sortCategoryPost as $item)
                                                <option value="{{ $item->id }}"><?php for($i = 0; $i < $item->level; $i ++) echo '|--'; ?>{{ $item->cpo_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->first('ps_category_post_id'))
                                        <span class="text-danger">{{ $errors->first('ps_category_post_id') }}</span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Bài học </label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="qs_post_id" id="post_id">
                                        <option value=""> - Danh sách bài học   - </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-bottom: 10px;"> Giợi ý  </label>
                                <div class="col-sm-10" style="margin-right: 0;margin-left: 0">
                                    <textarea name="qs_suggestion"  cols="10" rows="3" class="form-control" placeholder="  Gợi ý cho câu trả lời nếu có ">{{ old('qs_suggestion') }}</textarea>
                                    @if($errors->first('qs_suggestion'))
                                        <span class="text-danger">{{ $errors->first('qs_suggestion') }}</span>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"> Câu trả lời 1 </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="qs_answer1" value="{{ old('qs_answer1') }}"  placeholder=" Câu trả lời thứ 1" autocomplete="off">
                                    @if($errors->first('qs_answer1'))
                                        <span class="text-danger">{{ $errors->first('qs_answer1') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"> Câu trả lời 2 </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="qs_answer2" value="{{ old('qs_answer2') }}"  placeholder=" Câu trả lời thứ 2" autocomplete="off">
                                    @if($errors->first('qs_answer2'))
                                        <span class="text-danger">{{ $errors->first('qs_answer2') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"> Câu trả lời 3 </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="qs_answer3" value="{{ old('qs_answer3') }}"  placeholder=" Câu trả lời thứ 3" autocomplete="off">
                                    @if($errors->first('qs_answer3'))
                                        <span class="text-danger">{{ $errors->first('qs_answer3') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"> Câu trả lời 4 </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="qs_answer4" value="{{ old('qs_answer4') }}"  placeholder=" Câu trả lời thứ 4" autocomplete="off">
                                    @if($errors->first('qs_answer4'))
                                        <span class="text-danger">{{ $errors->first('qs_answer4') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"> Câu trả lời 5 </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="qs_answer5" value="{{ old('qs_answer5') }}"  placeholder=" Câu trả lời thứ 5" autocomplete="off">
                                    @if($errors->first('qs_answer5'))
                                        <span class="text-danger">{{ $errors->first('qs_answer5') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"> Đáp án đúng </label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="qs_answer_true">
                                        <option value=""> - Chọ đáp án  - </option>
                                        <option value="qs_answer1"> Câu trả lời 1 </option>
                                        <option value="qs_answer2"> Câu trả lời 2 </option>
                                        <option value="qs_answer3"> Câu trả lời 3 </option>
                                        <option value="qs_answer4"> Câu trả lời 4 </option>
                                        <option value="qs_answer5"> Câu trả lời 5 </option>
                                    </select>
                                    @if($errors->first('qs_answer_true'))
                                        <span class="text-danger">{{ $errors->first('qs_answer_true') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /.box-body -->
                    <div class="" style="position: fixed;right: 15px;top: 50%;transform: translateY(-50%);">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary btn-xs" style="width: 75px"> Thêm mới </button><br>
                        <a href=" {{ route('admin.questions.index') }}" class="btn btn-danger btn-xs" style="width: 75px"> Huỷ bỏ </a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>


@endsection

@section('main-js')
    <script>
        $(function() {
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
                        let $string = '<option> - Danh sách bài học - </option>';
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
            CKEDITOR.replace( 'my-editor', {
                height:'200px'
            });
        })
    </script>
@endsection

