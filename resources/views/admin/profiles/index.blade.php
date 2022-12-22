@extends('admin.layouts.app')
@section('title',' Cập nhật thông tin admin ')
@section('main-content')
     <section class="content-header">
        <h1>
            Thông tin cá nhân 
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            @include('admin.notification.index')
            <div class="box-body">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Avatar   </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="avatar" id="imgInp" value="{{ old('email') }}" id="inputEmail3" autocomplete="off">
                                            @if($errors->first('avatar'))
                                                <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                            @endif
                                        </div>
                                        @if($profile_admin->avatar)
                                            <div class="col-sm-10" style="margin-top: 10px;margin-left: 17%">
                                                <img src="/uploads/{{  $profile_admin->avatar }}" alt="" class="img img-responsive" id="blah" title=" avatar " style="width: 100%;height: 258px;border: 1px solid #dedede">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Tên hiển thị  </label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control pull-right" name="name" value="{{ $profile_admin->name }}" autocomplete="off">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-globe" style="width: 14px;"></i>
                                                </div>
                                            </div>
                                            @if($errors->first('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Địa chỉ   </label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control pull-right" name="address" value="{{ $profile_admin->address }}" autocomplete="off">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-map-marker" style="width: 14px;"></i>
                                                </div>
                                            </div>
                                            @if($errors->first('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Số điện thoại  </label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control pull-right" name="phone" value="{{ $profile_admin->phone }}" autocomplete="off">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-mobile-phone" style="width: 14px;"></i>
                                                </div>
                                            </div>
                                            @if($errors->first('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Email   </label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="email" class="form-control pull-right" name="email" value="{{ $profile_admin->email }}" autocomplete="off">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </div>
                                            </div>
                                            @if($errors->first('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Youtube   </label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control pull-right" name="youtube" value="{{ $profile_admin->youtube }}" autocomplete="off">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-youtube" style="width: 14px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Facebook   </label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control pull-right" name="facebook" value="{{ $profile_admin->facebook }}" autocomplete="off">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-facebook" style="width: 14px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mô tả </label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="descriptions"> {{ $profile_admin->descriptions }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- /.box-body -->
                            <div class="box-footer col-sm-offset-5">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary btn-xs"> Cập nhật mới  </button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection