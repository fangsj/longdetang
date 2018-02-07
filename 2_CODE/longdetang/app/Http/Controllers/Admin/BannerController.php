<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artist;
use App\Models\Banner;
use App\Repositorys\BannerRepository;
use Illuminate\Http\Request;

class BannerController extends BaseController
{

    use QueryTrait, EditTrait, DeleteTrait;
    protected $module_name = '轮播图';
    protected $model;
    protected $repository;
    protected $view_dir = 'banner';
    protected $update_filed = ['title', 'pic', 'mobile_pic', 'drill_value','seq', 'status'];

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->repository = $bannerRepository;
        $this->model = Banner::query();
    }
}
