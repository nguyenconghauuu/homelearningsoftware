<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>FormLogin</title>
</head>
<style>
    .img-logo {
        width: 8%;
    }

    .body {
        margin: auto;

    }

    .form-login {
        width: 400px;
        height: auto;
        margin: auto;
    }

    .login {
        padding: 30px;
    }

    .lostpassword {
        margin-top: 20px;
        text-align: center;
    }

    .register {
        display: flex;
        flex-direction: row;
    }

    .register {
        margin-top: 10px;
        margin-left: 40px;
    }
</style>

<body>
<a href="/"><img style="width:120px;" src="{{ asset('logo_account.jpg') }}" alt=""></a>
<div class="form-login border rounded shadow p-3 mb-5 bg-white rounded" style="margin-top:50px;">

    <h3 style="padding:20px 0px 0px 30px ; text-align: center">Đăng nhập</h3>
    @if(session('message'))
        <p style="color: red;text-align: center">{{session('message')}}</p>
    @endif
    <form class="login" action="" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input style="height: 50px;" name="u_email" type="email" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp"
                   placeholder="Nhập email">
            @if ($errors->has('u_email'))
                <span class="help-block">
                    <strong>{{ $errors->first('u_email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mật khẩu</label>
            <input style="height: 50px;" name="u_password" type="password" class="form-control"
                   id="exampleInputPassword1" placeholder="Nhập mật khẩu">
            @if ($errors->has('u_password'))
                <span class="help-block">
                    <strong>{{ $errors->first('u_password') }}</strong>
                </span>
            @endif
        </div>
        <button style="width: 100%;height: 50px;border-radius: 30px;" type="submit" class="btn btn-primary">Đăng nhập
        </button>
        <div class="register">
            <p>Bạn cần một tài khoản ? </p><a href="{{ route('dangky.user') }}">Đăng ký</a>
        </div>
        <p><a href="{{ route('get.forgot_password') }}">Quên mật khẩu</a>
    </form>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script>

</script>

</html>
