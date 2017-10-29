<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


use App\Models\Artist;

class ArtistRepository implements IArtistRepository
{
    public function paginate($params)
    {
        $query = Artist::toBase();
        if(!empty($params['name'])) {
            $query->where('name', 'like', "%".$params['name']."%");
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


}