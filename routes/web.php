<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'ynQuant';
});

Route::group(['prefix' => 'user'], function () {
    Route::post('login', 'UserController@Login');
    Route::post('regist', 'UserController@Regist');
});

Route::group(['prefix' => 'knowledge'], function () {
    Route::get('', 'KnowledgeController@ShowCreate');
    Route::get('show', 'KnowledgeController@showKnowledgeWeb');
    Route::get('list', 'KnowledgeController@listKnowledgeWeb');
    Route::get('edit', 'KnowledgeController@showEditKnowledgeWeb');
    Route::post('edit', 'KnowledgeController@editKnowledgeWeb')->name('edit_knowledge');
    Route::post('create', 'KnowledgeController@SaveCreate')->name('create_knowledge');
});
