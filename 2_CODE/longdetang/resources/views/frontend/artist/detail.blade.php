@extends('frontend.layout')
@section('body_class', 'LC_Page_Artists_Detail')
@section('content')
    <div id="container" class="clearfix">
        <div id="main_column" class="colnum1">
            <div id="undercolumn">
                <div class="Breadcrumb">
                    <ul id="crumbs">
                        <li><a href="/"><span>首页</span></a></li>
                        <li><span>艺术家</span></li>
                    </ul>
                </div>
                <h1 class="title">ARTIST</h1>
                <div class="artist_detail clearfix">
                    <section>
                        <img style="width: 100%;height: auto;" src="{{storage_url($pic)}}">
                        <h3 style="margin-top: 3%;margin-bottom: 5%;">{{$name}}</h3>
                        <article>
                            {{$intro}}
                        </article>
                    </section>
                </div>
            </div>
            <section class="related_item">
                <h2>{{$name}}相关作品<br>
                    <span>Related Items</span></h2>
                <ul class="clearfix">
                    @foreach($rela_prods as $prod)
                    <li>
                        <div class="thumb"><a href="{{url('/prod/detail?id='. $prod->id)}}"> <img src="{{storage_url($prod->pic)}}" alt="{{$prod->name}}"> </a></div>
                        <div class="caption">
                            <h3> <a href="{{url('/prod/detail?id='. $prod->id)}}">{{$prod->name}}</a> </h3>
                            {{--<p class="sale_price">售价： <span class="price">￥{{$prod->price}}</span> </p>--}}
                        </div>
                    </li>
                    @endforeach
                </ul>
            </section>
            <section class="dictionaryBanner">
                <a href="../contents/dictionary/index.html"></a>
                <div class="wrap">
                    <div class="titleBlock">植物図鑑<br>
                        <span>Plant dictionary</span></div>
                    <div class="open">OPEN A BOOK</div>
                    <p class="read">植物の基本知識がわかる図鑑</p>
                </div>
            </section>
        </div>
    </div>
@endsection