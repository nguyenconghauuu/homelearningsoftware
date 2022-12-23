@extends('admin.layouts.app')
@section('title','Danh sách thành viên ')
@section('main-content')

    <section class="content-header">
        <h1>
            Danh sách thành viên
        </h1>
        
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            
            <div   style="margin-bottom: 10px;padding:0 10px">
                <form action="" method="get" class="form-inline">
                    <input type="text" class="form-control"  placeholder=" Tìm kiếm theo tên / email   " name="keyword"  value="{{ Request::get('keyword') }}" style="width: 100%;margin:5px 0"/>
                   
                    
                    <div class="input-group date" data-provide="datepicker">
                        <input type="date" class="form-control" name="date" data-date-format="Y-m-d" placeholder="Lọc theo ngày " style="width: 175px" value="{{  Request::get('date') }}">
                         <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                    <select name="finddate" id="" class="form-control" style="width:19%;margin-left: 10px;">
                        <option value="">--  Lọc  --</option>
                        <option value="day" {{ Request::get('find-date') == 5 ? "selected='selected'" : "" }}> Hôm Nay </option>
                        <option value="week" {{ Request::get('find-date') == 5 ? "selected='selected'" : "" }}> Tuần Này </option>
                        <option value="month" {{ Request::get('find-date') == 5 ? "selected='selected'" : "" }}> Tháng Này </option>
                        <option value="year" {{ Request::get('find-date') == 5 ? "selected='selected'" : "" }}> Năm Này </option>
                    </select>

                    <div class="" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-search"></i> Tìm kiếm </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-xs btn-danger"><i class="fa fa-refresh"></i> Làm mới </a>
                      
                    </div>
                </form>
            </div>
            @include('admin.notification.index')
            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover border">
                    <caption>Contact Information</caption>
                        <tbody>
                            
                             <tr>
                                <th rowspan="2" class="hg">ID</th>
                                <th rowspan="2" class="hg">Họ Tên</th>
                                <th rowspan="2" class="hg"> Email </th>
                                <th rowspan="2" class="hg"> Tuổi </th>
                                <th rowspan="2" class="hg">Trang Thái </th>
                            </tr>
                            <tr >
                                <th style="text-align: center;">Xem thông tin</th>
                                <th style="text-align: center;">Xóa</th>
                            </tr>
                           @foreach($users as $item)
                               <tr>
                                    <td>{{  $item->id }}</th>
                                    <td>{{ $item->u_name }}</td>
                                    <td>
                                         <span> {{ $item->u_email }}</span>
                                    </td>
                                    <td>
                                        <span> {{ $item->u_age == 0  ? "Chưa cập nhật" :  $item->u_age }}</span>
                                    </td>
                                    <td>
                                            <a href="{{ route('admin.users.viewdiem',$item->id) }}" class="btn btn-xs btn-success">  Xem điểm thi</a>
                                    </td>
                                    <td class="text-center">
                                        {!! renderBtnEdit(route('admin.users.edit',$item->id)) !!}
                                    </td>
                                    <td class="text-center">
                                        {!! renderBtnDelete(route('admin.users.delete',$item->id)) !!}
                                    </td>
                                </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         <!-- /.box-body -->
            <div class="box-footer">
                {!! renderPaginate($users,$finter) !!}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
@endsection
</script>
