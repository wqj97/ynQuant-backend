<?php

namespace App\Http\Controllers;

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
        return \Cache::remember("news_{$request->id}", 1, function () use ($request) {
            $news = News::withCount('views')->find($request->id);
            $news->comments = $news->comments()->orderByDesc('id')->limit(10)->get();
            return $news;
        });
    }

    /**
     * 新闻评论
     * @param Request $request
     * @return mixed
     */
    public function NewsComments (Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'page' => 'required'
        ]);
        return \Cache::remember("news_{$request->id}_{$request->page}", 1, function () use ($request) {
            $comments = News::find($request->id)->comments()->orderByDesc('id')->paginate();
            return $comments;
        });
    }
}
