<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prod;
use App\Repositorys\ProdRepository;

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
}
