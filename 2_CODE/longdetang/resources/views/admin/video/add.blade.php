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
        <script src="{{asset('/assets/js/page/video/add.js')}}">
        </script>
    @endpush
    <div class="ibox ">
        <div class="ibox-title">
            <h5><i class="fa fa-pencil"></i> {{!isset($id) ? '新增' : '修改'}}视频</h5>
            <div class="ibox-tools">
                <a name="saveBtn" class="btn btn-primary btn-xs btn-rounded hvr-pulse-shrink"><i
                            class="fa fa-save"></i> 保存</a>
                <a href="{{admin('/video?keep')}}"
                   class="btn btn-info btn-xs btn-rounded btn-outline hvr-pulse-shrink"><i
                            class="fa fa-chevron-left"></i>
                    返回</a>
            </div>
        </div>
        <div class="ibox-content">
            <form id="dataForm" action="{{ isset($id) ? admin('/video/edit') : admin('/video/add')}}" method="post" class="form-horizontal">
                <input hidden name="id" value="{{$id or ''}}"/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">视频标题
                                <span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-5">
                                <input type="text" id="title" name="title" class="form-control" maxlength="30"
                                       placeholder="请输入视频标题" value="{{$title or ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">描述
                                <span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-5">
                                <textarea class="form-control" placeholder="请输入视频描述" name="description" rows="4" style="resize: none">{{$description or ''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">上传缩略图<span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-5">
                                <div style="width:100%">
                                    <button id="choisePicBtn" type="button" class="btn grey start">
                                        <i class="fa fa-upload"></i><span> 选择图片上传</span>
                                    </button>
                                    <input type="file" id="picInput" name="picInput" accept="image/*" style="display: none"/>
                                    <span class="upload-loading"></span>
                                </div>
                                <div id="pic-preview" class="img-preview" style="display: {{isset($pic) ? 'block' : 'none'}};margin-top: 5px;">
                                    <input type="hidden" name="pic" value="{{$pic or ''}}"/>
                                    <img width="190" height="148" src="{{isset($pic) ? storage_url($pic) : ''}}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <span class="help-block m-b-none text-danger my_clearfix_both">推荐尺寸(px): 自适应</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">上传视频<span class="required" aria-required="true">*&nbsp; </span>:</label>
                            <div class="col-md-5">
                                <div style="width:100%">
                                    <button id="choiseVideoBtn" type="button" class="btn grey start">
                                        <i class="fa fa-upload"></i><span> 选择视频上传</span>
                                    </button>
                                    <input type="file" id="videoInput" name="video" accept="video/*" style="display: none"/>
                                    <div id="videoUploaderProcessContainer" class="progress progress-striped active" style="width: 200px;height: 9px;margin-top: 2%;display: none;">
                                        <div id="videoUploaderProcess" style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="video-preview" class="img-preview" style="display: {{isset($url) ? 'block' : 'none'}};margin-top: 5px;width: 200px;">
                                    <input type="hidden" name="url" value="{{$url or ''}}"/>
                                    <video  src="{{isset($url) ? storage_url($url) : ''}}" controls/>&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <span class="help-block m-b-none text-danger my_clearfix_both">只支持mp4格式视频</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">状态<span class="required"
                                                                          aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-5">
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
                            <label class="control-label col-md-4">排序号: </label>
                            <div class="col-md-5">
                                <input type="text" id="seq" name="seq" class="form-control" maxlength="4" placeholder="用于列表排序，可不填" value="{{$seq or ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4">浏览数: </label>
                            <div class="col-md-5">
                                <input type="text" id="views" name="views" class="form-control" maxlength="4" placeholder="可不填" value="{{$views or ''}}">
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