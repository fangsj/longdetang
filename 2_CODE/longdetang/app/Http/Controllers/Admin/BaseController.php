<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/21
 * Time: 下午3:17
 */

namespace App\Http\Controllers\Admin;


use App\Http\AsyncResult;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected function success($data, $msg) {
        return response()->json(AsyncResult::success($data, $msg));
    }


    protected function successOnlyMsg($msg) {
        return response()->json(AsyncResult::successWithMsg($msg));
    }

    protected function fail($data, $msg) {
        return response()->json(AsyncResult::success($data, $msg));
    }

    protected function failOnlyMsg($msg) {
        return response()->json(AsyncResult::failWithMsg($msg));
    }

}