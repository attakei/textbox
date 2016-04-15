<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::auth();
    // TODO: Oauthドライバー名が固定されている(googleしかない)
    Route::post('/auth/google', ['as' => 'auth_oauth_google', 'uses' => 'Auth\AuthController@redirectToProvider']);
    Route::get('/auth/google/callback', ['as' => 'auth_oauth_callback', 'uses' => 'Auth\AuthController@callbackFromProvider']);

    Route::get('/dashboard', 'HomeController@dashboard');
    Route::get('/mypage', 'HomeController@mypage');
    Route::get('/users/_me/profile', 'UserController@showProfileForm');
    Route::post('/users/_me/profile', 'UserController@editProfile');

    Route::get('/articles', ['as' => 'get_article_list', 'uses' => 'ArticleController@getList']);
    Route::get('/articles/_new', ['as' => 'form_new_article', 'uses' => 'ArticleController@newForm']);
    Route::post('/articles/_new', ['as' => 'post_new_article', 'uses' => 'ArticleController@postOne']);
    Route::get('/articles/{articleId}', ['as' => 'get_article_single', 'uses' => 'ArticleController@getOne']);
    Route::get('/articles/{articleId}/_edit', ['as' => 'form_edit_article', 'uses' => 'ArticleController@editForm']);
    Route::post('/articles/{articleId}/_edit', ['as' => 'form_edit_article', 'uses' => 'ArticleController@postOne']);

    Route::get('/tags/', ['as' => 'get_tags_list', 'uses' => 'TagController@getList']);
    Route::get('/tags/{tagBody}', ['as' => 'list_by_tag', 'uses' => 'ArticleController@getListByTag']);
});


/* 固定ページ
 */
Route::group(['prefix' => '/pages', 'middleware' => ['web']], function () {
    Route::group(['middleware' => 'adminOnly'], function(){
        Route::get('/', ['as' => 'get_page_list', 'uses' => 'PageController@getList']);
        Route::get('/_new', ['as' => 'form_new_page', 'uses' => 'PageController@newForm']);
        Route::post('/_new', ['as' => 'post_new_page', 'uses' => 'PageController@postOne']);
        Route::get('/{pageId}/_edit', ['as' => 'form_edit_page', 'uses' => 'PageController@editForm']);
        Route::post('/{pageId}/_edit', ['as' => 'form_edit_page', 'uses' => 'PageController@postOne']);
    });
    Route::get('/{pageId}', ['as' => 'get_page_single', 'uses' => 'PageController@getOne']);
});


/* API系
 */
Route::group(['prefix' => '/api', 'middleware' => ['api']], function () {
    Route::post('/authenticate', ['uses' => 'AuthenticateController@authenticate']);
});
