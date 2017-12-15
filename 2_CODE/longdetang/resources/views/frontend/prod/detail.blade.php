@extends('frontend.layout')
@section('body_class', 'LC_Page_Products_Detail')

@push('jquery-ui')
    <link rel="stylesheet" href="{{asset('frontend/js/jquery.ui/theme/jquery.ui.core.css')}}" type="text/css"
          media="all">
    <link rel="stylesheet" href="{{asset('frontend/js/jquery.ui/theme/jquery.ui.tooltip.css')}}" type="text/css"
          media="all">
    <link rel="stylesheet" href="{{asset('frontend/js/jquery.ui/theme/jquery.ui.theme.css')}}" type="text/css"
          media="all">
@endpush
@section('content')
    <div id="container" class="clearfix">
        <div id="main_column" class="colnum1">
            <div id="undercolumn" class="undercolumn">
                <div class="Breadcrumb">
                    <ul id="crumbs">
                        <li><a href="/"><span>首页</span></a></li>
                        <li><a href="/prod"><span>作品</span></a></li>
                        <li><span>{{$prod->name}}</span></li>
                    </ul>
                </div>
                <div id="detailarea">
                    <div class="title">PRODUCTS</div>
                    <div class="detailBlock clearfix">
                        <div id="detailphotobloc">
                            <div class="item_slider">
                                @foreach($prod_attachs as $attach)
                                    <div>
                                        <img src="{{storage_url($attach['url'])}}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="item_slider-nav">
                                @foreach($prod_attachs as $attach)
                                    <div>
                                        <img src="{{storage_url($attach['url'])}}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="detailrightbloc">
                            <h2>{{$prod->name}}</h2>
                            <div class="category">
                                <a class="cate">材质: {{dicts('prod.texture') ? dicts('prod.texture')[$prod->texture] : ''}}</a>
                                <a class="cate">容量: {{$prod->capacity}} cc</a>
                            </div>
                            <div class="main_comment">{{$prod->is_essence == 1 ? '龙德堂精选': ''}}</div>
                            <dl class="pay">
                                <dt>售价: </dt>
                                <dd class="price"> <span id="price02_default">{{$prod->price}}</span>
                                    <span id="price02_dynamic"></span>
                                    元
                                </dd>
                            </dl>
                            <div class="cartBox clearfix">
                                <div class="cart_area" style="position: relative">
                                    <img src="{{asset('frontend/image/scan.png')}}" style="width: 32px;position: absolute; margin: auto; top: 0; left: 0; bottom: 0; right: 0;">
                                </div>
                                <div class="favorite_btn">
                                    <a>点击左侧二维码扫码购买</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="landingBlock" style="background: rgb(192, 192, 192);">
                    <div class="wrap" style="width: 50%;padding:0 25%">
                        {!!  $prod->brief !!}
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.dictionary')
    </div>
@endsection
@push('bottom-scripts')
    <script src="{{asset('frontend/js/slick.js')}}"></script>
    <script src="{{asset('frontend/js/slider.js')}}"></script>
@endpush