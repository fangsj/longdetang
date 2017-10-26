@extends('admin.layout')
@section('title', '视频')

@section('content')
    @include('admin.js.table')
    @push('styles')
        <link href="{{asset('/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}"
              rel="stylesheet" type="text/css">
    @endpush
    @push('scripts')
        <script src="{{asset('/assets/js/page/video/list.js')}}">
        </script>
    @endpush
    <div class="ibox ">
        <div class="ibox-title">
            <h5><i class="fa fa-filter"></i>&nbsp;&nbsp;视频列表</h5>
        </div>
        <div class="ibox-content">
            <form id="searchForm" class="form-inline search-form" name="searchForm" style="margin-bottom: 15px;">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label form-label">标&nbsp;&nbsp;题:</label>
                        <div class="form-value">
                            <input type="text" class="form-control" name="title" value="{{$title or ''}}" placeholder="请输入标题">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label form-label">状&nbsp;&nbsp;态:</label>
                        <div class="form-value">
                            <select name="status" class="form-control" style="width: 100%">
                                <option value="">---请选择---</option>
                                <option value="0" {{isset($status) &&  $status == 0 ? 'selected' : ''}}>待发布</option>
                                <option value="1" {{isset($status) &&  $status == 1 ? 'selected' : ''}}>已发布</option>
                                <option value="2" {{isset($status) &&  $status == 2 ? 'selected' : ''}}>已下架</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9" style="float: right;">
                        <div style="text-align: right">
                            <a id="initAdd" class=" btn btn-primary hvr-pulse-shrink" data-toggle="modal"
                               href="{{admin('/video/add')}}">
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