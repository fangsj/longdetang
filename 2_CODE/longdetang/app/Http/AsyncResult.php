<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/23
 * Time: 下午10:02
 */

namespace App\Http;


class AsyncResult
{
    public $status;
    public $data;
    public $msg;

    public static function success($data = null, $msg = 'success') {
        $result = new AsyncResult;
        $result->status = 0;
        $result->data = $data;
        $result->msg = $msg;
        return $result;
    }

    public static function successWithMsg($msg) {
        $result = new AsyncResult;
        $result->status = 0;
        $result->msg = $msg;
        return $result;
    }

    public static function fail($data = null, $msg = 'fail') {
        $result = new AsyncResult;
        $result->status = 1;
        $result->data = $data;
        $result->msg = $msg;
        return $result;
    }

    public static function failWithMsg($msg = '操作失败！') {
        $result = new AsyncResult;
        $result->status = 1;
        $result->msg = $msg;
        return $result;
    }
}