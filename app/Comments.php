<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;
    protected $fillable = [
      'user_id', 'news_id', 'knowledge_id', 'content', 'analysis'
    ];

    protected $with = [
        'user_info'
    ];

    protected $withCount = [
        'likes'
    ];

    public function user_info ()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function likes ()
    {
        return $this->hasMany('App\Likes', 'comment_id');
    }
}
