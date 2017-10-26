<?php

namespace App\Http\Controllers\Admin;

use App\Http\AsyncResult;
use App\Models\ProdCategory;
use App\Models\ProdSecondCategory;
use App\Repositorys\ProdCategoryRespository;
use Exception;
use Illuminate\Http\Request;

class ProdCategoryController extends BaseController
{
    protected $prodCategoryRespository;

    public function __construct(ProdCategoryRespository $prodCategoryRespository)
    {
        $this->prodCategoryRespository = $prodCategoryRespository;
    }

    //
    public function list()
    {
        return admin_view('prod.category.list', ['categorys' => $this->prodCategoryRespository->get()]);
    }

    /**
     * 新增一级分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        try {
            $category = new ProdCategory;
            $category->name = $request->name;
            $category->pic = $request->pic;
            $category->thumbnail = $request->thumbnail;
            $category->code = $request->code;
            $category->pinyin = $request->pinyin;
            $category->status = $request->status;
            $category->seq = $request->seq;
            $category->ad_slogan = $request->ad_slogan;
            $category->explain = $request->explain;
            $category->save();
            return response()->json(AsyncResult::successWithMsg('分类保存成功！'));
        } catch (Exception $exception) {
            return response()->json(AsyncResult::fail(null, '分类保存失败！发生异常：' . $exception->getMessage()));
        }
    }

    /**
     * 初始化修改数据
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function initEdit(Request $request)
    {
        return response()->json(AsyncResult::success(ProdCategory::find($request->id)));
    }

    /**
     * 更新一级分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        try {
            ProdCategory::where('id', $request->id)->update($request->except(['id']));
            return response()->json(AsyncResult::successWithMsg('分类修改成功！'));
        } catch (Exception $exception) {
            return response()->json(AsyncResult::fail(null, '分类修改失败！发生异常：' . $exception->getMessage()));
        }
    }

    /**
     * 删除一级分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->prodCategoryRespository->delete($request->id);
        return response()->json(AsyncResult::successWithMsg('分类删除成功！'));
    }


    /**
     * 启用一级分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enable(Request $request) {
        $this->prodCategoryRespository->open($request->id);
        return response()->json(AsyncResult::successWithMsg('该分类以及子分类启用成功！'));
    }

    /**
     * 禁用一级分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function disable(Request $request) {
        $this->prodCategoryRespository->close($request->id);
        return response()->json(AsyncResult::successWithMsg('该分类以及子分类禁用成功！'));
    }

    /**
     * 增加二级分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addSecondCategory(Request $request)
    {
        try {
            ProdSecondCategory::create($request->except(['id']));
            return response()->json(AsyncResult::successWithMsg('子分类新增成功！'));
        } catch (Exception $exception) {
            return response()->json(AsyncResult::fail(null, '子分类新增失败！发生异常：' . $exception->getMessage()));
        }
    }

    /**
     * 初始化修改二级分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function initEditSecondCategory(Request $request)
    {
        return response()->json(AsyncResult::success(ProdSecondCategory::find($request->id)));
    }


    /**
     * 修改二级分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editSecondCategory(Request $request)
    {
        try {
            ProdSecondCategory::where('id', $request->id)->update($request->except(['id']));
            return response()->json(AsyncResult::successWithMsg('子分类修改成功！'));
        } catch (Exception $exception) {
            return response()->json(AsyncResult::fail(null, '子分类修改失败！发生异常：' . $exception->getMessage()));
        }
    }

    /**
     * 删除二级分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSecondCategory(Request $request)
    {
        ProdSecondCategory::where('id', $request->id)->delete();
        return response()->json(AsyncResult::successWithMsg('二级分类删除成功！'));
    }

    /**
     * 启用、禁用二级分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchSecondCategory(Request $request) {
        ProdSecondCategory::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json(AsyncResult::successWithMsg("该分类".($request->status == 1 ? '启用' : '禁用')."成功！"));
    }

}
