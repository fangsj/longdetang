@extends('admin.layout')
@section('title', '编辑艺人')

@section('content')
    @include('admin.js.validate')
    @include('admin.js.form')
    @include('admin.js.ck')
    @include('admin.js.fileupload')
    @push('styles')
        <link href="{{asset('/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}"
              rel="stylesheet" type="text/css">
    @endpush
    @push('scripts')
        <script src="{{asset('/assets/js/page/article/add.js')}}">
        </script>
    @endpush
    <div class="ibox ">
        <div class="ibox-title">
            <h5><i class="fa fa-pencil"></i> {{!isset($id) ? '新增' : '修改'}}新事</h5>
            <div class="ibox-tools">
                <a name="saveBtn" class="btn btn-primary btn-xs btn-rounded hvr-pulse-shrink"><i
                            class="fa fa-save"></i> 保存</a>
                <a href="{{admin('/article?keep')}}"
                   class="btn btn-info btn-xs btn-rounded btn-outline hvr-pulse-shrink"><i
                            class="fa fa-chevron-left"></i>
                    返回</a>
            </div>
        </div>
        <div class="ibox-content">
            <form id="dataForm" action="{{ isset($id) ? admin('/article/edit') : admin('/article/add')}}" method="post" class="form-horizontal">
                <input hidden name="id" value="{{$id or ''}}"/>
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">标题
                                        <span class="required" aria-required="true">*&nbsp; </span>: </label>
                                    <div class="col-md-9">
                                        <input type="text" id="title" name="title" class="form-control" maxlength="128"
                                               placeholder="请输入新事标题" value="{{$title or ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">简要介绍
                                        <span class="required" aria-required="true">&nbsp; </span>: </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" placeholder="请输入简要介绍" name="preface" rows="4" style="resize: none">{{$preface or ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">上传照片<span class="required" aria-required="true">*&nbsp; </span>: </label>
                                    <div class="col-md-9">
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
                                    <label class="control-label col-md-3">状态<span class="required"
                                                                                  aria-required="true">*&nbsp; </span>: </label>
                                    <div class="col-md-9">
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" checked id="status0" name="status" {{isset($status) && $status == 0 ? 'checked' : ''}} value="0">
                                            <label for="status0">待发布</label>
                                        </div>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="status1" name="status" {{isset($status) &&  $status == 1 ? 'checked' : ''}} value="1">
                                            <label for="status1">已发布</label>
                                        </div>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="status2" name="status" {{isset($status) &&  $status == 2 ? 'checked' : ''}} value="2">
                                            <label for="status2">已下架</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">浏览数
                                        <span class="required" aria-required="true">&nbsp; </span>: </label>
                                    <div class="col-md-9">
                                        <input type="text" id="views" name="views" class="form-control"
                                               placeholder="请输入浏览数" value="{{$views or '0'}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <textarea id="content" class="form-control ckeditor" data-error-container="#content_error"
                                  style="resize: none;" name="content" rows="">{{$content or ''}}</textarea>
                        <div id="content_error">
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