<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/9
 * Time: 下午5:01
 */
require_once("dicts.php");

// 获取字典值
if (!function_exists('dicts')) {
    function dicts($name)
    {
        global $_DICTS;
        $keys = explode('.', $name);
        $val = $_DICTS;
        foreach ($keys as $key) {
            $val = $val[$key];
        }
        return $val;
    }
}

// 后台管理URL
if (!function_exists('admin')) {
    function admin($url)
    {
        return url('admin' . $url);
    }
}

//上传文件访问
if (!function_exists('storage_url')) {
    function storage_url($url)
    {
        return asset('storage/' . $url);
    }
}

if (!function_exists('admin_view')) {
    function admin_view($view = null, $data = [], $mergeData = [])
    {
        return view('admin.'.$view, $data, $mergeData);
    }
}