<?php

namespace App\Http\Controllers\Admin;

use App\Http\AsyncResult;
use App\Models\VideoLib;
use App\Repositorys\VideoLibRepository;
use Illuminate\Http\Request;
use Mockery\Exception;

class VideoLibController extends BaseController
{
    use QueryTrait, EditTrait, DeleteTrait;
    protected $module_name = '视频';
    protected $model;
    protected $repository;
    protected $view_dir = 'video';
    protected $update_filed = ['title', 'pic', 'url', 'views', 'status','description', 'seq'];


    public function __construct(VideoLibRepository $repository)
    {
        $this->repository = $repository;
        $this->model = VideoLib::query();
    }

    /**
     * 切换视频状态成功
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchStatus(Request $request) {
        $op = $request->status == 1 ? '发布' : '下架';
        try {
            $this->repository->switch_status($request->all());
            return $this->successOnlyMsg($op."视频成功");
        } catch (Exception $e) {
            return $this->failOnlyMsg($op."视频失败，发生异常：".$e->getMessage());
        }
    }

}
