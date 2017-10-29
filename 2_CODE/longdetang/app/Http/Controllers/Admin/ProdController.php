<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prod;
use App\Models\ProdAttach;
use App\Repositorys\ProdRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdController extends BaseController
{
    use QueryTrait;
    protected $module_name = '商品';
    protected $model;
    protected $repository;
    protected $view_dir = 'prod';
    protected $update_filed = [];

    public function __construct(ProdRepository $repository)
    {
        $this->repository = $repository;
        $this->model = Prod::query();
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return AsyncResult
     */
    public function delete(Request $request)
    {
        $this->model->where('id', $request->id)->delete();
        ProdAttach::where('prod_id', $request->id)->delete();
        return $this->successOnlyMsg($this->module_name.'删除成功!');
    }
}
