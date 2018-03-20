@extends('frontend.layout')
@section('title', '龍德堂陶艺 | 关于我们')
@section('body_class', 'LC_Page_AboutUs')
@section('content')
    <style>
        .artist_list {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 100px 30px;
        }

        .artist_list .picture {
            width: 42%;
            float: left;
            box-sizing: border-box;
        }

        .artist_list .picture img {
            width: 90%;
            display: block;
            margin-left: 5%;
        }

        .artist_list .detail {
            width: 42%;
            float: left;
            margin-left: 5%;
        }

        .artist_list .detail .part {
            width: 100%;
        }

        .artist_list .detail .part h2 {
            font-size: 20px;
            margin: 0 0 30px;
            text-align: left;
            font-weight: normal;
            letter-spacing: 0.1em;
            font-family: 微软雅黑, 'Roboto', sans-serif Arial, Helvetica;
            position: relative;
            z-index: 5;
        }

        .artist_list .detail .part h2:after {
            content: "";
            display: block;
            width: 50px;
            border-bottom: 2px solid #000;
            position: absolute;
            bottom: 0;
            left: 0;
            top: 30px;
        }

        .deline {
            margin-bottom: 30px;
        }

        .artist_list .detail .part p {
            padding-left: 20px;
            font-size: 14px;
            text-indent: 20px;
            text-align: justify;
            text-justify: inter-ideograph;
        }

        .introduce {
            width: 90%;
            margin: 0 auto;
            margin-top: 60px;
        }

        .introduce .int_list {
            width: 100%;
            margin: 0 auto;
            background: #f8f8f8;
            padding-top: 20px;
            padding-bottom: 30px;
        }

        .introduce .int_list ul li {
            width: 33.3%;
            float: left;
            text-align: center;
        }

        .introduce .int_list ul li p {
            line-height: 30px;
            position: relative;
            font-family: 微软雅黑, 'Roboto', sans-serif Arial, Helvetica;
            font-size: 12px;
        }

        .ditu {
            margin-left: 33.3%;
            margin-top: 30px;
        }

        .introduce .int_list ul li p img {
            position: absolute;
            top: 0;
            width: 30px;
        }

        .introduce .int_list ul li {
            width: 33.3%;
            float: left;
            text-align: center;
        }

        .map {
            width: 100%;
        }

        }
        @media print, screen and (min-width: 960px) and (max-width: 1060px) {
            .artist_list {
                width: 94%;
                margin: 0 auto;
                padding: 0;
                padding-bottom: 30px;
            }

            .artist_list .detail {
                width: 50%;
                float: left;
                margin-left: 5%;
            }

            .artist_list .detail .part {
                width: 100%;
            }

            .artist_list .detail .part p {
                padding-left: 20px;
                font-size: 14px;
                line-height: 24px;
                text-indent: 20px;
                text-align: justify;
                text-justify: inter-ideograph;
            }

            .introduce {
                width: 94%;
                margin: 0 auto;
                margin-top: 30px;
            }
        }

        @media print, screen and (max-width: 959px) and (min-width: 768px) {
            .artist_list {
                width: 94%;
                margin: 0 auto;
                padding: 0;
                padding-bottom: 30px;
            }

            .artist_list .detail {
                width: 50%;
                float: left;
                margin-left: 5%;
            }

            .artist_list .detail .part {
                width: 100%;
            }

            .artist_list .detail .part p {
                padding-left: 20px;
                font-size: 14px;
                line-height: 24px;
                text-indent: 20px;
                text-align: justify;
                text-justify: inter-ideograph;
            }

            .introduce {
                width: 94%;
                margin: 0 auto;
                margin-top: 30px;
            }
        }

        @media screen and (max-width: 767px) {
            .artist_list {
                width: 94%;
                margin: 0 auto;
                padding: 0;
            }

            .artist_list .picture {
                width: 100%;
            }

            .artist_list .picture img {
                width: 100%;
                display: block;
                margin-left: 0;
            }

            .artist_list .detail {
                width: 100%;
                margin: 0 auto;
            }

            .artist_list .detail .part {
                width: 100%;
            }

            .artist_list .detail .part h2 {
                font-size: 20px;
                margin: 10px 0 10px;
                text-align: left;
                font-weight: normal;
                letter-spacing: 0.1em;
                font-family: 微软雅黑, 'Roboto', sans-serif Arial, Helvetica;
                position: relative;
                z-index: 5;
            }

            .artist_list .detail .part h2:after {
                content: "";
                display: block;
                width: 30px;
                border-bottom: 1px solid #000;
                position: absolute;
                bottom: 0;
                left: 0;
                top: 30px;
            }

            .deline {
                margin-bottom: 0px;
            }

            .artist_list .detail .part p {
                padding-left: 0px;
                font-size: 14px;
                text-indent: 20px;
                text-align: justify;
                text-justify: inter-ideograph;
            }

            .introduce {
                width: 100%;
                margin: 0 auto;
                margin-top: 30px;
            }

            .introduce .int_list {
                width: 94%;
                padding-left: 3%;
                padding-right: 3%;
                margin: 0 auto;
                background: #f8f8f8;
                padding-top: 0px;
                padding-bottom: 0px;
            }

            .introduce .int_list ul li {
                width: 100%;
                float: left;
                height: 2.8rem;
                border-bottom: 1px solid #e2e2e2;
            }

            .introduce .int_list ul li p {
                line-height: 2.8rem;
                position: relative;
                font-family: 微软雅黑, 'Roboto', sans-serif Arial, Helvetica;
                font-size: 12px;
                text-align: left;
            }

            .ditu {
                margin-left: 0;
                margin-top: 0px;
            }

            .introduce .int_list ul li p img {
                position: absolute;
                top: 0.8rem;
                width: 1.2rem;
            }

            footer nav.fNavi {
                margin: 0 auto;
                padding: 0 0 30px;
                border-bottom: 1px solid #dddddd;
                position: relative;
                width: 100%;
            }

        }
    </style>
    <div id="container" class="clearfix">
        <div id="main_column" class="colnum1">
            <div id="undercolumn">
                <div class="Breadcrumb">
                    <ul id="crumbs">
                        <li><a href="{{url('/')}}"><span>首页</span></a></li>
                        <li><span>关于我们</span></li>
                    </ul>
                </div>
                <h1 class="title">ABOUT US</h1>
                <div class="artist_list clearfix">
                    <section>
                        <div class="picture">
                            <img src="{{asset('frontend/img/AU_1.jpg')}}"/>
                        </div>
                        <div class="detail">
                            <div class="part">
                                <h2>宜兴紫砂</h2>
                                <p>宜兴陶都自古以来以紫砂驰名天下。
                                    紫砂壶以其素面素心和特有的宜茶性而称著于世，“外类紫玉，内如碧玉”，尝其风采，“温润如君子，豪迈如丈夫，丽娴如佳人。”</p>
                                <p>因集功能美、造型美、材质美、工艺美、品味美于一体，汇诗词、绘画、篆刻于一身，而深受人们的钟爱。</p>
                                <p class="deline">“珍惜宝爱，不啻掌珠”。</p>
                                <h2>龙德堂</h2>
                                <p>
                                    龙德堂紫砂是宜兴紫砂中的一枝奇葩，拥有几十位陶艺工作者，技术力量雄厚，产品独特，品质优良，每件作品设计精心，用料考究，实用方便，力求完美。以朴实的语言，强烈的情感来体现每件作品的艺术生命，至善至美！</p>
                                <p> “竹沥水煮茶味真，疏香沾齿韵怡人，何来月下烟岚色，龙德堂壶凤凰春。”这正是对龙德堂作品的赞美。</p>
                            </div>
                        </div>
                        <div style="clear:both"></div>
                    </section>

                    <div class="introduce">
                        <div class="int_list">
                            <ul>
                                <li>
                                    <p><img src="{{asset('frontend/img/common/icon_phone.jpg')}}"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0510-83511666
                                    </p>
                                </li>
                                <li>
                                    <p><img src="{{asset('frontend/img/common/icon_index.jpg')}}"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;江苏省无锡市宜兴市丁蜀镇西望村
                                    </p>
                                </li>
                                <li>
                                    <p><img src="{{asset('frontend/img/common/icon_mail.jpg')}}"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;937647848@qq.com
                                    </p>
                                </li>
                                <li class="ditu">
                                    <p><img src="{{asset('frontend/img/common/icon_adress.jpg')}}"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地图上的具体位置
                                    </p>
                                </li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <img class="map" src="{{asset('frontend/img/common/map.jpg')}}"/>
                    </div>
                </div>
            </div>
            @include('frontend.dictionary')
        </div>
    </div>
@endsection