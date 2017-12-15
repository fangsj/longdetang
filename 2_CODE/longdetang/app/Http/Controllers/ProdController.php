<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/11/21
 * Time: 下午5:33
 */

namespace App\Http\Controllers;


use App\Models\Artist;
use App\Models\Prod;
use App\Models\ProdAttach;
use App\Repositorys\ProdCategoryRespository;
use App\Repositorys\ProdRepository;
use Illuminate\Http\Request;

class ProdController extends Controller
{
    protected $prodCategoryRespository;
    protected $prodRepository;

    public function __construct(ProdCategoryRespository $prodCategoryRespository, ProdRepository $prodRepository)
    {
        $this->prodCategoryRespository = $prodCategoryRespository;
        $this->prodRepository = $prodRepository;
    }

    /**
     * 初始化商品列表首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        $data['categorys'] = $this->prodCategoryRespository->get();
        return frontend_view('prod.list', $data);
    }


    /**
     * 获取分类
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get_categorys()
    {
        return $this->prodCategoryRespository->get();
    }

    /**
     * 获取商品列表分页
     *
     * @param Request $request
     * @return array
     */
    public function get_prods(Request $request)
    {
        return $this->prodRepository->paginate_frontend($request->all());
    }

    /**
     * 获取商品列表分页
     *
     * @param Request $request
     * @return array
     */
    public function get_artists(Request $request)
    {
        return Artist::all();
    }

    public function get_detail(Request $request) {
        $data = [];
        $data['prod'] = Prod::find($request->id);
        $data['prod_attachs'] = ProdAttach::where('prod_id', $request->id)->get()->toArray();
        if(empty($data['prod_attachs'])) {
            $data['prod_attachs'] =  [['url' => $data['prod']->bar_pic]];
        } else {
            array_push($data['prod_attachs'], ['url' => $data['prod']->bar_pic]);
        }
        return frontend_view('prod.detail', $data);
    }
}