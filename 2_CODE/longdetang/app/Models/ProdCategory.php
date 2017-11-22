<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/23
 * Time: 下午6:01
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdCategory extends Model
{
    protected $table = 'prod_categorys';

    public $child = [];

    protected $appends = ['child'];

    public function getChildAttribute()
    {
        return $this->child;
    }
    use SoftDeletes;
}