<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['id', 'title', 'pic', 'author', 'preface', 'content', 'publish_time', 'last_publish_time', 'status', 'views'];
}
