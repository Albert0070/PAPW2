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

Route::get('/', 'PostController@index')->name('landing');
Route::get('/mostLike', 'PostController@mostLike')->name('landing.like');
Route::get('/mostComment', 'PostController@mostComment')->name('landing.comment');
Route::get('/Search', 'PostController@search')->name('landing.searching');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/img/{filename}', 'HomeController@getImage')->name('user');
Route::get('/post/arch/{filename}', 'PostController@getImage')->name('lol');

Route::get('/configuration', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::post('/post/update', 'PostController@update')->name('post.update');

Route::get('/updatePost/{id}', 'PostController@postPage')->name('post.page');


Route::post('/post/new', 'PostController@save')->name('post.save');
Route::post('/comments','commentController@save')->name('comment.save');
Route::get('/like/{id_post}','LikeController@likes')->name('like.insert');
Route::get('/dislike/{id_post}','LikeController@dislikes')->name('like.delete');
Route::get('/people', 'FollowController@publicacionFollow')->name('people');
Route::get('/followingU', 'FollowController@peopleWhoFollow')->name('peopleU');

Route::get('/video/{name}', 'PostController@getVideo')->name('getVideo');
Route::get('/follow/{id_user}','FollowController@beFollower')->name('follow.create');
Route::get('/unfollow/{id_user}','FollowController@dontBeFollower')->name('follow.delete');
