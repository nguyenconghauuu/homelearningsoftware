@extends('admin.layouts.app')
@section('title',' Thêm mới thành viên  ')
@section('main-content')

  
    <section class="content-header">
        <h1>
            Thêm mới thành viên 
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
                                
                                <div class="col-sm-8">
                                   
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Họ và Tên  </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="u_name" value="{{ old('u_name') }}"  placeholder=" Ví dụ : Nguyễn Văn A" autocomplete="off">
                                            @if($errors->first('u_name'))
                                                <span class="text-danger">{{ $errors->first('u_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Email  </label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="u_email" value="{{ old('u_email') }}"  placeholder=" admin@gmail.com " autocomplete="off">
                                            @if($errors->first('u_email'))
                                                <span class="text-danger">{{ $errors->first('u_email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Mật Khẩu   </label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="u_password" value="{{ old('u_password') }}"  placeholder=" ****** " autocomplete="off">
                                            @if($errors->first('u_password'))
                                                <span class="text-danger">{{ $errors->first('u_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Xác nhận    </label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="u_repassword" value="{{ old('u_repassword') }}"  placeholder=" xác  mật khẩu giống với mật khẩu ở trên  " autocomplete="off">
                                            @if($errors->first('u_repassword'))
                                                <span class="text-danger">{{ $errors->first('u_repassword') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Age  </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="u_age" value="{{ old('u_age') }}"  placeholder=" 24 " autocomplete="off">
                                            @if($errors->first('u_age'))
                                                <span class="text-danger">{{ $errors->first('u_age') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                   {{--  <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label" style="margin-bottom: 10px;"> Description </label>
                                        <div class="col-sm-10" style="margin-right: 0;margin-left: 0">
                                            <textarea name="po_description"  cols="10" rows="3" class="form-control" placeholder=" Mô tả ngắn về nội dung bài viết , không quá 250 ký tự">{{ old('po_description') }}</textarea>
                                            @if($errors->first('po_description'))
                                                <span class="text-danger">{{ $errors->first('po_description') }}</span>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div> --}}
                                     
                                </div>
                                
                            </div>
                            <!-- /.box-body -->
                            <div class="text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary btn-xs" style="width: 75px;display: inline;"> Thêm mới </button>
                                <a href=" {{ route('admin.users.index') }}" class="btn btn-danger btn-xs" style="width: 75px"> Huỷ bỏ </a>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
            </div>
        </div>
    </section>

@endsection

