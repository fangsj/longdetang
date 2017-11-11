<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artist;
use App\Models\Prod;
use App\Models\ProdAttach;
use App\Repositorys\ProdCategoryRespository;
use App\Repositorys\ProdRepository;
use Exception;
use Illuminate\Http\Request;

class ProdController extends BaseController
{
    use QueryTrait, EditTrait, DeleteTrait;
    protected $module_name = '商品';
    protected $model;
    protected $repository;
    protected $view_dir = 'prod';
    protected $update_filed = [];
    protected $create_fileds = [];

    public function __construct(ProdRepository $repository)
    {
        $this->repository = $repository;
        $this->model = Prod::query();
    }

    /**
     * 初始化新增页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initAdd(ProdCategoryRespository $prodCategoryRespository)
    {
        return admin_view($this->view_dir.'.add', ['categorys' => $prodCategoryRespository->get()]);
    }


    /**
     * 保存
     *
     * @param Request $request
     * @return AsyncResult
     */
    public function add(Request $request)
    {
        try {
            $this->repository->save($request->all(), $request);
            return $this->successOnlyMsg('保存'.$this->module_name.'成功');
        } catch (Exception $e) {
            return $this->failOnlyMsg('保存'.$this->module_name.'失败,原因：' . $e->getMessage());
        }
    }

    /**
     * 初始化修改
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initEdit(Request $request, ProdCategoryRespository $prodCategoryRespository)
    {
        $model = Prod::find($request->id)->toArray();
        if($model['artist_id']) {
            $model['artist_name'] = Artist::find($model['artist_id'])->name;
        }
        $model['attachs'] = ProdAttach::where('prod_id', $request->id)->get()->toArray();
        return admin_view($this->view_dir.'.add', ['categorys' => $prodCategoryRespository->get(),
            'model' => $model]);
    }


    /**
     * 修改
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        try {
            $this->repository->save($request->all(), $request);
            return $this->successOnlyMsg('修改'.$this->module_name.'成功！');
        } catch (Exception $e) {
            return $this->failOnlyMsg('修改'.$this->module_name.'失败,原因：' . $e->getMessage());
        }
    }

    /**
     * 切换状态成功
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchStatus(Request $request) {
        $op = $request->status == 1 ? '发布' : '下架';
        try {
            $this->repository->switch_status($request->all());
            return $this->successOnlyMsg($op.$this->module_name."成功");
        } catch (Exception $e) {
            return $this->failOnlyMsg($op.$this->module_name."失败，发生异常：".$e->getMessage());
        }
    }
}
