<?php

namespace App\Http\Controllers;

use App\Knowledge;
use App\KnowledgeViews;
use Illuminate\Http\Request;

class KnowlegeController extends Controller
{

    /**
     * 列出知识点
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function List (Request $request)
    {
        if ($request->has('parent')) {
            if ($user = \Auth::guard('api')->user()) {
                KnowledgeViews::create(['knowledge_id' => $request->parent, 'user_id' => $user->id]);
            } else {
                KnowledgeViews::create(['knowledge_id' => $request->parent]);
            }
            return Knowledge::withCount('comments')->where('parent', $request->parent)->get();
        } else {
            return Knowledge::withCount('views')->where('parent', null)->get();
        }
    }
}
