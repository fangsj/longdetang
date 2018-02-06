<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MidHotRecom extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'position', 'pic', 'mobile_pic', 'link'];
}
