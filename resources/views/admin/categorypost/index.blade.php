@extends('admin.layouts.app')
@section('title','Danh sách danh mục bài viết ')
@section('main-content')
    <section class="content-header">
        <h1>
            Danh sách danh mục bài viết         </h1>
        
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <a href="{{ route('admin.categorypost.add') }}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>
            </div>
            <div class="box-header with-border">
                <form action="" method="get" class="form-inline">
                    <input type="text" class="form-control"  placeholder=" Tên bài  viết tìm kiếm " autocomplete="off" name="title"  value="{{ Request::get('title') }}" style="width: 80%;margin:5px 0"/>
                    <div class="" style="margin-top: 5px;display: inline-block">
                        <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-search"></i> Tìm kiếm </button>
                    </div>
                </form>
            </div>
            @include('admin.notification.index')
            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            @if($sortCategoryPost && count($sortCategoryPost) > 0)
                                @foreach($sortCategoryPost as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><?php for($i = 0; $i < $item->level; $i ++) echo ' |--- '; ?> {{ $item->cpo_name }}</td>
                                        <td>
                                            {!! renderBtnEdit(route('admin.categorypost.edit',$item->id)) !!}
                                            {!! renderBtnDelete(route('admin.categorypost.delete',$item->id)) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- /.box -->
    </section>
@endsection
