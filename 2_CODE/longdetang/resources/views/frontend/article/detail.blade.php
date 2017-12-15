@extends('frontend.layout')
@section('title', '龍德堂陶艺 | 新事')
@section('body_class', 'LC_Page_Article_Detail')
@section('content')
    <style>
        .new_box{
            width:100%;
            background:#e5e5e5;
            position:relative;
            height:auto;
        }
        .new_box .new_detail {
            max-width: 960px;
            margin: 0 auto;
            width:48%;
            padding-left:1%;
            padding-right:1%;
            padding-bottom:1%;
            background:#ffffff;
        }
        .new_box .new_detail .box{
            width:100%;
        }
        .new_box .new_detail .box img{
            display:block;
            width:100%;
        }
        .new_box .new_detail .box h2{
            font-size:20px;
            margin:10px 0 0;
            text-align: left;
            font-weight:lighter;
            letter-spacing: 0.1em;
            font-family: Georgia, "Times New Roman", 'Noto Serif Japanese', "Hiragino Mincho ProN", "Hiragino Mincho Pro", 'Noto Sans Japanese', "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, "ＭＳ 明朝", serif;
            position: relative;
            z-index: 5;
            font-size:15px;
        }
        .new_box .new_detail .box p{
            font-size:12px;
            line-height:20px;
            text-align:justify;
            text-justify:distribute-all-lines;
            margin-top:5px;
            margin-bottom:10px;
        }
        .new_box .new_detail .box .box_small{
            width:100%;
            margin-top:40px;
            margin-bottom:40px;
        }
        .new_box .new_detail .box .box_small img{
            float:left;
            width:28%;
            display:block;
            margin-right:2%;
        }
        .new_box .new_detail .box .box_small h2{
            width:100%;
            color:#80090b;
            margin-top:0;
            font-size:15px;
            text-align: left;
            font-weight:lighter;
            letter-spacing: 0.1em;
            font-family: Georgia, "Times New Roman", 'Noto Serif Japanese', "Hiragino Mincho ProN", "Hiragino Mincho Pro", 'Noto Sans Japanese', "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, "ＭＳ 明朝", serif;

        }
        .new_box .new_detail .box .box_small p{
            width:100%;
            letter-spacing: 0.1em;
            font-family: Georgia, "Times New Roman", 'Noto Serif Japanese', "Hiragino Mincho ProN", "Hiragino Mincho Pro", 'Noto Sans Japanese', "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, "ＭＳ 明朝", serif;
            text-align:justify;
            text-justify:distribute-all-lines;
            font-size:12px;
            line-height:20px;
            color:#80090b;
        }

        .new_banner{
            width:100%;
            margin:0 0 30px;
        }
        .new_banner img{
            width:100%;
            display:block;
        }

        }
        @media print, screen and (min-width: 960px) and (max-width:1060px) {
            .new_box{
                width:100%;
                background:#e5e5e5;
                position:relative;
                height:auto;
            }
            .new_box .new_detail {
                margin: 0 auto;
                width:58%;
                padding-left:1%;
                padding-right:1%;
                padding-bottom:1%;
                background:#ffffff;
            }

        }

        @media print, screen and (max-width: 959px) and (min-width: 768px) {
            .new_box .new_detail {
                margin: 0 auto;
                width:68%;
                padding-left:1%;
                padding-right:1%;
                padding-bottom:1%;
                background:#ffffff;
            }

        }
        @media screen and (max-width: 767px) {
            .new_box{
                width:100%;
                background:#ffffff;
                position:relative;
                height:auto;
            }
            .new_box .new_detail {
                margin: 0 auto;
                width:94%;
                padding-bottom:1%;
                background:#ffffff;
            }

            .new_banner{
                width:100%;
                margin:0 0 30px;
            }
            .new_banner img{
                width:100%;
                display:block;
            }
            .new_box .new_detail .box .box_small{
                width:100%;
                margin-top:30px;
                margin-bottom:30px;
            }
            .new_box .new_detail .box .box_small img{
                float:left;
                width:32%;
                display:block;
                margin-right:2%;
            }


            footer nav.fNavi {
                margin: 0 auto;
                padding: 0 0 30px;
                border-bottom:1px solid #dddddd;
                position: relative;
                width:100%;
            }

        }
    </style>
    <div id="container" class="clearfix">
        <div id="main_column" class="colnum1">
            <div id="undercolumn">
                <div class="Breadcrumb">
                    <ul id="crumbs">
                        <li><a href="{{url('/')}}"><span>首页</span></a></li>
                        <li><span>新事</span></li>
                    </ul>
                </div>
                <h1 class="title">NEWS</h1>
                <div class="new_box">
                    <div class="new_detail">
                        {!! $content !!}
                    </div>
                </div>
            </div>
            @include('frontend.dictionary')
        </div>
    </div>
@endsection