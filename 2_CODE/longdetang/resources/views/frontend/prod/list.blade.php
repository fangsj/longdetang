@extends('frontend.layout')
@section('body_class', 'LC_Page_Products_List')
@push('scripts')
    <script src="https://unpkg.com/vue"></script>
    <script>
        $(function () {
            Vue.prototype.$http = $.ajax;
            Vue.prototype.$http.post = $.post;
            Vue.prototype.$http.get = $.get;
            var app = new Vue({
                el: '#container',
                data: {
                    categorys: []
                },
                created() {
                    var _this = this;
                    this.$http.get('{{url('/prod/categorys')}}', {}, function (data) {
                        _this.categorys = data
                    }, 'json')
                }
            })
        })
    </script>
@endpush

@section('content')
    <div id="container" class="clearfix">
        <div id="main_column" class="colnum1">
            <div class="undercolumn">
                <div class="Breadcrumb">
                    <ul id="crumbs">
                        <li><a href="../index.html"><span>首页</span></a></li>
                        <li><span>PRODUCTS 全商品</span></li>
                    </ul>
                </div>
                <h1 class="title">PRODUCTS</h1>
                <div class="listWrapper clearfix">
                    <div class="itemSerchBtn"><span>搜索</span></div>
                    <div class="serchBlock" style="display: none; opacity: 0;">

                        <form action="list.php" method="get" onsubmit="return beforeSubmit3();" style="opacity: 0;">
                            <div class="cls"><img src="../user_data/packages/default/img/detail/close.svg" alt="閉じる"></div>
                            <div class="side_header">
                                <p class="side_title">SEARCH ITEMS</p>
                            </div>
                            <div class="side_block">
                                <p style="font-weight: bold;font-size: 1rem">搜 索</p>
                                <input type="text" class="input_full" name="keyword" value="">
                            </div>
                            <div class="side_block" v-for="item in categorys">
                                <div class="filter_title"><span class="c_icon01" style="font-weight: bold">@{{item.name}}</span></div>
                                <div class="filter_body">
                                    <ul class="filteritem">
                                        <li style="padding-left: 10%" v-for="child in item.child">
                                            <label><span class="icon_check"></span>@{{child.name}}</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="itemList">
                        <h3 class="title">
                            全商品
                            <div class="swich">
                                <ul>
                                    <li class="sw01 active" onclick="setViewCols(1);">リスト表示</li>
                                    <li class="sw02 " onclick="setViewCols(2);">サムネイル表示</li>
                                </ul>
                            </div>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <section class="dictionaryBanner">
            <a href="contents/dictionary/index.html"></a>
            <div class="wrap">
                <div class="titleBlock">植物図鑑<br>
                    <span>Plant dictionary</span></div>
                <div class="open">OPEN A BOOK</div>
                <p class="read">植物の基本知識がわかる図鑑</p>
            </div>
        </section>
    </div>
@endsection