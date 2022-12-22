@extends('admin.layouts.app')
@section('title',' Trang quản trị admin  ')
@section('main-content')
    <section class="content-header">
        <h1>
            Trang quản trị admin
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            @include('admin.notification.index')
            <h3 style="margin-top: -10px">TỔNG QUAN</h3>
            <div class="box-body border mr-t-10">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Danh mục</span>
                                <span class="info-box-number">{{ $totalCategory ?? 0 }}</span>
                                <a href="{{ route('admin.categorypost.index') }}">Xem thêm</a>
                            </div>

                        </div>

                    </div>


                    <div class="clearfix visible-sm-block"></div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><svg style="width:35%;padding-top:15px;color:white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 96c-17.7 0-32 14.3-32 32s-14.3 32-32 32s-32-14.3-32-32C0 75 43 32 96 32h97c70.1 0 127 56.9 127 127c0 52.4-32.2 99.4-81 118.4l-63 24.5 0 18.1c0 17.7-14.3 32-32 32s-32-14.3-32-32V301.9c0-26.4 16.2-50.1 40.8-59.6l63-24.5C240 208.3 256 185 256 159c0-34.8-28.2-63-63-63H96zm48 384c-22.1 0-40-17.9-40-40s17.9-40 40-40s40 17.9 40 40s-17.9 40-40 40z"/></svg></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Câu hỏi</span>
                                <span class="info-box-number">{{ $totalQuestions ?? 0 }}</span>
                                <a href="{{ route('admin.questions.index') }}">Xem thêm</a>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Thành viên</span>
                                <span class="info-box-number">{{ $totalUser ?? 0 }}</span>
                                <a href="{{ route('admin.users.index') }}">Xem thêm</a>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
        <!-- /.box -->
    </section>
@endsection
