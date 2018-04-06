<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'news'], function () {
    Route::get('', 'NewsController@NewsDetail'); // 获取新闻详情(评论, 关联新闻)
    Route::get('list', 'NewsController@List'); // 获取新闻列表
});
