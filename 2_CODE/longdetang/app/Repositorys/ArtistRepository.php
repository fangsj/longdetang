<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistRepository implements IArtistRepository
{
    public function paginate($params)
    {
        $query = Artist::toBase();
        if (!empty($params['name'])) {
            $query->where('name', 'like', "%" . $params['name'] . "%");
        }
        if (!empty($params['sortName'])) {
            $query->orderBy($params['sortName'], (!empty($params['sortOrder']) ? $params['sortOrder'] : 'desc'));
        }
        $paginate = $query->paginate($params['pageSize'], ['*'], 'pageNumber');
        return [
            'pageSize' => $paginate->perPage(),
            'pageNumber' => $paginate->currentPage(),
            'rows' => $paginate->items(),
            'pages' => $paginate->total() == 0 ? 0 : $paginate->lastPage(),
            'total' => $paginate->total(),
            'nextPage' => $paginate->previousPageUrl()
        ];
    }

    public function delete($param, Request $request = null)
    {
        Artist::where('id', $param['id'])->delete();
    }
}