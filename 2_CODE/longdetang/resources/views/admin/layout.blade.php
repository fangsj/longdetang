<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')-龙德堂管理平台</title>

    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('/assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('/assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/js/plugins/bootstrap-dialog/css/bootstrap-dialog.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/animate.css')}}" rel="stylesheet">
    @stack('styles')
    @stack('css-plugin')
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/mystyle.css')}}" rel="stylesheet">
    <script>
        function assets(url) {
            return '{{asset('/')}}assets' + url;
        }
        var storage = '{{storage_url('')}}'
        function file(url) {
            return storage + '/' + url;
        }
        function accessDefine() {
            
        }
    </script>
</head>

<body class="{{empty($_COOKIE['skin']) ? 'skin-1' : $_COOKIE['skin']}}">
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{asset('/assets/img/profile_small.jpg')}}" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs"> <strong class="font-bold">龙德堂</strong>
                                </span>
                                <span class="text-muted text-xs block">系统管理员 <b class="caret"></b>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">个人信息</a></li>
                            <li class="divider"></li>
                            <li><a name="logoutBtn" href="javascript:;">退出系统</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        龙德堂
                    </div>
                </li>
                <li data-menu-link="{{ admin('/prod')  }}" data-menu-code="001">
                    <a><i class="fa fa-shopping-cart"></i> <span class="nav-label">商品管理</span></a>
                </li>
                <li data-menu-link="{{ admin('/prod/category')  }}" data-menu-code="002">
                    <a><i class="fa fa-sitemap"></i> <span class="nav-label">商品分类</span></a>
                </li>
                <li data-menu-link="{{ admin('/artist')  }}" data-menu-code="003">
                    <a><i class="fa fa-diamond"></i> <span class="nav-label">艺人管理</span></a>
                </li>
                <li data-menu-link="{{ admin('/video')  }}" data-menu-code="004">
                    <a><i class="fa fa-video-camera"></i> <span class="nav-label">视频管理</span></a>
                </li>
                <li data-menu-link="{{ admin('/article')  }}" data-menu-code="006">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">新事管理</span></a>
                </li>
                <li data-menu-link="{{ admin('/banner')  }}" data-menu-code="005">
                    <a><i class="fa fa-picture-o"></i> <span class="nav-label">首页轮播</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">欢迎使用龙德堂管理平台！</span>
                    </li>

                    <li>
                        <a name="logoutBtn" href="javascript:;">
                            <i class="fa fa-sign-out"></i> 退出系统
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a class="right-sidebar-toggle">--}}
                            {{--<i class="fa fa-tasks"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>

            </nav>
        </div>
        {{--@if(!Request::is('admin'))--}}
        {{--<div class="row wrapper border-bottom white-bg page-heading">--}}
            {{--@yield('breadcrumb')--}}
        {{--</div>--}}
        {{--@endif--}}
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                @yield('content')
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> 版权所有 © 2017
            </div>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('/assets/js/plugins/jquery.min.js')}}"></script>
<script src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('/assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('/assets/js/inspinia.js')}}"></script>
<script src="{{asset('/assets/js/plugins/pace/pace.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('/assets/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- GITTER -->
<script src="{{asset('/assets/js/plugins/gritter/jquery.gritter.min.js')}}"></script>

<script type="application/javascript" src="{{asset('/assets/js/plugins/bootstrap-dialog/js/bootstrap-dialog.min.js')}}"></script>
@stack('js-plugin')
<script>
    buildOPT = function (opt) {
        if (opt && (typeof opt == 'string' || typeof opt == 'number')) {
            opt = {
                'message': opt
            };
        }
        else {
            opt = opt || {};
        }
        return opt;
    };

    alert = function (opt) {
        opt = buildOPT(opt);
        BootstrapDialog.alert({
            title: opt.title || '系统操作提示!',
            message: opt.message || '',
            closable: true,
            type: opt.type || BootstrapDialog.TYPE_PRIMARY,
            size: BootstrapDialog.SIZE_SMALL,
            buttonLabel: opt.label || '确 认',
            callback: function () {
                opt.callback && opt.callback();
            }
        });
    };

    alert.info = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_INFO;
        alert(opt);
    };

    alert.success = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_SUCCESS;
        alert(opt);
    };

    alert.warning = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_WARNING;
        alert(opt);
    };

    alert.danger = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_DANGER;
        alert(opt);
    };

    confirm = function (opt) {
        opt = buildOPT(opt);
        BootstrapDialog.confirm({
            title: opt.title || '系统提示！',
            message: opt.message || '请确认操作',
            type: opt.type || BootstrapDialog.TYPE_PRIMARY,
            size: opt.size || BootstrapDialog.SIZE_SMALL,
            callback: function (r) {
                //确认按钮函数回调
                (r && opt.callbacks && opt.callbacks[0]) && opt.callbacks[0]();
                //非确认按钮函数回调
                (!r && opt.callbacks && opt.callbacks[1]) && opt.callbacks[1]();
            }
        });
    };

    confirm.info = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_INFO;
        confirm(opt);
    };

    confirm.success = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_SUCCESS;
        confirm(opt);
    };

    confirm.warning = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_WARNING;
        confirm(opt);
    };

    confirm.danger = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_DANGER;
        confirm(opt);
    };

    confirm.primary = function (opt) {
        opt = buildOPT(opt);
        opt.type = BootstrapDialog.TYPE_PRIMARY;
        confirm(opt);
    };
    ctx = baseUrl= "{{admin('/')}}";
    var url = function (oldUrl, params) {
        return ctx + assembleURL(oldUrl, params);
    };
    window.assembleURL = function (url, params, hash, encode) {
        var queryString = "";
        if (params) {
            for (var key in params) {
                var value = params[key];
                if (value && (value instanceof Array)) {
                    for (var index in value) {
                        queryString += key + "=" + value[index] + "&";
                    }
                }
                else {
                    queryString += key + "=" + value + "&";
                }
            }
        }
        if (queryString) {
            queryString = queryString.substr(0, queryString.length - 1);
            if (url.lastIndexOf("?") > 0) {
                queryString = "&" + queryString;
            }
            else {
                queryString = "?" + queryString;
            }
        }
        if (hash) queryString = "#" + hash;
        return url + queryString;
    };

    window.redirect = function (url, params, hash, encode) {
        location.href = assembleURL(url, params, hash, encode);
    };
    $(function () {
        $('[data-menu-code='+ localStorage.getItem("selectedMenu") +']').addClass('active');

        $('[data-menu-link]').click(function () {
            location.href = $(this).data('menuLink');
            localStorage.setItem("selectedMenu", $(this).data('menuCode'))
        });
        $('[name=logoutBtn]').click(function () {
            confirm.warning({
                message: "确定要退出系统么?",
                callbacks: [function () {
                    redirect('{{admin('/logout')}}');
                }]
            });
        });
    })
</script>
@stack('scripts')
</body>
</html>
