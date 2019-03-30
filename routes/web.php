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
    return view('main');
})->name('main');


//Route::get('/categories', 'CategoriesController@index');


Route::resource('categories', 'CategoryController');

Route::resource('posts', 'PostController');

Route::get('/comments/{type}/{id}', 'CommentController@comments');
Route::post('comments/{type}/{id}', 'CommentController@postComment');

Route::get('/browsers/', 'SessionController@accessSessionData');

Route::get('/browsers/', function () {
    return \App\Session\SessionData::getData();
});
