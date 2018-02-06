<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/11/20
 * Time: 下午10:30
 */

namespace App\Http\Controllers;


use App\Models\Banner;
use App\Models\MidHotRecom;
use App\Repositorys\ProdCategoryRespository;

class IndexController extends Controller
{
    protected $repository;

    public function __construct(ProdCategoryRespository $categoryRespository)
    {
        $this->repository = $categoryRespository;
    }

    public function index() {
        $data = [];
        $data['banners'] = Banner::where('status', 1)->orderBy('seq')->get(); // 获取banner
        $data['categorys'] = $this->repository->getCategoryLimitProd();
        $data['hotRecoms'] = [];
        foreach (MidHotRecom::all()->toArray() as $recom) {
            $data['hotRecoms'][$recom['position']] = $recom;
        }
        return frontend_view('index', $data);
    }
}