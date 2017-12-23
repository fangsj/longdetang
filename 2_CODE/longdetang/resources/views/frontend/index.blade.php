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
                    <h1>龙德堂陶艺<br>竹沥水煮茶味真，疏香沾齿韵怡人。<br>何来月下烟岚色，龙德堂壶凤凰春。<br>方圆自在，紫玉梵音。</h1>
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
                <p class="jp">龙德堂紫砂是宜兴紫砂中的一枝奇葩，<br>
                    拥有几十位陶艺工作者，技术力量雄厚，产品独特，<br/>
                    品质优良，每件作品设计精心，用料考究，实用方便，<br>
                    力求完美。以朴实的语言，强烈的情感来<br>
                    体现每件作品的艺术生命，至善至美！<br>“竹沥水煮茶味真，疏香沾齿韵怡人，<br/>何来月下烟岚色，龙德堂壶凤凰春。”<br>
                    这正是对龙德堂作品的赞美。
                </p>
                <p class="en"><b>LONGDETANG is one of the best in yixing zisha group.</b></p>
                <p class="en">It has dozens of potter workers, strong technical skills,unique products, excellent quality.<br>Each piece is carefully designed,with good materials, practical and convenient, striving for perfection.<br/>With the simple language, strong emotion to embody the artistic life of each piece, to the beauty!
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
