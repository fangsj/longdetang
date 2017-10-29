<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


interface IBannerRepository
{
    public function paginate($params);
    public function delete($param, Request $request = null);
}