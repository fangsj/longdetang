@extends('frontend.layout')
@section('title', '龍德堂陶艺 | 新事')
@section('body_class', 'LC_Page_Article_List')
@push('scripts')
    <style>
        .news_list .navi {
            padding: 0 20%;
        }
        .new_list {
            position: relative;
            max-width: 960px;
            margin: 0 auto;
            width: 50%;
            padding: 0 0 30px;
        }

        .new_list h2 {
            font-size: 20px;
            margin: 0;
            text-align: left;
            font-weight: lighter;
            letter-spacing: 0.1em;
            font-family: Georgia, "Times New Roman", 'Noto Serif Japanese', "Hiragino Mincho ProN", "Hiragino Mincho Pro", 'Noto Sans Japanese', "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, "ＭＳ 明朝", serif;
            position: relative;
            z-index: 5;
            font-size: 15px;
            border-bottom: 1px solid #eeeeee;
            cursor: pointer;
        }

        .new_list .date {
            width: 100%;
            border-bottom: 1px solid #eeeeee;
            height: 32px;
        }

        .new_list .date img {
            display: block;
            float: left;
            margin-right: 5px;
            width: 14px;
            margin-top: 9px;
        }

        .new_list .date p {
            float: left;
            line-height: 32px;
            font-size: 10px;
            font-style: italic;
            margin-right: 15px;
        }

        .new_list .box {
            width: 100%;
            margin-top: 20px;
        }

        .new_list .box .pic_box {
            width: 99%;
            padding: 0.5%;
            border: 1px solid #ffffff;
            background: #ddd;
            box-shadow: 0px 0px 8px 1px #ccc;
        }

        .new_list .box p {
            font-size: 12px;
            line-height: 20px;
            text-align: justify;
            text-justify: distribute-all-lines;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 10px;
        }

        .new_list .box .btn {
            display: block;
            position: relative;
            height: 32px;
            font-size: 13px;
            font-weight: bold;
            line-height: 32px;
            font-family: Georgia, "Times New Roman", 'Noto Serif Japanese', "Hiragino Mincho ProN", "Hiragino Mincho Pro", 'Noto Sans Japanese', "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, "ＭＳ 明朝", serif;
        }

        .new_list .box .btn span {
            display: block;
            float: left;
            margin-right: 3px;
            cursor: pointer;
        }

        .new_list .box .btn span img {
            width: 10px;
            display: block;
            margin-top: 13px;
        }

        .new_list .box .pic_box img {
            width: 100%;
            display: block;
            height: auto;
            cursor: pointer;
        }

        }

        @media screen and (min-width: 960px){
            .news_list .navi {
                padding: 0 10%;
            }
        }

        @media screen and (max-width: 959px) and (min-width: 768px) {
            .news_list {
                padding-bottom: 30px;
            }
            .news_list .navi {
                padding: 0 10%;
            }
        }

        @media screen and (max-width: 767px) {
            .news_list .navi {
                padding: 0 5%;
            }
            .new_list {
                position: relative;
                margin: 0 auto;
                width: 94%;
                padding: 0 0 10px;
            }

            .new_list h2 {
                font-size: 20px;
                margin: 0;
                text-align: left;
                font-weight: lighter;
                letter-spacing: 0.1em;
                font-family: Georgia, "Times New Roman", 'Noto Serif Japanese', "Hiragino Mincho ProN", "Hiragino Mincho Pro", 'Noto Sans Japanese', "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, "ＭＳ 明朝", serif;
                position: relative;
                z-index: 5;
                font-size: 15px;
                border-bottom: 1px solid #eeeeee;
            }

            .new_list .date {
                width: 100%;
                border-bottom: 1px solid #eeeeee;
                height: 32px;
            }

            .new_list .date img {
                display: block;
                float: left;
                margin-right: 5px;
                width: 14px;
                margin-top: 9px;
            }

            .new_list .date p {
                float: left;
                line-height: 32px;
                font-size: 10px;
                font-style: italic;
                margin-right: 15px;
            }

            .new_list .box {
                width: 100%;
                margin-top: 20px;
            }

            .new_list .box .pic_box {
                width: 99%;
                padding: 0.5%;
                border: 1px solid #ffffff;
                background: #ccc;
                box-shadow: 0px 0px 4px 1px #ddd;
            }

            .new_list .box p {
                font-size: 12px;
                line-height: 20px;
                text-align: justify;
                text-justify: distribute-all-lines;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                margin-top: 10px;
                cursor: pointer;
            }

            .new_list .box .btn {
                display: block;
                position: relative;
                height: 32px;
                font-size: 13px;
                font-weight: bold;
                line-height: 32px;
                font-family: Georgia, "Times New Roman", 'Noto Serif Japanese', "Hiragino Mincho ProN", "Hiragino Mincho Pro", 'Noto Sans Japanese', "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, "ＭＳ 明朝", serif;
            }

            .new_list .box .btn span {
                display: block;
                float: left;
                margin-right: 3px;
                cursor: pointer;
            }

            .new_list .box .btn span img {
                width: 10px;
                display: block;
                margin-top: 13px;
            }

            .new_list .box .pic_box img {
                width: 100%;
                display: block;
                height: auto;
            }

            .page_new {
                position: relative;
                max-width: 960px;
                margin: 0 auto;
                width: 94%;
            }

            .new_banner {
                width: 100%;
                margin: 0 0 30px;
            }

            .new_banner img {
                width: 100%;
                display: block;
            }

        }
    </style>
    <script src="{{asset('js/dicts.js')}}"></script>
    <script src="{{asset('js/vue.js')}}"></script>
    <script>
        $(function () {
            Vue.prototype.$http = $.ajax;
            Vue.prototype.$http.post = $.post;
            Vue.prototype.$http.get = $.get;
            Vue.prototype.$storage = storage + '/';
            Vue.prototype.$dicts = dicts;
            Vue.prototype.$baseURL = baseURL;
            var app = new Vue({
                el: '#container',
                data: {
                    article: {
                        pageSize: 16,
                        pageNumber: 1,
                        rows: [],
                        pages: 0,
                        total: 0,
                        pageNumberStart: 0,
                        nextPage: 0,
                        pervPage: 0
                    },
                },
                created: function() {
                    this.search(1)
                },
                methods: {
                    search: function(pageNumber) {
                        var _this = this;
                        this.$http.get('{{url('/article/list')}}', {
                            pageSize: this.article.pageSize,
                            pageNumber: pageNumber
                        }, function (data) {
                            window.scroll(0, 0);
                            _this.article = data
                            _this.article.nextPage = pageNumber + 1
                            _this.article.pervPage = pageNumber - 1
                            _this.article.pageNumberStart = (data.pageNumber - 2 > 0 ? data.pageNumber - 2 : 1)
                        }, 'json');
                    },
                    view (id) {
                        location.href = this.$baseURL + 'article/' + id
                    }
                }
            });
        });
    </script>
@endpush
@section('content')
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
                <div class="news_list clearfix">
                    <section>
                        <div v-for="item in article.rows" class="new_list clearfix" @click="view(item.id)">
                            <h2>@{{item.title || ''}}</h2>
                            <div class="date">
                                <img src="{{asset('frontend/img/common/icon_date.jpg')}}" />
                                <p>@{{item.publish_time && item.publish_time.substr(0, 10)}}</p>
                                <img src="{{asset('frontend/img/common/icon_name.jpg')}}" />
                                {{--<p>by @{{item.author || ''}}</p>--}}
                                <div class="clear"></div>
                            </div>
                            <div class="box">
                                <div class="pic_box" v-if="item.pic"><img :src="$storage + item.pic" /></div>
                                <p>@{{item.preface || ''}}</p>
                                <div class="btn">
                                    <span>继续阅读</span>
                                    <span><img src="{{asset('frontend/img/common/goto.jpg')}}" /></span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="navi clearfix" v-if="article.pages > 1">
                        <a v-if="article.pageNumber != 1" class="lbtn" href="javascript:;"
                           @click="search(article.pervPage)">PREV</a>
                        <a v-for="(item,index) in 5" v-if="(index + article.pageNumberStart) <= article.pages"
                           @click="search(index + article.pageNumberStart)">@{{index + article.pageNumberStart}}</a>
                        <a v-if="article.pageNumber != article.pages" class="rbtn" href="javascript:;"
                           @click="search(article.nextPage)">NEXT</a>
                    </div>
                </div>
            </div>
            @include('frontend.dictionary')
        </div>
    </div>
@endsection