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
    Route::get('comments', 'NewsController@ListComments'); // 获取新闻评论
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('comments', 'NewsController@CreateComment'); //创建新闻评论
    });
});

Route::group(['prefix' => 'knowledge'], function () {
    Route::get('', 'KnowledgeController@List'); // 获取知识点
    Route::get('note', 'KnowledgeController@ListComments'); // 获取评论
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('pageTag', 'KnowledgeController@pageTag'); // 知识点观看记录
        Route::post('note', 'KnowledgeController@CreateNote'); // 创建评论
    });
});

Route::group(['prefix' => 'comment', 'middleware' => ['auth:api']], function () {
    Route::get('like', 'CommentController@Like'); // 点赞
});
