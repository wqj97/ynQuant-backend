<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Knowledge;
use App\KnowledgesPageViewRecord;
use App\KnowledgeView;
use App\News;
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
        return \Cache::remember("knowledgeList_{$request->type}_{$request->parent}", 1, function () use ($request) {
            $user = \Auth::guard('api')->user();
            if ($request->has('parent')) {
                if ($user) {
                    KnowledgeView::create(['knowledge_id' => $request->parent, 'user_id' => $user->id]);
                } else {
                    KnowledgeView::create(['knowledge_id' => $request->parent]);
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

    /**
     * 记录知识点
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * 创建笔记
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function CreateNote (Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'content' => 'required'
        ]);
        $comment = new Comments();
        $comment->content = $request->post('content');
        $comment->user_id = $request->user()->id;
        $comment->knowledge_id = $request->id;
        $comment->save();
        return response()->json('created', 201);
    }

    /**
     * 知识点评论
     * @param Request $request
     * @return mixed
     */
    public function ListComments (Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $comments = Knowledge::find($request->id)->comments()->orderByDesc('id')->paginate();
        return $comments;
    }

    /**
     * 显示创建知识点页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowCreate ()
    {
        $root_knowledges = Knowledge::where('parent', null)->get();
        return view('create_knowledge', compact('root_knowledges'));
    }

    public function SaveCreate (Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'parent' => 'required'
        ]);
        if ($request->parent == 0) {
            Knowledge::create([
                'title' => $request->title,
                'content' => $request->post('content'),
                'parent' => null
            ]);
            return redirect()->action('KnowledgeController@ShowCreate');
        }
        Knowledge::create([
            'title' => $request->title,
            'content' => $request->post('content'),
            'parent' => $request->parent
        ]);
        return redirect()->action('KnowledgeController@ShowCreate');
    }

    public function showKnowledgeWeb (Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $content = Knowledge::find($request->id)->content;
        return view('show_knowledge', compact('content'));
    }
}
