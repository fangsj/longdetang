@extends('frontend.layout')
@section('title', '龍德堂陶艺 | 泽峰说')
@section('body_class', 'LC_Page_Video_List')
@push('scripts')
    <script src="{{asset('js/vue.js')}}"></script>
    <script>
        $(function () {
            Vue.prototype.$http = $.ajax;
            Vue.prototype.$http.post = $.post;
            Vue.prototype.$http.get = $.get;
            Vue.prototype.$storage = storage + '/';
            Vue.prototype.$baseURL = baseURL;
            var app = new Vue({
                el: '#container',
                data: {
                    selectedVideo: null,
                    videos: {
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
                        this.videos.rows = [];
                        var _this = this;
                        this.$http.get('{{url('/video/list')}}', {
                            pageSize: this.videos.pageSize,
                            pageNumber: pageNumber
                        }, function (data) {
                            window.scroll(0, 0);
                            _this.videos = data
                            _this.videos.nextPage = pageNumber + 1
                            _this.videos.pervPage = pageNumber - 1
                            _this.videos.pageNumberStart = (data.pageNumber - 2 > 0 ? data.pageNumber - 2 : 1)
                        }, 'json');
                    },
                    // 保证只播放一个视频PC
                    play: function($event, item) {
                        if(this.selectedVideo != $event.target) {
                            this.selectedVideo && this.selectedVideo.pause()
                            this.selectedVideo = $event.target;
                        }

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
                        <li><span>泽锋说</span></li>
                    </ul>
                </div>
                <h1 class="title">ZE FENG SHUO</h1>
                <div class="zefengshuo_list clearfix">
                    <section>
                        <ul>
                            <li v-for="item in videos.rows">
                                <div class="video">
                                    <video v-on:pause="pause($event, item)" v-on:play="play($event, item)" controls preload="metadata" :src="$storage + item.url" :poster="$storage + item.pic" style="width: 100%;">
                                    </video>
                                </div>
                                <article>@{{item.description || ''}}</article>
                            </li>
                        </ul>
                    </section>
                    <div class="navi clearfix" v-if="videos.pages > 1">
                        <a v-if="videos.pageNumber != 1" class="lbtn" href="javascript:;" @click="search(videos.pervPage)">PREV</a>
                        <a v-for="(item,index) in 5" v-if="(index + videos.pageNumberStart) <= videos.pages" @click="search(index + videos.pageNumberStart)">@{{index + videos.pageNumberStart}}</a>
                        <a v-if="videos.pageNumber != videos.pages" class="rbtn" href="javascript:;" @click="search(videos.nextPage)">NEXT</a>
                    </div>
                </div>
            </div>
            @include('frontend.dictionary')
        </div>
    </div>
@endsection