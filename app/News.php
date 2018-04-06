<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    /**
     * 新闻所有的评论
     */
    public function comments ()
    {
        return $this->hasMany('App\Comments', 'news_id');
    }
}
