<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/11/26
 * Time: 下午7:48
 */

namespace App\Http\Controllers;


use App\Repositorys\VideoLibRepository;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    protected $videoRepository;

    public function __construct(VideoLibRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * 获取视频列表
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        return $this->videoRepository->paginate($request->all());
    }

}