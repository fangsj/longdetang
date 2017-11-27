<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


use App\Models\VideoLib;
use Illuminate\Support\Facades\DB;

class VideoLibRepository implements IVideoLibRepository
{
    public function paginate($params)
    {
        $query = DB::table('video_libs')->select('*');
        $query->whereNull('deleted_at');
        if(!empty($params['sortName'])) {
            $query->orderBy($params['sortName'], (!empty($params['sortOrder']) ? $params['sortOrder'] : 'desc'));
        }
        if(!empty($params['title'])) {
            $query->where('title', 'like', "%".$params['title']."%");
        }
        if(isset($params['status'])) {
            $query->where('status', $params['status']);
        }
        $paginate = $query->paginate($params['pageSize'], ['id'], 'pageNumber');
        return [
            'pageSize' => $paginate->perPage(),
            'pageNumber' => $paginate->currentPage(),
            'rows' => $paginate->items(),
            'pages' => $paginate->total() == 0 ? 0 : $paginate->lastPage(),
            'total' => $paginate->total()
        ];
    }

    public function switch_status($params) {
        if($params['status'] == 1 ) {
            DB::update('update video_libs set status=1,last_publish_time = now(), publish_time = ifnull(publish_time, now()), updated_at = now() where id = ?', [$params['id']]);
        } else {
            DB::update('update video_libs set status=2, updated_at = now() where id = ?', [$params['id']]);
        }
    }

    public function delete($param, Request $request = null)
    {
        VideoLib::where('id', $param['id'])->delete();
    }
}