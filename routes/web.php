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

Route::get('/tasks', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');
Route::resource('api/tasks', 'TasksController');
Route::get('api/user', 'HomeController@authenticated');
Route::get('api/user/tasks/{user_id}', 'TasksController@authenticatedTask');
