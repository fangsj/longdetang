<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/25
 * Time: 下午1:17
 */

namespace App\Repositorys;


interface IVideoLibRepository
{
    public function paginate($params);

    public function switch_status($params);
}