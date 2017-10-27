<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/26
 * Time: 下午7:47
 */

namespace App\Http\Controllers\Admin;


use App\Http\AsyncResult;
use Exception;
use Illuminate\Http\Request;

trait EditTrait
{
    /**
     * 初始化新增页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initAdd()
    {
        return admin_view($this->view_dir.'.add');
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
            $this->model->create($request->all());
            return $this->successOnlyMsg('保存'.$this->module_name.'成功');
        } catch (Exception $e) {
            return $this->failOnlyMsg('保存'.$this->module_name.'失败,原因：' . $e->getMessage());
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
        return admin_view($this->view_dir.'.add', $this->model->find($request->id)->toArray());
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
            $this->model->where('id', $request->id)->update($request->only($this->update_filed));
            return $this->successOnlyMsg('修改'.$this->module_name.'成功！');
        } catch (Exception $e) {
            return $this->failOnlyMsg('修改'.$this->module_name.'失败,原因：' . $e->getMessage());
        }
    }
}