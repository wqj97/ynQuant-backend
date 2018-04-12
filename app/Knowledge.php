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
    public function Views ()
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
}
