<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/23
 * Time: 下午6:03
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdSecondCategory extends Model
{
    use SoftDeletes;

    protected $table = 'prod_second_categorys';
    protected $fillable = ['parent_id', 'name', 'seq', 'status', 'code'];
}