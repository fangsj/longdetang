<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/11/21
 * Time: 下午5:33
 */

namespace App\Http\Controllers;


use App\Repositorys\ProdCategoryRespository;
use App\Repositorys\ProdRepository;

class ProdController extends Controller
{
    protected $prodCategoryRespository;
    protected $prodRepository;

    public function __construct(ProdCategoryRespository $prodCategoryRespository, ProdRepository $prodRepository)
    {
        $this->prodCategoryRespository = $prodCategoryRespository;
        $this->prodRepository = $prodRepository;
    }

    public function index() {
        $data = [];
        $data['categorys'] = $this->prodCategoryRespository->get();
        return frontend_view('prod.list', $data);
    }

    public function get_categorys() {
        return $this->prodCategoryRespository->get();
    }

    public function get_prods() {
        return $this->prodRepository->paginate();
    }
}