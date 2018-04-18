<?php

namespace App\Http\Controllers;

use App\Comments;
use App\News;
use App\NewsViews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * 获取新闻列表
     * @return \Illuminate\Support\Collection
     */
    public function List ()
    {
        return News::selectRaw('id,title,content,news_time,created_at')
            ->selectRaw('Date(news_time) as date')
            ->orderByDesc('id')
            ->paginate(15)
            ->groupBy('date');
    }

    /**
     * 返回新闻详情
     * @param Request $request
     * @return mixed|static
     */
    public function NewsDetail (Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        // 记录阅读信息
        if ($user = Auth::guard('api')->user()) {
            NewsViews::create(['news_id' => $request->id, 'user_id' => $user->id]);
        } else {
            NewsViews::create(['news_id' => $request->id]);
        }
        $news = News::withCount('views', 'comments')->find($request->id);
        $news->comments = $news->comments()->orderByDesc('id')->limit(10)->get();
        return $news;
    }

    /**
     * 新闻评论
     * @param Request $request
     * @return mixed
     */
    public function ListComments (Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $comments = News::find($request->id)->comments()->orderByDesc('id')->paginate();
        return $comments;
    }

    /**
     * 创建新闻评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function CreateComment (Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'content' => 'required'
        ]);
        $comment = new Comments();
        $comment->content = $request->post('content');
        $comment->user_id = $request->user()->id;
        $comment->news_id = $request->id;
        $comment->save();
        return response()->json('created', 201);
    }
}
