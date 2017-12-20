<!DOCTYPE html>
<html xmlns:c="http://www.w3.org/1999/XSL/Transform">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('frontend/img/common/favicon.ico')}}"/>
    <title>龍德堂陶艺后台系统 | 登录</title>

    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg" style="padding-top: 8.5%;">
<div class="middle-box text-center loginscreen animated fadeInDown" style="border: 1px solid #e7eaec;background: white;width: 370px;border-radius: 10px;box-shadow: 1px -1px 15px #e5e5e5;padding-top: 0; padding-bottom: 25px;">
    <div style="margin-bottom: 20px;width: 100%;background: #0e9aef;padding: 16px 0;border-top-left-radius:10px;border-top-right-radius:10px;">
        <h2 style="font-weight: 400;color: white;margin: 0;">龍德堂后台系统</h2>
    </div>
    <form style="padding:10px 40px;" class="m-t" role="form" id="loginForm" action="{{ route('admin.login') }}" method="post">
    <div class="form-group" style="margin-bottom: 22px;text-align: left;">
        <input type="text" class="form-control {{ $errors->has('username') ? ' error' : '' }}" name="username" placeholder="请输入手机号或用户名" required  autocomplete="off" style="height: 35px;border-radius: 3px;" aria-required="true" value="{{old('username')}}">
        @if ($errors->has('username'))
        <label id="username-error" class="error" for="username">{{ $errors->first('username') }}</label>
        @endif
    </div>
    <div class="form-group" style="margin-bottom: 22px;text-align: left;">
        <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' error' : '' }}" placeholder="请输入密码" required autocomplete="off" style="height: 35px;border-radius: 3px;" aria-required="true">
        @if ($errors->has('password'))
        <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
        @endif
    </div>
    <button type="submit" class="btn btn-primary block full-width m-b" style="margin-top: 35px;background: #0e9aef">登录</button>
    </form>
    <p class="m-t"> <small>龍德堂版权所有© 2017</small> </p>
</div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('/assets/js/plugins/jquery.min.js')}}"></script>
<script src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/validate/jquery.validate.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#loginForm").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
                username: {
                    required: true
                }
            },
            messages: {
                password: {
                    required: "密码不能为空",
                    minlength: "密码至少6位"
                },
                username: {
                    required: "用户名不能为空"
                }
            }
        });

        $(document).keypress(function(e) {
            if (e.which == 13) {
                if ($('#loginForm').validate().form()) {
                    $('#loginForm').submit();
                }
                return false;
            }
        });
    });
</script>
</body>

</html>
