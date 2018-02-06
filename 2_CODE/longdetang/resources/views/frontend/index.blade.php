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
    <link rel="stylesheet" href="{{asset('frontend/css/import.css')}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{asset('frontend/js/swiper/swiper.min.css')}}" type="text/css" media="all"/>
    <script src="{{asset('frontend/js/jquery-2.1.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/eccube.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/eccube.legacy.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/swiper/swiper.min.js')}}"></script>
    <style>
        #stage_pc {
            display: block;
        }
        #stage2_sp {
            display: none;
        }
        @media screen and (max-width: 767px) {
            #stage_pc {
                display: none;
            }
            #stage2_sp {
                display: block;
            }
        }
        #stage_pc .swiper-pagination-bullet, #stage2_sp .swiper-pagination-bullet {
            width: 29px;
            height: 4px;
            border-radius: 4px;
        }
        #stage_pc .swiper-pagination-bullet-active, #stage2_sp .swiper-pagination-bullet-active {
            background: white;
        }

        .pic_bg {
            text-align: center;
            background: url('{{asset('/assets/img/noimage.png')}}');
            background-position: center;
            background-repeat: no-repeat;
            background-color: rgb(230,230,230);
            background-size: cover;
        }
    </style>
    <script type="text/javascript">//<![CDATA[
        $(function () {
            var mySwiper = new Swiper ('#stage_pc', {
                speed: 800,
                // autoplay: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                }
            });
            var mySwiper = new Swiper ('#stage2_sp', {
                speed: 800,
                // autoplay: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                }
            });
            $('[data-href]').click(function () {
                location.href = $(this).data()['href'];
            })
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
                    <div class="logo"><img src="{{asset('frontend/img/top/logo.png')}}" width="80" style="vertical-align: center" alt="KIDORI"/>
                    </div>
                    {{--<h1 style="font-size: 19px;font-family: 黑体">龙德堂陶艺<br>竹沥水煮茶味真，疏香沾齿韵怡人。<br>何来月下烟岚色，龙德堂壶凤凰春。<br>方圆自在，紫玉梵音。</h1>--}}
                    <div id="stage_pc" class="pc swiper-container">
                        <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                            <div id="photo{{$loop->index + 1}}" class="pic swiper-slide">
                                <img  style="width: 100%;" src="{{storage_url($banner->pic)}}">
                            </div>
                        @endforeach
                        </div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div id="stage2_sp" class="swiper-container">
                        <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                            <div id="photo{{$loop->index + 1}}" class="pic swiper-slide">
                                <img style="width: 100%;" src="{{storage_url($banner->mobile_pic)}}" alt="龙德堂"/>
                            </div>
                        @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <nav class="topNavi">
                    @include('frontend.menu')
                </nav>
                <style>
                    @media screen and (max-width: 767px) {
                        #hot_recom_pc {
                            display: none;
                        }
                        #hot_recom_sp {
                            display: block !important;
                        }
                    }
                </style>
                @if(!empty($hotRecoms))
                <div id="hot_recom_pc" style="width: 100%;height: 250px;margin-bottom: 3%;">
                    <div style="width: 32.8%;height: 100%;float: left;margin: .1%;">
                        <a href='{{isset($hotRecoms['left_top']['link']) ? $hotRecoms['left_top']['link'] : ''}}'>
                        <div data-position="left_top"  style="width: 100%;height: 49.5%;margin-bottom: .5%;background-image: url('{{isset($hotRecoms['left_top']['pic']) ? storage_url($hotRecoms['left_top']['pic']) : ''}}')" class="pic_bg">

                        </div>
                        </a>
                        <a href='{{isset($hotRecoms['left_bottom']['link']) ? $hotRecoms['left_bottom']['link'] : ''}}'>
                        <div data-position="left_bottom" style="width: 100%;height: 49.5%;margin-top: .5%;background-image: url('{{isset($hotRecoms['left_bottom']['pic']) ? storage_url($hotRecoms['left_bottom']['pic']) : ''}}')" class="pic_bg" >

                        </div>
                        </a>
                    </div>
                    <a href='{{isset($hotRecoms['center']['link']) ? $hotRecoms['center']['link'] : ''}}'>
                    <div data-position="center" style="width: 44.8%;height: 100%;float: left;margin: .1%;background-image: url('{{isset($hotRecoms['center']['pic']) ? storage_url($hotRecoms['center']['pic']) : ''}}')" class="pic_bg" >

                    </div>
                    </a>
                    <div style="width: 21.8%;height: 100%;float: left;margin: .1%;">
                        <a href='{{isset($hotRecoms['right_top']['link']) ? $hotRecoms['right_top']['link'] : ''}}'>
                        <div data-position="right_top" style="width: 100%;height: 49.5%;margin-bottom: .5%;background-image: url('{{isset($hotRecoms['right_top']['pic']) ? storage_url($hotRecoms['right_top']['pic']) : ''}}')" class="pic_bg" >

                        </div>
                        </a>
                        <a href='{{isset($hotRecoms['right_bottom']['link']) ? $hotRecoms['right_bottom']['link'] : ''}}'>
                        <div data-position="right_bottom" style="width: 100%;height: 49.5%;margin-top: .5%;background-image: url('{{isset($hotRecoms['right_bottom']['pic']) ? storage_url($hotRecoms['right_bottom']['pic']) : ''}}')" class="pic_bg" >

                        </div>
                        </a>
                    </div>
                </div>
                 <div id="hot_recom_sp" style="width: 100%;position: relative;display: none;background: white;line-height: 3px;">
                         @if(isset($hotRecoms['left_top']) )
                         <img data-href="{{$hotRecoms['left_top']['link']}}" src="{{isset($hotRecoms['left_top']['pic']) ? storage_url($hotRecoms['left_top']['pic']) : ''}}" style="width: 100%;height: auto;max-height: 150px;">
                         @endif
                         @if(isset($hotRecoms['left_bottom']) )
                                 <img data-href="{{$hotRecoms['left_bottom']['link']}}" src="{{isset($hotRecoms['left_bottom']['pic']) ? storage_url($hotRecoms['left_bottom']['pic']) : ''}}" style="width: 100%;height: auto;max-height: 150px;margin-top: 2px;">
                         @endif
                         @if(isset($hotRecoms['center']) )
                                 <img data-href="{{$hotRecoms['center']['link']}}" src="{{isset($hotRecoms['center']['pic']) ? storage_url($hotRecoms['center']['pic']) : ''}}" style="width: 100%;height: auto;max-height: 150px;margin-top: 2px;">
                         @endif
                         <div style="width: 100%;margin-top: 2px;">
                             @if(isset($hotRecoms['right_top']) )
                                 <img data-href="{{$hotRecoms['right_top']['link']}}" src="{{isset($hotRecoms['right_top']['pic']) ? storage_url($hotRecoms['right_top']['pic']) : ''}}" style="width: 50%;height: auto;border-right:1px solid transparent;float: left;max-height: 150px;box-sizing: border-box;">
                             @endif
                             @if(isset($hotRecoms['right_bottom']) )
                                     <img data-href="{{$hotRecoms['right_bottom']['link']}}" src="{{isset($hotRecoms['right_bottom']['pic']) ? storage_url($hotRecoms['right_bottom']['pic']) : ''}}" style="width: 50%;border-left:1px solid transparent;height: auto;float: left;max-height: 150px;box-sizing: border-box;">
                             @endif
                             <div style="clear: both;"></div>
                         </div>
                 </div>
                @endif
                @foreach($categorys as $category)
                    <div class="contentsBlock contents0{{$loop->index % 2 == 0 ? '1' : '2'}}">
                        {{--<div class="titleBlock">--}}
                            {{--<h2 style="background-image: url('{{storage_url($category->thumbnail)}}');background-size:13%;">{{$category->name}}<br/><span>{{$category->pinyin}}</span></h2>--}}
                            {{--<p class="read">{{$category->ad_slogan}}</p>--}}
                            {{--<p>{{$category->explain}}</p>--}}
                        {{--</div>--}}
                        <div  onclick="location.href='{{url('/prod?category_id=').$category->id}}'" class="mainImage"
                             style="background-image:url({{storage_url($category->pic)}});cursor: pointer">
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
