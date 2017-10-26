<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoLib extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['id', 'title', 'pic', 'url', 'views', 'status', 'seq',
        'publish_time', 'last_publish_time', 'description'];
}
