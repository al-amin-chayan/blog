<?php

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */


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
Route::group(['middleware' => 'auth'], function() {
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

    //--------Route Group with some Administrative Privileges-----------------
    Route::group(['middleware' => 'administrator'], function() {
        Route::get('professions/trash', 'ProfessionsController@trash');
        Route::post('professions/clean/{id}', 'ProfessionsController@clean');
        Route::post('professions/restore/{id}', 'ProfessionsController@restore');

        Route::get('users/trash', 'UsersController@trash');
        Route::post('users/clean/{id}', 'UsersController@clean');
        Route::post('users/restore/{id}', 'UsersController@restore');
        Route::resource('users', 'UsersController');

        Route::get('tags/trash', 'TagsController@trash');
        Route::post('tags/clean/{id}', 'TagsController@clean');
        Route::post('tags/restore/{id}', 'TagsController@restore');

        Route::get('subjects/trash', 'SubjectsController@trash');
        Route::post('subjects/clean/{id}', 'SubjectsController@clean');
        Route::post('subjects/restore/{id}', 'SubjectsController@restore');

        Route::get('galleries/trash', 'GalleriesController@trash');
        Route::post('galleries/clean/{id}', 'GalleriesController@clean');
        Route::post('galleries/restore/{id}', 'GalleriesController@restore');

        Route::get('videos/trash', 'VideosController@trash');
        Route::post('videos/clean/{id}', 'VideosController@clean');
        Route::post('videos/restore/{id}', 'VideosController@restore');

        Route::get('articles/trash', 'ArticlesController@trash');
        Route::post('articles/clean/{id}', 'ArticlesController@clean');
        Route::post('articles/restore/{id}', 'ArticlesController@restore');
    });

    Route::get('professions/users/{profession}', 'ProfessionsController@users');
    Route::resource('professions', 'ProfessionsController', ['except' => ['show']]);
    Route::resource('galleries', 'GalleriesController');
    Route::resource('videos', 'VideosController');
    Route::resource('articles', 'ArticlesController');
    Route::get('/', 'WelcomeController@index');
});
