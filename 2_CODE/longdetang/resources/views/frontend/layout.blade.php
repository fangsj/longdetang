<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no, email=no, address=no">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{asset('frontend/img/common/favicon.ico')}}"/>
    <link rel="icon" type="image/vnd.microsoft.icon" href="{{asset('frontend/img/common/favicon.ico')}}"/>
    <link rel="apple-touch-icon" href="{{asset('frontend/img/common/apple-touch-icon.png')}}">
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700">--}}
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">--}}
    <link rel="stylesheet" href="{{asset('frontend/css/import.css')}}" type="text/css" media="all"/>
    @stack('jquery-ui')
    <script src="{{asset('frontend/js/jquery-2.1.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/eccube.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/eccube.legacy.js')}}"></script>
    @stack('scripts')
    <script type="text/javascript">
        var baseURL = '{{url('/')}}/'
        var storage = '{{storage_url('')}}'
        function file(url) {
            return storage + '/' + url;
        }
        function url(relaURL) {
            return baseURL + relaURL
        }
    </script>
</head>
<body class="@yield('body_class')">
    <div class="frame_outer">
        <a name="top" id="top"></a>
        <header>
            <div class="logo">
                <a href="/">
                    <img style="width: 165px;height: auto;" src="{{asset('frontend/img/common/logo.svg')}}" alt="龙德堂">
                </a>
            </div>
            <nav class="memberNavi">
                <ul class="clearfix">
                    <li>
                        <div class="DSbtn">
                            <div class="hambarg"></div>
                            <div class="hambarg"></div>
                            <div class="hambarg"></div>
                        </div>
                    </li>
                </ul>
            </nav>
            <nav class="gNavi">
                @include('frontend.menu')
            </nav>
        </header>
        <nav class="spNavi">
            @include('frontend.menu')
        </nav>
        @yield('content')
        @include('frontend.footer')
    </div>
    @stack('bottom-scripts')
    <script type="text/javascript" src="{{asset('frontend/js/common.js')}}"></script>
</body>
</html>