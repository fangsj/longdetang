<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/26
 * Time: 下午7:34
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

trait QueryTrait
{
    /**
     * 首页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!$request->has('keep')) {
            $request->session()->put('search', $request->all());
        }
        return admin_view($this->view_dir . '.list', $request->session()->get('search'));
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
        return $this->repository->paginate($request->all());
    }
}