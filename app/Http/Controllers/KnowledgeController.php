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
     * @return mixed
     */
    public function List (Request $request)
    {
        $this->validate($request, [
            'type' => 'required_without:parent'
        ]);
        return \Cache::remember('knowledgeList', 1, function () use ($request) {
            $user = \Auth::guard('api')->user();
            if ($request->has('parent')) {
                if ($user) {
                    KnowledgeViews::create(['knowledge_id' => $request->parent, 'user_id' => $user->id]);
                } else {
                    KnowledgeViews::create(['knowledge_id' => $request->parent]);
                }
                return Knowledge::withCount('comments')->where('parent', $request->parent)->get();
            } else {
                $knowledge = Knowledge::withCount(['views', 'total', 'finished'])->where('parent', null)->where('type', $request->type);
                if ($user) {
                    return $knowledge->with(['userPageTag'])->get();
                }
                return $knowledge->get();
            }
        });
    }

    public function pageTag (Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'page' => 'required'
        ]);
        KnowledgesPageViewRecord::updateOrCreate([
            'knowledge_id' => $request->id,
            'user_id' => $request->user()->id], [
            'page' => $request->page
        ]);
        return response()->json('success');
    }
}
