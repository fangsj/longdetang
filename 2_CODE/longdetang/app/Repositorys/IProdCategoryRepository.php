<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/23
 * Time: 下午6:04
 */

namespace App\Repositorys;


use App\Models\ProdCategory;

interface IProdCategoryRepository
{
    public function get();
    public function delete($id);
    public function open($id);
    public function close($id);
}