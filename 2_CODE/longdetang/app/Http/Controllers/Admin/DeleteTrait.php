<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/26
 * Time: 下午7:42
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

trait DeleteTrait
{
    /**
     * 删除
     *
     * @param Request $request
     * @return AsyncResult
     */
    public function delete(Request $request)
    {
        $this->repository->delete($request->all());
        return $this->successOnlyMsg($this->module_name.'删除成功!');
    }
}