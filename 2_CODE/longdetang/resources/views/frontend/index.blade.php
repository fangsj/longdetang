<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no, email=no, address=no">
    <title>龍德堂陶艺</title>
    <link rel="shortcut icon" href="{{asset('frontend/img/common/favicon.ico')}}"/>
    <link rel="icon" type="image/vnd.microsoft.icon" href="{{asset('frontend/img/common/favicon.ico')}}"/>
    <link rel="apple-touch-icon" href="{{asset('frontend/img/common/apple-touch-icon.png')}}">
    <link rel="stylesheet" href="{{asset('frontend//css/import.css')}}" type="text/css" media="all"/>
    <script src="{{asset('frontend/js/jquery-2.1.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/eccube.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/eccube.legacy.js')}}"></script>
    <script type="text/javascript">//<![CDATA[
        $(function () {
        });
        //]]></script>


</head>
<!-- ▼BODY部 スタート -->

<body class="LC_Page_Index">
<div class="frame_outer">
    <header>
        <form name="header_login_form" id="header_login_form" method="post"
              action="https://ki-do-ri.jp/frontparts/login_check.php"
              onsubmit="return eccube.checkLoginFormInputted('header_login_form')">
            <input type="hidden" name="mode" value="login"/>
            <input type="hidden" name="transactionid" value="2fb4f8d046b0ae4093da7705df95299659118ea6"/>
            <input type="hidden" name="url" value="/"/>
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
        </form>
    </header>
    <nav class="spNavi">
        @include('frontend.menu')
    </nav>
    <!--▲HEADER-->

    <div id="container" class="clearfix" style="padding-top: 34px;">
        <div id="main_column" class="colnum1"><!-- ▼メイン -->

            <section class="top">
                <div class="main">
                    <div class="logo"><img src="{{asset('frontend/img/top/logo.svg')}}" width="165" alt="KIDORI"/>
                    </div>
                    <h1>植物と暮らそう<br>小さな自然と四季を見つめながら<br>何気ない日常を 心地よく 豊かに<br>緑で、気取りを。</h1>
                    <div id="stage" class="pc">
                        @foreach ($banners as $banner)
                            <div id="photo{{$loop->index + 1}}" class="pic">
                                <div style="background-image:url({{storage_url($banner->pic)}});"></div>
                            </div>
                        @endforeach
                    </div>
                    <div id="stage" class="sp">
                        @foreach ($banners as $banner)
                            <div id="photo{{$loop->index + 1}}" class="pic">
                                <div><img src="{{storage_url($banner->mobile_pic)}}" alt="龙德堂"/></div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <nav class="topNavi">
                    @include('frontend.menu')
                </nav>
                @foreach($categorys as $category)
                    <div class="contentsBlock contents0{{$loop->index % 2 == 0 ? '1' : '2'}}">
                        <div class="titleBlock">
                            <h2 style="background-image: url('{{storage_url($category->thumbnail)}}');background-size:13%;">{{$category->name}}
                                <br>
                                <span>{{$category->pinyin}}</span></h2>
                            <p class="read">{{$category->ad_slogan}}</p>
                            <p>{{$category->explain}}</p>
                        </div>
                        <div class="mainImage"
                             style="background-image:url({{storage_url($category->pic)}});">
                        </div>
                        <div class="items" style="background-color: {{$category->bg_color}}">
                            <ul class="clearfix">
                                @foreach($category->prods as $prod)
                                    <li>
                                        <div class="thumb">
                                            <a href="{{url('/prod/detail?id='.$prod->id)}}">
                                                <img src="{{storage_url($prod->pic)}}" alt="{{$prod->name}}"/>
                                            </a>
                                        </div>
                                        <p>{{$prod->name}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </section>
            <section class="concept" style="padding-top: 10px;">
                <div class="logo"><img src="{{asset('frontend/img/common/logo.svg')}}" alt=""/></div>
                <h2>龙德堂的文化背景历史人物</h2>
                <p class="jp">驿站之外的断桥边，梅花孤单寂寞地淀开了花，无人过问。<br>
                    暮色降临，梅花无依无靠，已经够愁苦了，却又遇到了风雨的摧残。<br>
                    梅花并不像费劲心思去争艳斗宠，对百花的嫉妒排斥毫不在乎。<br>
                    即使凋零了，被碾作泥土，又化作尘土了，梅花依然和往常一样散发出屡屡清香
                </p>
                <p class="en"><b>“Green” will bring some color to your everyday life.</b></p>
                <p class="en">KIDORI plants, each perfected by craftsmen,are full of uniqueness.<br>
                    Add comfort and richness to your simple everyday life with a special pot.<br>
                    A sense of “green” with KIDORI.
                </p>
            </section>
        @include('frontend.dictionary')
        </div>
    </div>
    @include('frontend.footer')
</div>
<script type="text/javascript" src="{{asset('frontend/js/common.js')}}"></script>
</body>
</html>
