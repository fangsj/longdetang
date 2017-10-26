@extends('admin.layout')
@section('title', '新增视频')

@section('content')
    @include('admin.js.validate')
    @include('admin.js.form')
    @include('admin.js.fileupload')
    @push('styles')
        <link href="{{asset('/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}"
              rel="stylesheet" type="text/css">
    @endpush
    @push('scripts')
        <script src="{{asset('/assets/js/page/artist/add.js')}}">
        </script>
    @endpush
    <div class="ibox ">
        <div class="ibox-title">
            <h5><i class="fa fa-pencil"></i> {{!isset($id) ? '新增' : '修改'}}艺人</h5>
            <div class="ibox-tools">
                <a name="saveBtn" class="btn btn-primary btn-xs btn-rounded hvr-pulse-shrink"><i
                            class="fa fa-save"></i> 保存</a>
                <a href="{{admin('/artist?keep')}}"
                   class="btn btn-info btn-xs btn-rounded btn-outline hvr-pulse-shrink"><i
                            class="fa fa-chevron-left"></i>
                    返回</a>
            </div>
        </div>
        <div class="ibox-content">
            <form id="dataForm" action="{{ isset($id) ? admin('/artist/edit') : admin('/artist/add')}}" method="post" class="form-horizontal">
                <input hidden name="id" value="{{$id or ''}}"/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">名称
                                <span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-5">
                                <input type="text" id="name" name="name" class="form-control" maxlength="30"
                                       placeholder="请输入艺人名称" value="{{$name or ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">介绍
                                <span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-5">
                                <textarea class="form-control" placeholder="请输入艺人介绍" name="intro" rows="4" style="resize: none">{{$intro or ''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">上传照片<span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-5">
                                <div style="width:100%">
                                    <button id="choisePicBtn" type="button" class="btn grey start">
                                        <i class="fa fa-upload"></i><span> 选择照片上传</span>
                                    </button>
                                    <input type="file" id="picInput" name="picInput" accept="image/*" style="display: none"/>
                                    <span class="upload-loading"></span>
                                </div>
                                <div id="pic-preview" class="img-preview" style="display: {{isset($pic) ? 'block' : 'none'}};margin-top: 5px;">
                                    <input type="hidden" name="pic" value="{{$pic or ''}}"/>
                                    <img width="190" height="148" src="{{isset($pic) ? storage_url($pic) : ''}}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <span class="help-block m-b-none text-danger my_clearfix_both">推荐尺寸(px):160*160</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">作品数: </label>
                            <div class="col-md-5">
                                <input type="text" id="works" name="works" class="form-control" maxlength="4" placeholder="可不填" value="{{$works or ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group row" style="text-align: right">
                    <div class="col-sm-12">
                        <button name="backBtn" class="btn btn-danger hvr-pulse-shrink" type="button"><i
                                    class="fa fa-times"></i> 取消
                        </button>
                        <button name="resetBtn" class="btn btn-info hvr-pulse-shrink" type="button"><i
                                    class="fa fa-undo"></i> 重置
                        </button>
                        <button name="saveBtn" class="btn btn-primary hvr-pulse-shrink" type="button"><i
                                    class="fa fa-save"></i> 保存
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection