<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Đăng nhập hệ thống website </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    {{-- <link rel="stylesheet" href="/admin/css/bootstrap.min.css"> --}}
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="/admin/css/font-awesome.min.css"> --}}
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="/admin/css/ionicons.min.css"> --}}
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="/admin/css/AdminLTE.min.css"> --}}
    <!-- iCheck -->
    <link rel="stylesheet" href="/css/all.css">
    <style>

    </style>
    <!-- Google Font -->
</head>
<body class="hold-transition login-page" >
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>ĐĂNG NHẬP</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg" style="color: red;">Xin chào Admin</p>
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" placeholder="Nhập email" autocomplete="off" value="">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if($errors->first('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" autocomplete="off" value="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if($errors->first('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="row">
                {{--<div class="col-xs-8">--}}
                    {{--<div class="checkbox icheck">--}}
                        {{--<label>--}}
                            {{--<input type="checkbox" name="remember"> Remember Me--}}
                        {{--</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
       
        <!-- /.social-auth-links -->
       
{{--        <a href="" class="text-center pull-right"> Đăng ký mới </a>--}}
        <div class="clearfix"></div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="/admin/js/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
{{--<script src="/admin/js/icheck.min.js"></script>--}}
<script>
//    $(function () {
//        $('input').iCheck({
//            checkboxClass: 'icheckbox_square-blue',
//            radioClass: 'iradio_square-blue',
//            increaseArea: '20%' // optional
//        });
//    });
</script>
</body>
</html>