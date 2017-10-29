<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdAttach extends Model
{
    //
    protected $table = 'prod_attachs';
    use SoftDeletes;
}
