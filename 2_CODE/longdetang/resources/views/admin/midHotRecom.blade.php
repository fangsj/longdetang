@extends('admin.layout')
@section('title', '热销推荐')

@section('content')
    @include('admin.js.validate')
    @include('admin.js.form')
    @include('admin.js.fileupload')
    @push('styles')
        <link href="{{asset('/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}"
              rel="stylesheet" type="text/css">
        <style>
            .pic_bg {
                text-align: center;
                background: url('{{asset('/assets/img/noimage.png')}}');
                background-position: center;
                background-repeat: no-repeat;
                background-color: rgb(230,230,230);
            }
            .pic_bg:hover {
                transform: scale(1.005);
                transition: all 0.6s;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            var noimage = '{{asset('/assets/img/noimage.png')}}';
        </script>
        <script src="{{asset('/assets/js/page/midHotRecom.js')}}">
        </script>
    @endpush
    <div class="ibox ">
        <div class="ibox-title">
            <h5><i class="fa fa-pencil"></i> 首页热销推荐</h5>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
            <div class="row" style="height: 250px;">
                <div style="width: 32.8%;height: 100%;float: left;margin: .1%;">
                    <div data-position="left_top"  style="width: 100%;height: 49.5%;margin-bottom: .5%;" class="pic_bg" title="点击修改">
                        @if(isset($left_top))
                            <img data-meta="{{json_encode($left_top)}}" src="{{storage_url($left_top['pic'])}}" style="width: 100%;height: auto;max-height: 100%;">
                        @endif
                    </div>
                    <div data-position="left_bottom" style="width: 100%;height: 49.5%;margin-top: .5%;" class="pic_bg" title="点击修改">
                        @if(isset($left_bottom))
                            <img data-meta="{{json_encode($left_bottom)}}" src="{{storage_url($left_bottom['pic'])}}" style="width: 100%;height: auto;max-height: 100%;">
                        @endif
                    </div>
                </div>
                <div data-position="center" style="width: 44.8%;height: 100%;float: left;margin: .1%;" class="pic_bg" title="点击修改">
                    @if(isset($center))
                        <img data-meta="{{json_encode($center)}}" src="{{storage_url($center['pic'])}}" style="width: 100%;height: auto;max-height: 100%;">
                    @endif
                </div>
                <div style="width: 21.8%;height: 100%;float: left;margin: .1%;">
                    <div data-position="right_top" style="width: 100%;height: 49.5%;margin-bottom: .5%;" class="pic_bg" title="点击修改">
                        @if(isset($right_top))
                            <img data-meta="{{json_encode($right_top)}}" src="{{storage_url($right_top['pic'])}}" style="width: 100%;height: auto;max-height: 100%;">
                        @endif
                    </div>
                    <div data-position="right_bottom" style="width: 100%;height: 49.5%;margin-top: .5%;" class="pic_bg" title="点击修改">
                        @if(isset($right_bottom))
                            <img data-meta="{{json_encode($right_bottom)}}" src="{{storage_url($right_bottom['pic'])}}" style="width: 100%;height: auto;max-height: 100%;">
                        @endif
                    </div>
                </div>
                <span class="help-block" style="margin-top: 2%;clear: both;display: inline-block">
                    <span class="label label-sm label-danger">Note:</span>
                    请点击图片区域修改
                </span>
            </div>

        </div>
        <div id="formModal" class="modal fade" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width: 350px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;<span id="firstSortModalTitle">编辑热销推荐</span></h4>
                    </div>
                    <div class="modal-body">
                        <form id="form" class="form-horizontal" method="post">
                            <input type="hidden" name="id" id="idInputField"/>
                            <input type="hidden" name="position" id="positionInputField"/>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">图片<span class="required" aria-required="true">* </span>:
                                            </label>
                                            <div class="col-md-9">
                                                <div>
                                                    <div name="thumbnailSelectBtn" style="width: 200px; height: 150px; line-height: 150px;border: 1px solid #eee;border-radius: 3%;margin-bottom: 2%;text-align: center;">
                                                        <img id="previewThumbnail" src="{{asset('/assets/img/noimage.png')}}" style="max-width:100%;width: auto;height: 100%; vertical-align: baseline;padding:2%;"/>
                                                        <input id="thumbnailHiddenInputField" type="hidden" name="thumbnail"/>
                                                    </div>
                                                    <div>
                                                <span class="btn default btn-file">
                                                <span name="thumbnailSelectBtn"><i class="fa fa-image"></i> 选择图片</span>
                                                <input id="thumbnailInput" style="display: none;" type="file">
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">链接:
                                            </label>
                                            <div class="col-md-9">
                                                <textarea id="linkInputField" name="link" class="form-control"  placeholder="请输入关联链接" cols="5" rows="3" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeForm" data-dismiss="modal" class="btn btn-outline btn-danger"><i class="fa fa-times"></i>关闭</button>
                        <button type="button" id="submitFormBtn" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> 确认</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection