@extends('admin.layout')
@section('title', '商品')

@section('content')
    @include('admin.js.table')
    @push('styles')
        <link href="{{asset('/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}"
              rel="stylesheet" type="text/css">
    @endpush
    @push('scripts')
        <script src="{{asset('/assets/js/page/prod/list.js')}}">
        </script>
    @endpush
    <div class="ibox ">
        <div class="ibox-title">
            <h5><i class="fa fa-filter"></i>&nbsp;&nbsp;商品列表</h5>
        </div>
        <div class="ibox-content">
            <form id="searchForm" class="form-inline search-form" name="searchForm" style="margin-bottom: 15px;">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label form-label">名&nbsp;&nbsp;称:</label>
                        <div class="form-value">
                            <input type="text" class="form-control" name="name" value="{{$name or ''}}" placeholder="请输入商品名称">
                        </div>
                    </div>
                    <div class="col-md-9" style="float: right;">
                        <div style="text-align: right">
                            <a id="initAdd" class=" btn btn-primary hvr-pulse-shrink" data-toggle="modal"
                               href="{{admin('/prod/add')}}">
                                <i class="fa fa-plus"></i> 新增
                            </a>
                            <a id="searchBtn" class="btn btn-success hvr-pulse-shrink">
                                <i class="fa fa-search"></i> 查询
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <table id="table"></table>
                </div>
            </div>
        </div>
    </div>
@endsection