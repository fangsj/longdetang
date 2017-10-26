<?php

namespace App\Http\Controllers\Admin;

use App\Http\AsyncResult;
use App\Models\Artist;
use App\Repositorys\ArtistRepository;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends BaseController
{
    protected $artistRepository;

    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    /**
     * 艺人首页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!$request->has('keep')) {
            $request->session()->put('search', $request->all());
        }
        return admin_view('artist.list', $request->session()->get('search'));
    }

    /**
     * 查询
     *
     * @param Request $request
     * @return array
     */
    public function query(Request $request)
    {
        // 保留查询条件
        $request->session()->put('search', $request->all());
        return $this->artistRepository->paginate($request->all());
    }

    /**
     * 删除艺人
     *
     * @param Request $request
     * @return AsyncResult
     */
    public function delete(Request $request)
    {
        Artist::where('id', $request->id)->delete();
        return $this->successOnlyMsg('艺人删除成功!');
    }

    /**
     * 初始化新增页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initAdd()
    {
        return admin_view('artist.add');
    }


    /**
     * 保存
     *
     * @param Request $request
     * @return AsyncResult
     */
    public function add(Request $request)
    {
        try {
            Artist::create($request->all());
            return $this->successOnlyMsg('保存艺人成功');
        } catch (Exception $e) {
            return $this->failOnlyMsg('保存艺人失败,原因：' . $e->getMessage());
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
        return admin_view('artist.add', Artist::find($request->id)->toArray());
    }


    /**
     * 修改
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        try {
            Artist::where('id', $request->id)->update($request->only(['name', 'pic', 'views', 'works', 'intro']));
            return $this->successOnlyMsg('修改艺人成功！');
        } catch (Exception $e) {
            return $this->failOnlyMsg('修改艺人失败,原因：' . $e->getMessage());
        }
    }
}
