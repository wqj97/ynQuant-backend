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
        return News::selectRaw('*')
            ->selectRaw('Date(news_time) as date')
            ->orderByDesc('news_time')->paginate(15)->groupBy('date');
    }
}
