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

//Route::get('/', function () {
//    test();
//    return view('welcome');
//});

//注册前台路由组
//middleware -> 中间件
//namespace -> 命名空间
//prefix -> 路由前缀
Route::prefix('/')->group(function(){

    //网站首页
    Route::get('/', 'PostController@index');

    //文章模块
    Route::get('/posts/{post}/delete', 'PostController@delete');
    Route::post('/posts/comment', 'PostController@comment');

    //点赞模块
    Route::get('/posts/{post}/zan', 'PostController@zan')->middleware('checkuser');
    Route::get('/posts/{post}/unzan', 'PostController@unzan')->middleware('checkuser');
    Route::resource('/posts', 'PostController');

    //注册模块
    Route::get('/register', 'RegisterController@index');
    Route::post('/register', 'RegisterController@register');

    //登录模块
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout')->middleware('checkuser');

    //个人设置模块
    Route::get('/user/{user}/setting', 'UserController@setting')->middleware('checkuser');
    Route::post('/user/{user}/setting', 'UserController@settingStore')->middleware('checkuser');

    //个人中心模块
    Route::get('/user/{user}', 'UserController@show');
    Route::post('/user/{user}/fan', 'UserController@fan')->middleware('checkuser');
    Route::post('/user/{user}/unfan', 'UserController@unfan')->middleware('checkuser');

    //专题模块
    Route::get('/topic/{topic}', 'TopicController@show');
    Route::post('/topic/{topic}/submit', 'TopicController@submit');
});
