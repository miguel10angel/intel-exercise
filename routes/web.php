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

Route::post('/users/create', 'Api\UserController@create');
Route::post('/users/upload', 'Api\UserController@upload');
Route::get('/users/getUsers', 'Api\UserController@getUsers');
Route::get('/users/{user}/getUser', 'Api\UserController@getUser');
Route::put('/users/{user}/update', 'Api\UserController@update');
Route::delete('/users/{user}/delete', 'Api\UserController@delete');

route::get('/import', 'Api\ImportController@index');
route::post('/upload_excel', 'Api\ImportController@uploadExcel');