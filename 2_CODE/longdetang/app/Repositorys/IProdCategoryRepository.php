<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/23
 * Time: 下午6:04
 */

namespace App\Repositorys;


use Illuminate\Http\Request;

interface IProdCategoryRepository
{
    public function get();
    public function delete($id, Request $request = null);
    public function open($id);
    public function close($id);
}