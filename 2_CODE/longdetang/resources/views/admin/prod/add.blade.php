@extends('admin.layout')
@section('title', '编辑商品')

@section('content')
    @include('admin.js.validate')
    @include('admin.js.form')
    @include('admin.js.fileupload')
    @include('admin.js.ck')
    @include('admin.js.select2')
    @push('styles')
        <link href="{{asset('/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}"
              rel="stylesheet" type="text/css">
    @endpush
    @push('scripts')
        <script src="{{asset('/assets/js/page/prod/add.js')}}">
        </script>
    @endpush
    <div class="ibox ">
        <div class="ibox-title">
            <h5><i class="fa fa-pencil"></i> {{!isset($id) ? '新增' : '修改'}}商品</h5>
            <div class="ibox-tools">
                <a name="saveBtn" class="btn btn-primary btn-xs btn-rounded hvr-pulse-shrink"><i
                            class="fa fa-save"></i> 保存</a>
                <a href="{{admin('/prod?keep')}}"
                   class="btn btn-info btn-xs btn-rounded btn-outline hvr-pulse-shrink"><i
                            class="fa fa-chevron-left"></i>
                    返回</a>
            </div>
        </div>
        <div class="ibox-content">
            <form id="dataForm" action="{{ isset($model['id']) ? admin('/prod/edit') : admin('/prod/add')}}"
                  method="post"
                  class="form-horizontal">
                <input hidden name="id" value="{{$model['id'] or ''}}"/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">名称
                                <span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-8">
                                <input type="text" id="name" name="name" class="form-control" maxlength="30"
                                       placeholder="请输入商品名称" value="{{$model['name'] or ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">编码
                                <span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-8">
                                <input type="text" id="code" name="code" class="form-control" maxlength="30"
                                       placeholder="请输入商品代码" value="{{$model['code'] or ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">分类
                                <span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-8">
                                <input type="hidden" id="category_id" name="category_id" value="{{$category_id or ''}}">
                                <select class="form-control" id="second_category_id" name="second_category_id">
                                    <option value="">--请选择商品分类--</option>
                                    @foreach($categorys as $category)
                                        <optgroup label="{{$category->name}}" data-id="{{$category->id}}">
                                            @foreach($category->child as $second_category)
                                                <option data-pid="{{$category->id}}"
                                                        {{(isset($model['second_category_id']) && $model['second_category_id'] == $second_category->id) ? 'selected' : ''}}
                                                        value="{{$second_category->id}}">{{$second_category->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">价格
                                <span class="required" aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-8">
                                <input type="text" id="price" name="price" class="form-control" maxlength="30"
                                       placeholder="请输入商品价格" value="{{$model['price'] or ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">材质 : </label>
                            <div class="col-md-8">
                                <select class="form-control" name="texture">
                                    <option value="">--请选择材质--</option>
                                    @foreach(dicts('prod.texture') as $key => $value)
                                        <option value="{{$key}}" {{(isset($model['texture']) && $model['texture'] == $key) ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">容量 : </label>
                            <div class="col-md-8">
                                <input type="text" id="capacity" name="capacity" class="form-control" maxlength="30"
                                       placeholder="请输入容量大小，单位：cc" value="{{$model['capacity'] or ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">上传图片<span class="required" aria-required="true">*&nbsp; </span>:
                            </label>
                            <div class="col-md-8">
                                <div style="width:100%">
                                    <button id="choisePicBtn" type="button" class="btn grey start">
                                        <i class="fa fa-upload"></i><span> 选择图片上传</span>
                                    </button>
                                    <input type="file" id="picInput" name="picInput" accept="image/*"
                                           style="display: none"/>
                                    <span class="upload-loading"></span>
                                </div>
                                <div id="pic-preview" class="img-preview"
                                     style="display: {{isset($model['pic']) ? 'block' : 'none'}};margin-top: 5px;">
                                    <input type="hidden" name="pic" value="{{$model['pic'] or ''}}"/>
                                    <img width="190" height="148"
                                         src="{{isset($model['pic']) ? storage_url($model['pic']) : ''}}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <span class="help-block m-b-none text-danger my_clearfix_both">推荐尺寸(px):1000*1000 或同等比例</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">上传二维码<span class="required" aria-required="true">*&nbsp; </span>:
                            </label>
                            <div class="col-md-8">
                                <div style="width:100%">
                                    <button id="choiseBarPicBtn" type="button" class="btn grey start">
                                        <i class="fa fa-upload"></i><span> 选择商品二维码上传</span>
                                    </button>
                                    <input type="file" id="barPicInput" name="picInput" accept="image/*"
                                           style="display: none"/>
                                    <span class="upload-loading"></span>
                                </div>
                                <div id="bar-pic-preview" class="img-preview"
                                     style="display: {{isset($model['bar_pic']) ? 'block' : 'none'}};margin-top: 5px;">
                                    <input type="hidden" name="bar_pic" value="{{$model['bar_pic'] or ''}}"/>
                                    <img width="190" height="148"
                                         src="{{isset($model['bar_pic']) ? storage_url($model['bar_pic']) : ''}}"
                                         alt="">&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <span class="help-block m-b-none text-danger my_clearfix_both">推荐尺寸(px):1000*1000 或同等比例</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label col-md-3">上传轮播 :
                            </label>
                            <div class="col-md-9">
                                <div style="width:100%">
                                    <button id="choiseBannerPicBtn" type="button" class="btn grey start">
                                        <i class="fa fa-upload"></i><span> 选择图片上传</span>
                                    </button>
                                    <input type="file" id="bannerPicInput" multiple name="bannerPicInput"
                                           accept="image/*"
                                           style="display: none"/>
                                    <span class="upload-loading"></span>
                                </div>
                                <div id="pic-preview-container" style="">
                                    @if(isset($model['attachs']))
                                        @foreach($model['attachs'] as $attach)
                                            <div class="img-preview" style="margin-top: 5px;position: relative;">
                                                <input type="hidden" name="attachs[]" value="{{$attach['url']}}"/>
                                                <img width="150" height="150" src="{{storage_url($attach['url'])}}"
                                                     alt="">&nbsp;&nbsp;&nbsp;&nbsp;
                                                <i class="fa fa-times-circle-o"
                                                   style="background:white; border-radius:100%;position: absolute;z-index: 9999;top:-13px;right: 6px;font-size: 26px;font-weight: 300;color: #000000a3;"></i>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <span class="help-block m-b-none text-danger my_clearfix_both">推荐尺寸(px):1000*1000 或同等比例</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">艺人 : </label>
                            <div class="col-md-8">
                                <select class="form-control" id="artist_id" name="artist_id" style="width: 100%;">
                                    <option value="">--请选择艺人--</option>
                                    @if(isset($model['artist_id']))
                                        <option value="{{$model['artist_id']}}" selected>{{$model['artist_name']}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">是否精选<span class="required"
                                                                            aria-required="true">*&nbsp; </span>:
                            </label>
                            <div class="col-md-8">
                                <div class="radio radio-danger radio-inline">
                                    <input type="radio" id="is_essence1" name="is_essence"
                                           {{isset($model['is_essence']) &&  $model['is_essence'] == 1 ? 'checked' : ''}} value="1">
                                    <label for="is_essence1">是</label>
                                </div>
                                <div class="radio radio-danger radio-inline">
                                    <input type="radio" checked id="is_essence0" name="is_essence"
                                           {{isset($model['is_essence']) && $model['is_essence'] == 0 ? 'checked' : ''}} value="0">
                                    <label for="is_essence0">否</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">简要描述 : </label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="details" style="resize: none;" rows="4"
                                          placeholder="请输入简要描述">{{$model['details'] or ''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label col-md-3">详细描述:</label>
                            <div class="col-md-9">
                                <textarea id="brief" class="form-control ckeditor" data-error-container="#brief_error"
                                          style="resize: none;" name="brief" rows=""
                                          placeholder="请在这里输入详细描述......">{{$model['brief'] or ''}}</textarea>
                                <div id="content_error">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">状态<span class="required"
                                                                          aria-required="true">*&nbsp; </span>: </label>
                            <div class="col-md-8">
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" checked id="status0" name="status"
                                           {{isset($status) && $status == 0 ? 'checked' : ''}} value="0">
                                    <label for="status0">待上架</label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="status1" name="status"
                                           {{isset($status) &&  $status == 1 ? 'checked' : ''}} value="1">
                                    <label for="status1">已上架</label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="status2" name="status"
                                           {{isset($status) &&  $status == 2 ? 'checked' : ''}} value="2">
                                    <label for="status2">已下架</label>
                                </div>
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
    <div id="preview-tpl" class="img-preview" style="display: none; margin-top: 5px;position: relative;">
        <input type="hidden" name="" value=""/>
        <img width="150" height="150" src="" alt="">&nbsp;&nbsp;&nbsp;&nbsp;
        <i class="fa fa-times-circle-o"
           style="background:white; border-radius:100%;position: absolute;z-index: 9999;top:-13px;right: 6px;font-size: 26px;font-weight: 300;color: #000000a3;"></i>
    </div>
@endsection