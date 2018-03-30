<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

//    public function getNewsTimeAttribute ()
//    {
//        return $this->attributes['news_time'];
//    }
}
