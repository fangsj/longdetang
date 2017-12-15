@extends('frontend.layout')
@section('title', '龍德堂陶艺 | 艺术家')
@section('body_class', 'LC_Page_Artists_List')
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
                    artists: {
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
                created() {
                    this.search(1)
                },
                methods: {
                    search(pageNumber) {
                        var _this = this;
                        this.$http.get('{{url('/artist/list')}}', {
                            pageSize: this.artists.pageSize,
                            pageNumber: pageNumber
                        }, function (data) {
                            window.scroll(0, 0);
                            _this.artists = data
                            _this.artists.nextPage = pageNumber + 1
                            _this.artists.pervPage = pageNumber - 1
                            _this.artists.pageNumberStart = (data.pageNumber - 2 > 0 ? data.pageNumber - 2 : 1)
                        }, 'json');
                    },
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
                        <li><span>艺术家</span></li>
                    </ul>
                </div>
                <h1 class="title">ARTIST</h1>
                <div class="artist_list clearfix">
                    <section>
                        <ul>
                            <li v-for="item in artists.rows">
                                <div class="block">
                                    <div class="thumb">
                                        <a :href="$baseURL + 'artist/' + item.id">
                                            <img :src="$storage + item.pic" :alt="item.name">
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <h3><a :href="$baseURL + 'artist/' + item.id">@{{item.name}}</a></h3>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </section>
                    <div class="navi clearfix" v-if="artists.pages > 0">
                        <a v-if="artists.pageNumber != 1" class="lbtn" href="javascript:;" @click="search(artists.pervPage)">PREV</a>
                        <a v-for="(item,index) in 5" v-if="(index + artists.pageNumberStart) <= artists.pages" @click="search(index + artists.pageNumberStart)">@{{index + artists.pageNumberStart}}</a>
                        <a v-if="artists.pageNumber != artists.pages" class="rbtn" href="javascript:;" @click="search(artists.nextPage)">NEXT</a>
                    </div>
                </div>
            </div>
            @include('frontend.dictionary')
        </div>
    </div>
@endsection