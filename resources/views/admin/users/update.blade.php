@extends('admin.layouts.app')
@section('title',' Cập nhật thành viên  ')
@section('main-content')

  
    <section class="content-header">
        <h1>
            Cập nhật thành viên 
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
             @include('admin.notification.index')
            <div class="box-body">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" disabled="">
                            <div class="box-body">
                               
                                <div class="col-sm-8">
                                   
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Họ và Tên  </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" disabled     name="u_name" value="{{ $user->u_name }}"  placeholder=" Ví dụ : Nguyễn Văn A" autocomplete="off">
                                            @if($errors->first('u_name'))
                                                <span class="text-danger">{{ $errors->first('u_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Email  </label>
                                        <div class="col-sm-10">
                                            <input type="email" disabled class="form-control" name="u_email" value="{{ $user->u_email }}"  placeholder=" admin@gmail.com " autocomplete="off">
                                            @if($errors->first('u_email'))
                                                <span class="text-danger">{{ $errors->first('u_email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Age  </label>
                                        <div class="col-sm-10">
                                            <input type="text" disabled class="form-control" name="u_age" value="{{ $user->u_age }}"  placeholder=" 24 " autocomplete="off">
                                            @if($errors->first('u_age'))
                                                <span class="text-danger">{{ $errors->first('u_age') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.box-body -->
{{--                            <div class="text-center">--}}
{{--                                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                <button type="submit" class="btn btn-primary btn-xs" style="width: 75px;display: inline;"> Cập nhật  </button>--}}
                                <a href=" {{ route('admin.users.index') }}" class="btn btn-danger btn-xs" style="width: 75px"> Trở về </a>
{{--                            </div>--}}
                            <!-- /.box-footer -->
                        </form>
                    </div>
            </div>
        </div>
    </section>

@endsection

