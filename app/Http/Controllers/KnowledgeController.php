<?php

namespace App\Http\Controllers;

use App\Knowledge;
use App\KnowledgesPageViewRecord;
use App\KnowledgeViews;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{

    /**
     * 列出知识点
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function List (Request $request)
    {
        $user = \Auth::guard('api')->user();
        if ($request->has('parent')) {
            if ($user) {
                KnowledgeViews::create(['knowledge_id' => $request->parent, 'user_id' => $user->id]);
            } else {
                KnowledgeViews::create(['knowledge_id' => $request->parent]);
            }
            return Knowledge::withCount('comments')->where('parent', $request->parent)->get();
        } else {
            if ($user) {
                return Knowledge::withCount(['views'])->with(['userPageTag'])->where('parent', null)->get();
            }
            return Knowledge::withCount('views')->where('parent', null)->get();
        }
    }

    public function pageTag (Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'page' => 'required'
        ]);
        KnowledgesPageViewRecord::where('user_id', $request->user()->id)
            ->where('knowledge_id', $request->id)
            ->updateOrInsert([
                'knowledge_id' => $request->id,
                'user_id' => $request->user()->id,
                'page' => $request->page
            ]);
        return response()->json('success');
    }
}
