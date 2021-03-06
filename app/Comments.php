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

    protected $casts = [
        'current_user_liked_count' => 'boolean'
    ];

    protected $with = [
        'user_info'
    ];

    protected $withCount = [
        'likes', 'current_user_liked'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function user_info ()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function likes ()
    {
        return $this->hasMany('App\Likes', 'comment_id');
    }

    public function current_user_liked ()
    {
        return $this->hasOne('App\Likes', 'comment_id')->where('user_id', \Auth::guard('api')->user()->id ?? null);
    }
}
