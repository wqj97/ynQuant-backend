<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Knowledge extends Model
{
    use SoftDeletes;

    /**
     * 知识点查看次数
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views ()
    {
        return $this->hasMany('App\knowledgeViews', 'knowledge_id');
    }

    /**
     * 知识点评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments ()
    {
        return $this->hasMany('App\Comments', 'knowledge_id');
    }

    /**
     * 阅读标签
     * @return Knowledge|\Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userPageTag ()
    {
        return $this->hasOne('App\KnowledgesPageViewRecord', 'knowledge_id')
            ->where('user_id', \Auth::guard('api')->user()->id ?? null);
    }
}
