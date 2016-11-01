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

