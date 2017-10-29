<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


use App\Models\Prod;
use App\Models\ProdAttach;

class ProdRepository implements IProdRepository
{
    public function paginate($params)
    {
        $query = Prod::select(['prods.*',
            'artists.name as artist_name',
            'prod_categorys.name as category_name',
            'prod_second_categorys.name as second_category_name']);
        $query->leftJoin("artists", function ($join) {
            $join->on("prods.artist_id", '=', 'artists.id')->whereNull('artists.deleted_at');
        })
        ->leftJoin('prod_categorys', 'prod_categorys.id', '=', 'prods.category_id')
        ->leftJoin('prod_second_categorys', 'prod_second_categorys.id', '=', 'prods.second_category_id');
        // 过滤商品名称
        if(!empty($params['name'])) {
            $query->where('prods.name', 'like', "%".$params['name']."%");
        }
        if(!empty($params['sortName'])) {
            $query->orderBy($params['sortName'], (!empty($params['sortOrder']) ? $params['sortOrder'] : 'desc'));
        }
        $paginate = $query->paginate($params['pageSize'], ['prods.id'], 'pageNumber');
        return [
            'pageSize' => $paginate->perPage(),
            'pageNumber' => $paginate->currentPage(),
            'rows' => $paginate->items(),
            'pages' => $paginate->lastPage(),
            'total' => $paginate->total()
        ];
    }


    public function delete($param, Request $request = null)
    {
        Prod::where('id', $param['id'])->delete();
        ProdAttach::where('prod_id', $param['id'])->delete();
    }
}