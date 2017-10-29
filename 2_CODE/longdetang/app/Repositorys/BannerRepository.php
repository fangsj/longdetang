<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


use App\Models\Banner;

class BannerRepository implements IBannerRepository
{
    public function paginate($params)
    {
        $query = Banner::toBase();
        if(!empty($params['title'])) {
            $query->where('title', 'like', "%".$params['title']."%");
        }
        if(!empty($params['sortName'])) {
            $query->orderBy($params['sortName'], (!empty($params['sortOrder']) ? $params['sortOrder'] : 'desc'));
        }
        $paginate = $query->paginate($params['pageSize'], ['*'], 'pageNumber');
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
        Banner::where('id', $param['id'])->delete();
    }
}