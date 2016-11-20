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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/api/task','TaskController@index');
Route::post('/api/task','TaskController@add');
Route::patch('/api/task/{id}','TaskController@update');
Route::delete('/api/task/{id}','TaskController@destroy');
Route::patch('/api/task-all/{status}','TaskController@updateAll');
Route::delete('/api/task-all/{status}','TaskController@destroyAll');
