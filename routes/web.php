<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'Admin::'], function () {

    //--------Route Resource Model Binding-----------------
    Route::model('tag', 'App\Models\Tag');
    Route::model('gallery', 'App\Models\Gallery');
    Route::model('video', 'App\Models\Video');
    Route::model('profession', 'App\Models\Profession');
    Route::model('user', 'App\Models\User');
    
    //Moved to Route Service Provider
//    Route::bind('article', function ($id) {
//        return App\Models\Article::where([
//                    ['id', $id],
//                    ['user_id', Auth::user()->id],
//                ])->firstOrFail();
//    });

    Route::singularResourceParameters();

    //--------Route Group without Middleware: Auth-----------------
    Route::get('logout', '\App\Http\Controllers\Admin\Auth\LoginController@getLogout');
    Auth::routes();

    //--------Route Group with Middleware: Auth-----------------
    Route::group(['middleware' => 'auth'], function(){
        Route::resource('tags', 'TagsController', ['except' => [
            'show'
        ]]);
        Route::resource('subjects', 'SubjectsController', ['except' => [
            'show'
        ]]);

        //--------Users Profile Update-----------------
        Route::get('profile', 'UsersController@profile');
        Route::patch('update-profile', 'UsersController@updateProfile');

        Route::get('password', 'UsersController@password');
        Route::patch('update-password', 'UsersController@updatePassword');
        
        Route::resource('users', 'UsersController');
        Route::get('professions/users/{profession}', 'ProfessionsController@users');
        Route::resource('professions', 'ProfessionsController', ['except' => ['show']]);
        Route::resource('galleries', 'GalleriesController');
        Route::resource('videos', 'VideosController');
        Route::resource('articles', 'ArticlesController');
        Route::get('/', 'WelcomeController@index');
    });
});

Route::group(['namespace' => 'Front', 'as' => 'Front::'], function () {
    Route::get('/', 'BlogController@home');
    Route::get('/post/{id}/{slug}', 'BlogController@post');
    Route::get('/profession/{id}', 'BlogController@profession');
    Route::get('/user/{id}', 'BlogController@user');
    Route::get('/subject/{id}/{slug}', 'BlogController@subject');
    Route::get('/post/tag/{id}/{slug}', 'BlogController@tag');
    Route::get('/gallery/{id}', 'VideoController@gallery');
    Route::get('/video/tag/{id}/{slug}', 'VideoController@tag');
    Route::get('/video/{id}', 'VideoController@show');
    Route::post('/article-comment', 'BlogController@comment');
    Route::post('/video-comment', 'VideoController@comment');
});

