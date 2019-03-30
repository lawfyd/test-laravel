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
Route::get('/', 'CategoryController@index')->name('categories.index');

Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories/', 'CategoryController@store')->name('categories.store');
Route::get('/categories/{id}', 'CategoryController@show')->name('categories.show');
Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
Route::put('/categories/update/{id}', 'CategoryController@update')->name('categories.update');
Route::put('/categories/destroy/{id}', 'CategoryController@update')->name('categories.destroy');

Route::resource('posts', 'PostController');

Route::get('/comments/{type}/{id}', 'CommentController@comments');
Route::post('comments/{type}/{id}', 'CommentController@postComment');

/* browser statistic */
Route::get('/browsers/', function () {
    return \App\Session\SessionData::getData();
});
