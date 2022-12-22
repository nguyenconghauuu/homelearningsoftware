@extends('admin.layouts.app')
@section('main-content')
    <section class="content-header">
        <h1>
            Thêm mới Tags
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                <div class="col-md-8 col-sm-offset-2">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <form class="form-horizontal" action="" method="post" >

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"> Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="VD laravel" autocomplete="off">
                                        @if($errors->first('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label"> Hot </label>
                                    <div class="col-sm-10">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="hot" id="optionsRadios2" value="1" checked="">
                                                Không
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="hot" id="optionsRadios1" value="1" >
                                                Có
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer col-sm-offset-2">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary btn-xs"> Thêm mới </button>
                                <a href="javascript:void(0)" class="btn btn-danger btn-xs"> Huỷ bỏ </a>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection