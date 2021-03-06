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
Route::patch('/categories/update/{id}', 'CategoryController@update')->name('categories.update');
Route::delete('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');

Route::resource('posts', 'PostController');

Route::get('/comments/{type}/{id}', 'CommentController@show');
Route::post('comments/{type}/{id}', 'CommentController@save');

/* browser statistic */
Route::get('/browsers/', function () {
    return \App\Session\SessionData::getData();
});
