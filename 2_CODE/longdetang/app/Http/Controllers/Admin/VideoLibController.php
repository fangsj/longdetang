<?php

namespace App\Http\Controllers\Admin;

use App\Http\AsyncResult;
use App\Models\VideoLib;
use App\Repositorys\VideoLibRepository;
use Illuminate\Http\Request;
use Mockery\Exception;

class VideoLibController extends BaseController
{
    protected $videoLibRepository;

    public function __construct(VideoLibRepository $videoLibRepository)
    {
        $this->videoLibRepository = $videoLibRepository;
    }


    public function index(Request $request)
    {
        if (!$request->has('keep')) {
            $request->session()->put('search', $request->all());
        }
        return admin_view('video.list', $request->session()->get('search'));
    }

    public function query(Request $request)
    {
        // 保留查询条件
        $request->session()->put('search', $request->all());
        return $this->videoLibRepository->paginate($request->all());
    }

    /**
     * 删除视频
     *
     * @param Request $request
     * @return AsyncResult
     */
    public function delete(Request $request)
    {
        VideoLib::where('id', $request->id)->delete();
        return $this->successOnlyMsg('视频删除成功!');
    }

    /**
     * 初始化新增页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initAdd()
    {
        return admin_view('video.add');
    }


    /**
     * 保存视频
     *
     * @param Request $request
     * @return AsyncResult
     */
    public function add(Request $request)
    {
        try {
            VideoLib::create($request->all());
            return $this->successOnlyMsg('保存视频成功');
        } catch (Exception $e) {
            return $this->failOnlyMsg('保存视频失败,原因：' . $e->getMessage());
        }
    }


    /**
     * 初始化修改
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initEdit(Request $request)
    {
        return admin_view('video.add', VideoLib::find($request->id)->toArray());
    }


    /**
     * 修改视频
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        try {
            VideoLib::where('id', $request->id)->update($request->only(['title', 'pic', 'url', 'views', 'status','description', 'seq']));
            return $this->successOnlyMsg('修改视频成功！');
        } catch (Exception $e) {
            return $this->failOnlyMsg('修改视频失败,原因：' . $e->getMessage());
        }
    }

    /**
     * 切换视频状态成功
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchStatus(Request $request) {
        $op = $request->status == 1 ? '发布' : '下架';
        try {
            $this->videoLibRepository->switch_status($request->all());
            return $this->successOnlyMsg($op."视频成功");
        } catch (Exception $e) {
            return $this->failOnlyMsg($op."视频失败，发生异常：".$e->getMessage());
        }
    }

}
