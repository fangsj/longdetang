<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prod extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name', 'artist_id', 'code', 'price', 'category_id', 'second_category_id', 'bar_pic', 'pic', 'texture', 'capacity', 'details', 'brief', 'is_essence', 'views', 'status'];
}
