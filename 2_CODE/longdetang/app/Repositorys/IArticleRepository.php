<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


use Illuminate\Http\Request;

interface IArticleRepository
{
    public function paginate($params);
    public function delete($param, Request $request = null);
    public function switch_status($params);
}