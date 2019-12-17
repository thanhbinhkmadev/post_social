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
Route::get('/test_yt','Test\TestController@login');
Route::get('test_kma','Test\TestController@kma');

Route::get('giai_thuat','Test\TestController@giaithuat');

Route::get('test_api','Test\TestController@test_api');

Route::get('admin-dashboard','Admin\DashboardController@index')->name('index.dashboard');