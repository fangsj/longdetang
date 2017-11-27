@extends('admin.layout')
@section('title', '商品分类')
@section('content')
    @include('admin.js.fileupload')
    @include('admin.js.validate')
    @include('admin.js.form')
    @push('styles')
        <link href="{{asset('/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}"
        rel="stylesheet" type="text/css">
        <link href="{{asset('/assets/css/plugins/colorpicker/bootstrap-colorpicker.min.css')}}"
              rel="stylesheet" type="text/css">
        <style>
            .colorpicker.dropdown-menu {
                z-index: 1060;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{asset('/assets/js/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{asset('/assets/js/page/prod/category/list.js')}}">
        </script>
    @endpush
    <div class="ibox ">
        <div class="ibox-title">
            <h5><i class="fa fa-filter"></i>&nbsp;&nbsp;商品分类</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 10px;">
                    <div class="pull-right">
                        <a id="addCategoryBtn" class="btn btn-success hvr-pulse-shrink">
                            <i class="fa fa-plus"></i>新建一级分类
                        </a>
                        <a id="addSecondCategoryBtn" class="btn btn-warning hvr-pulse-shrink">
                            <i class="fa fa-plus"></i>新建二级分类
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>
                        <th>
                            <i class="fa fa-list"></i> 分类名称
                        </th>
                        <th>
                            <i class="fa fa-list-ol"></i> 排序
                        </th>
                        <th>
                            <i class="fa fa-flag-checkered"></i> 状态
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorys as $category)
                        <tr class="fisrtsort tr-fa-caret-right" id="treetable-{{$category->id}}" style="cursor: pointer;">
                            <td>
                                <i id="treetable-{{$category->id}}" class="fa fa-caret-right"
                                   style="cursor: pointer;"></i>
                                <span style="margin-left: 5px;">
                                    <img src="{{storage_url($category->thumbnail)}}"
                                         style="border-radius: 50%;height: 27px;width: 27px;margin-right: 3px;"
                                         onerror="this.src=assets('/img/noimage.png')"/>{{$category->name}}</span>
                            </td>
                            <td>
                                {{$category->seq}}
                            </td>
                            <td>
                                @if($category->status == 1)
                                    <span class="label label-sm label-success">启用</span>
                                @else
                                    <span class="label label-sm label-danger">禁用</span>
                                @endif
                            </td>
                            <td>
                                <a title="修改" onclick="editCategory({{$category->id}})"
                                   class="btn btn-xs btn-primary hvr-buzz-out"><i class="fa fa-pencil-square-o"></i></a>
                                @if($category->status == 1)
                                    <a title="禁用" onclick="switchStatus({{$category->id}}, 0)"
                                       class="btn btn-xs btn-info hvr-buzz-out"><i
                                                class="fa fa-toggle-off"></i></a>
                                @else
                                    <a title="启用" onclick="switchStatus({{$category->id}}, 1)"
                                       class="btn btn-xs btn-default hvr-buzz-out"><i
                                                class="fa fa-toggle-on"></i></a>
                                @endif
                                <a title="增加子分类" onclick="addSecondCategory({{$category->id}}, this)"
                                   class="btn btn-xs btn-success hvr-buzz-out">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <a title="删除" onclick="deleteCategory({{$category->id}})"
                                   class="btn btn-xs btn-danger hvr-buzz-out"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @foreach($category->child as $child)
                            <tr treetable-{{$category->id}} style="display: none;">
                                <td>
                                    <span style="display: block;margin-left: 25px;">{{$child->name}}</span>
                                </td>
                                <td>
                                    {{$child->seq}}
                                </td>
                                <td>
                                    @if($child->status == 1)
                                        <span class="label label-sm label-success">启用</span>
                                    @else
                                        <span class="label label-sm label-danger">禁用</span>
                                    @endif
                                </td>
                                <td>
                                    <a title="修改" onclick="editSecondCategory({{$child->id}})"
                                       class="btn btn-xs btn-primary hvr-buzz-out"><i class="fa fa-pencil-square-o"></i></a>
                                    @if($child->status == 1)
                                            <a title="禁用"
                                               onclick="switchSecondCategory({{$child->id}}, 0)"
                                               class="btn btn-xs btn-info hvr-buzz-out"><i
                                                        class="fa fa-toggle-off"></i></a>
                                    @else
                                            <a title="启用"
                                               onclick="switchSecondCategory({{$child->id}}, 1)"
                                               class="btn btn-xs btn-default hvr-buzz-out"><i
                                                        class="fa fa-toggle-on"></i></a>
                                    @endif
                                    <a title="删除" onclick="deleteSecondCategory({{$child->id}})"
                                       class="btn btn-xs btn-danger hvr-buzz-out"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="categoryFormModal" class="modal fade" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width: 750px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;<span id="firstSortModalTitle">新增一级分类</span></h4>
                </div>
                <div class="modal-body">
                    <form id="categoryForm" class="form-horizontal" method="post">
                        <input type="hidden" name="id" id="categoryIdInputField"/>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">名称<span class="required" aria-required="true">* </span>:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="nameInputField" name="name" class="form-control" maxlength="20" placeholder="请输入分类名称">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">拼音<span class="required" aria-required="true">* </span>:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="pinyinInputField" name="pinyin" class="form-control" maxlength="20" placeholder="请输入分类中文全拼">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">编码<span class="required" aria-required="true">* </span>:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="categoryCodeInputField" name="code" class="form-control" maxlength="20" placeholder="请输入分类编码">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">缩略图:
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">大图:
                                        </label>
                                        <div class="col-md-9">
                                            <div>
                                                <div name="picSelectBtn" style="width: 200px; height: 150px; line-height: 150px;border: 1px solid #eee;border-radius: 3%;margin-bottom: 2%;text-align: center;">
                                                    <img id="previewPic" src="{{asset('/assets/img/noimage.png')}}" style="max-width:100%;width: auto;height: 100%; vertical-align: baseline;padding:2%;"/>
                                                    <input id="picHiddenInputField" type="hidden" name="pic"/>
                                                </div>
                                                <div>
                                                <span class="btn default btn-file">
                                                <span name="picSelectBtn"><i class="fa fa-image"></i> 选择图片</span>
                                                <input id="picInput" style="display: none;" type="file">
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">状态<span class="required" aria-required="true">* </span>:
                                        </label>
                                        <div class="col-md-9">
                                            <div class="md-radio-inline">
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="categoryStatus1" name="status" value="1" checked>
                                                    <label for="categoryStatus1">启用</label>
                                                </div>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="categoryStatus0" name="status" value="0" >
                                                    <label for="categoryStatus0">禁用</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">排序:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="seqInputField" name="seq" class="form-control" maxlength="9" placeholder="请输入排序号">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">广告语:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="adSloganInputField" name="ad_slogan" class="form-control" maxlength="15" placeholder="请输入简短广告语">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">背景色:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="bgColorInputField" name="bg_color" class="form-control" maxlength="9" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">描述:
                                        </label>
                                        <div class="col-md-9">
                                            <textarea id="explainInputField" name="explain" style="resize: none;" class="form-control" rows="4" maxlength="120" placeholder="请输入描述说明"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeCategoryForm" data-dismiss="modal" class="btn btn-outline btn-danger"><i class="fa fa-times"></i>关闭</button>
                    <button type="button" id="submitCategoryFormBtn" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> 确认</button>
                </div>
            </div>
        </div>
    </div>


    <div id="secondCategoryModal" class="modal fade" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width: 441px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;<span id="secondSortModalTitle">新增二级分类</span></h4>
                </div>
                <div class="modal-body">
                    <form id="secondCategoryForm" class="form-horizontal" method="post">
                        <input type="hidden" name="id" id="secondCategoryIdInputField"/>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">一级分类<span class="required" aria-required="true">* </span>:
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="parent_id" id="parentIdInputField" style="width:100%;">
                                                @foreach($categorys as $category)
                                                    @if($category->status == 1)<option value="{{$category->id}}">{{$category->name}}</option>@endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">名称<span class="required" aria-required="true">* </span>:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="secondCategoryNameInputField" name="name" class="form-control" maxlength="10" placeholder="请输入二级分类名称">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">编码<span class="required" aria-required="true">* </span>:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="secondCategoryCodeInputField" name="code" class="form-control" maxlength="20" placeholder="请输入分类编码">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">状态<span class="required" aria-required="true">* </span>:
                                        </label>
                                        <div class="col-md-9">
                                            <div class="col-md-9">
                                                <div class="md-radio-inline">
                                                    <div class="radio radio-info radio-inline">
                                                        <input type="radio" id="secondCategoryStatus1" name="status" value="1" checked>
                                                        <label for="secondCategoryStatus1">启用</label>
                                                    </div>
                                                    <div class="radio radio-info radio-inline">
                                                        <input type="radio" id="secondCategoryStatus0" name="status" value="0" >
                                                        <label for="secondCategoryStatus0">禁用</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">排序:
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="secondCategorySeqInputField" name="seq" class="form-control" maxlength="9" placeholder="请输入排序编号">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeSecondCategory" data-dismiss="modal" class="btn btn-outline btn-danger"><i class="fa fa-times"></i> 关闭</button>
                    <button type="button" id="submitSecondCategoryFormBtn" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> 确认</button>
                </div>
            </div>
        </div>
    </div>
@endsection