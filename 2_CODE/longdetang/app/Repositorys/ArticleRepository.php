<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


use App\Models\Article;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements IArticleRepository
{
    public function paginate($params)
    {
        $query = Article::toBase();
        if (!empty($params['title'])) {
            $query->where('title', 'like', "%" . $params['title'] . "%");
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
            'total' => $paginate->total()
        ];
    }

    public function delete($param, Request $request = null)
    {
        Article::where('id', $param['id'])->delete();
    }

    public function switch_status($params) {
        if($params['status'] == 1 ) {
            DB::update('update articles set status=1,last_publish_time = now(), publish_time = ifnull(publish_time, now()), updated_at = now() where id = ?', [$params['id']]);
        } else {
            DB::update('update articles set status=2, updated_at = now() where id = ?', [$params['id']]);
        }
    }
}