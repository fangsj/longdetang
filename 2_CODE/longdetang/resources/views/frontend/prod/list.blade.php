@extends('frontend.layout')
@section('title', '龍德堂陶艺 | 作品')
@section('body_class', 'LC_Page_Products_List')
@push('scripts')
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
                    categorys: [],
                    keyword: '',
                    artist: '',
                    openSearchDialog: false,
                    artists:[],
                    secondCategoryId: '',
                    categoryId: '{{$category_id or ''}}',
                    prod: {
                        pageSize: 16,
                        pageNumber: 1,
                        rows: [],
                        pages: 0,
                        total: 0,
                        pageNumberStart: 0,
                        pervPage: 0,
                        nextPage: 0
                    }
                },
                created: function() {
                    var _this = this;
                    this.$http.get('{{url('/prod/categorys')}}', {}, function (data) {
                        _this.categorys = data
                    }, 'json');
                    this.$http.get('{{url('/prod/artists')}}', {}, function (data) {
                        _this.artists = data
                    }, 'json');
                    this.searchProds(this.prod.pageNumber);
                },
                methods: {
                    searchByKeyword: function() {
                        this.artist = ''
                        this.secondCategoryId = ''
                        this.searchProds(1)
                    },
                    searchByArtis: function(artist) {
                        this.keyword = ''
                        this.artist = artist
                        this.secondCategoryId = ''
                        this.categoryId = ''
                        this.searchProds(1)
                    },
                    searchBySecondCategory: function(categoryId) {
                        this.keyword = ''
                        this.secondCategoryId = categoryId
                        this.categoryId = ''
                        this.artist = ''
                        this.searchProds(1)
                    },
                    searchByCategory: function(categoryId) {
                        this.keyword = ''
                        this.categoryId = categoryId
                        this.artist = ''
                        this.secondCategoryId = ''
                        this.searchProds(1)
                    },
                    searchProds: function(pageNumber) {
                        if(this.openSearchDialog) this.closeSearch()
                        var _this = this;
                        this.$http.get('{{url('/prod/list')}}', {
                            pageSize: this.prod.pageSize,
                            pageNumber: pageNumber,
                            second_category_id: this.secondCategoryId,
                            category_id: this.categoryId,
                            name: this.keyword,
                            artist: this.artist
                        }, function (data) {
                            window.scroll(0,100)
                            _this.prod = data
                            _this.prod.nextPage = pageNumber + 1
                            _this.prod.pervPage = pageNumber - 1
                            _this.prod.pageNumberStart = (data.pageNumber - 2 > 0 ? data.pageNumber - 2 : 1)
                        }, 'json');
                    },
                    openSearch: function() {
                        this.openSearchDialog = true
                        $('body').css('position','fixed');
                        $('.listWrapper .serchBlock').css({display:'block'}).animate({ opacity: '1'}, 500, "swing",function(){
                            $('.listWrapper .serchBlock form').animate({ opacity: '1'}, 500, "swing");
                        });
                    },
                    closeSearch: function() {
                        this.openSearchDialog = false
                        $('.listWrapper .serchBlock').animate({ opacity: '0'}, 500, "swing",function(){
                            $('.listWrapper .serchBlock').css({display:'none'});
                            $('.listWrapper .serchBlock form').css({opacity: '0'});
                            $('body').css('position',' static');
                        });
                    }
                }
            })
        })
    </script>
@endpush

@section('content')
    <div id="container" class="clearfix">
        <div id="main_column" class="colnum1">
            <div id="undercolumn" class="undercolumn">
                <div class="Breadcrumb">
                    <ul id="crumbs">
                        <li><a href="{{url('/')}}"><span>首页</span></a></li>
                        <li><span>全部作品</span></li>
                    </ul>
                </div>
                <h1 class="title">PRODUCTS</h1>
                <div class="listWrapper clearfix">
                    <div class="itemSerchBtn" @click="openSearch"><span>搜索</span></div>
                    <div class="serchBlock" style="display: none; opacity: 0;">

                        <form action="#" method="get" onsubmit="return false" style="opacity: 0;">
                            <div class="cls" @click="closeSearch"><img src="{{asset('frontend/img/detail/close.svg')}}" alt="关闭">
                            </div>
                            <div class="side_header">
                                <p class="side_title">SEARCH ITEMS</p>
                            </div>
                            <div class="side_block">
                                <p style="font-weight: bold;font-size: 1rem">搜 索</p>
                                <input type="text" v-model="keyword" placeholder="输入关键字按回车键搜索" @keyup.enter="searchByKeyword" class="input_full" name="keyword" value="">
                            </div>
                            <div class="side_block" v-for="item in categorys">
                                <div class="filter_title"  style="cursor: pointer" @click="searchByCategory(item.id)"><span class="c_icon01" style="font-weight: bold;background-size:34%;" :style="{'background-image': 'url(\''+ $storage + item.thumbnail +'\')'}">@{{item.name}}</span>
                                </div>
                                <div class="filter_body">
                                    <ul class="filteritem">
                                        <li @click="searchBySecondCategory(child.id)" style="padding-left: 13%" v-for="child in item.child">
                                            <label><span class="icon_check"></span>@{{child.name}}</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{--<div class="side_block">--}}
                                {{--<div class="filter_title"><span class="c_icon01" style="font-weight: bold;background-image: url('{{asset("/frontend/image/artist.svg")}}');background-size:34%;">艺人</span>--}}
                                {{--</div>--}}
                                {{--<div class="filter_body">--}}
                                    {{--<ul class="filteritem">--}}
                                        {{--<li @click="searchByArtis(artist.name)" style="padding-left: 13%" v-for="artist in artists">--}}
                                            {{--<label><span class="icon_check"></span>@{{artist.name}} 制</label>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </form>
                    </div>
                    <div class="itemList">
                        <h3 class="title">
                            全商品
                            <div class="swich">
                                <ul>
                                    <li class="sw01" onclick="setViewCols(1);">リスト表示</li>
                                    <li class="sw02 active" onclick="setViewCols(2);">サムネイル表示</li>
                                </ul>
                            </div>
                        </h3>
                        <ul class="itemlistBlock c_layout">
                            <li v-for="item in prod.rows">
                                <div class="list_area clearfix"><a name="product256713"></a>
                                    <div class="listphoto">
                                        <!--★画像★-->
                                        <a :href="$baseURL + 'prod/detail?id=' + item.id">
                                            <img :src="$storage + item.pic" :alt="item.name" class="picture">
                                        </a>
                                    </div>
                                    <div class="listrightbloc">
                                        <h4><a :href="$baseURL + 'prod/detail?id=' + item.id">@{{item.name}}</a></h4>
                                        <ul class="category clearfix">
                                            <li><span>材质: </span>@{{ $dicts.prod.texture[item.texture] }}</li>
                                            <li><span>容量: </span>@{{ item.capacity }}cc</li>
                                        </ul>
                                        <div class="listcomment" style="display: block;">@{{ item.is_essence ? '龙德堂精选' : '&nbsp;'}}</div>
                                        <div class="pricebox">
                                            售价<span>￥@{{(item.price || 0.00)}}</span>
                                        </div>

                                        <div class="cart_area clearfix">
                                            <div class="cartin clearfix" style="padding: 3px;">
                                                <div class="cartin_btn" style="margin: 0;text-align: center;padding: 0;">
                                                    <img src="{{asset('frontend/image/scan.png')}}" style="width: 32px;">
                                                </div>
                                            </div>
                                            <div class="detai_btn_box">
                                                <a :href="$baseURL + 'prod/detail?id=' + item.id" class="detail_btn"> 点击查看详情并扫码购买 </a>
                                            </div>
                                        </div>
                                        <div class="attention" id="cartbtn_dynamic_256713"></div>

                                        <!--▲買い物カゴ-->
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="navi clearfix" v-if="prod.pages > 0">
                            <a v-if="prod.pageNumber != 1" class="lbtn" href="javascript:;" @click="searchProds(prod.pervPage)">PREV</a>
                            <a v-for="(item,index) in 5" v-if="(index + prod.pageNumberStart) <= prod.pages" @click="searchProds(index + prod.pageNumberStart)">@{{index + prod.pageNumberStart}}</a>
                            <a v-if="prod.pageNumber != prod.pages" class="rbtn" href="javascript:;" @click="searchProds(prod.nextPage)">NEXT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.dictionary')
    </div>
@endsection

@push('bottom-scripts')
    <script type="text/javascript" src="{{asset('frontend/js/swich.js')}}"></script>
@endpush