<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

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
            ->orderByDesc('news_time')
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

        return \Cache::remember("news_{$request->id}", 1, function () use ($request) {
            return News::with('comments')->find($request->id);
        });
    }
}
