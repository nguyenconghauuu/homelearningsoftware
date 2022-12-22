@extends('admin.layouts.app')
@section('title',' Xem điểm thi ')
@section('main-content')

    <section class="content-header">
        <h1>
            Xem điểm thi <b>{{ isset($diem) && count($diem) > 0 ? $diem[0]->u_name : '' }}</b>
        </h1>
       
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">

            <div   style="margin-bottom: 10px;padding:0 10px">
                {{--<form action="" method="get" class="form-inline">--}}
                    {{--<input type="text" class="form-control"  placeholder=" Tìm kiếm theo tên / email  / Địa chỉ  " name="keyword"  value="{{ Request::get('keyword') }}" style="width: 100%;margin:5px 0"/>--}}
                    {{--<label class="radio-box">Hiển thị--}}
                        {{--<input type="radio"  name="u_active" value="1" {{ Request::get('u_active') == 1 ? "checked=''" : "" }}>--}}
                        {{--<span class="checkmark"></span>--}}
                    {{--</label>--}}
                    {{--<label class="radio-box"> Không hiển thị--}}
                        {{--<input type="radio" name="u_active" value="2" {{ Request::get('u_active') == 2 ? "checked=''" : "" }}>--}}
                        {{--<span class="checkmark"></span>--}}
                    {{--</label>--}}
                    {{--<label class="radio-box"> Đang online--}}
                        {{--<input type="radio" name="u_online" value="1" {{ Request::get('u_online') == 1 ? "checked=''" : "" }}>--}}
                        {{--<span class="checkmark"></span>--}}
                    {{--</label>--}}
                    {{--<label class="radio-box"> Offline--}}
                        {{--<input type="radio" name="u_online" value="2" {{ Request::get('u_online') == 2 ? "checked=''" : "" }}>--}}
                        {{--<span class="checkmark"></span>--}}
                    {{--</label>--}}
                    {{--<select name="paginate" id="" class="form-control" style="width:15%;margin-left: 10px;">--}}
                        {{--<option value="">--  Số bản ghi hiển thị  --</option>--}}
                        {{--<option value="5" {{ Request::get('paginate') == 5 ? "selected='selected'" : "" }}>5</option>--}}
                        {{--<option value="10" {{ Request::get('paginate') == 10 ? "selected='selected'" : "" }}>10</option>--}}
                        {{--<option value="20" {{ Request::get('paginate') == 20 ? "selected='selected'" : "" }}>20</option>--}}
                        {{--<option value="100" {{ Request::get('paginate') == 100 ? "selected='selected'" : "" }}>100</option>--}}
                    {{--</select>--}}
                    {{--<div class="input-group date" data-provide="datepicker">--}}
                        {{--<input type="date" class="form-control" name="date" data-date-format="Y-m-d" placeholder="Lọc theo ngày " style="width: 175px" value="{{  Request::get('date') }}">--}}
                        {{--<div class="input-group-addon">--}}
                            {{--<span class="glyphicon glyphicon-th"></span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<select name="finddate" id="" class="form-control" style="width:19%;margin-left: 10px;">--}}
                        {{--<option value="">--  Lọc  --</option>--}}
                        {{--<option value="day" {{ Request::get('find-date') == 5 ? "selected='selected'" : "" }}> Hôm Nay </option>--}}
                        {{--<option value="week" {{ Request::get('find-date') == 5 ? "selected='selected'" : "" }}> Tuần Này </option>--}}
                        {{--<option value="month" {{ Request::get('find-date') == 5 ? "selected='selected'" : "" }}> Tháng Này </option>--}}
                        {{--<option value="year" {{ Request::get('find-date') == 5 ? "selected='selected'" : "" }}> Năm Này </option>--}}
                    {{--</select>--}}

                    {{--<div class="" style="margin-top: 5px;">--}}
                        {{--<button type="submit" class="btn btn-xs btn-success"><i class="fa fa-search"></i> Tìm kiếm </button>--}}
                        {{--<a href="{{ route('admin.users.index') }}" class="btn btn-xs btn-danger"><i class="fa fa-refresh"></i> Làm mới </a>--}}
                        {{--<a href="{{ route('admin.users.add') }}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>--}}
                    {{--</div>--}}
                {{--</form>--}}
            </div>
            @include('admin.notification.index')
            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover border">
                        <tbody>

                        <tr>
                            <th rowspan="2" class="hg">Stt</th>
                            <th rowspan="2" class="hg">Bài học</th>
                            <th rowspan="2" class="hg"> Điểm </th>
                        </tr>
                        @foreach($diem as $item)
                            <tr>
                                <td>{{  $item->id }}</th>
                                <td>{{ $item->cpo_name }}</td>
                                <td>{{ $item->er_point }} / 20 điểm </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
{{--                {!! renderPaginate($users,$finter) !!}--}}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    @endsection
    </script>
