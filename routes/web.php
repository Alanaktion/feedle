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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/favicon/{host}', 'ProxyController@favicon')->name('favicon');

Auth::routes();

Route::get('/feeds', 'HomeController@index')->name('feeds');
Route::get('/feedSearch', 'HomeController@feedSearch')->name('feedSearch');
Route::post('/feedAdd', 'HomeController@feedAdd')->name('feedAdd');
Route::post('/feedPostUpdate', 'HomeController@feedPostUpdate')->name('feedPostUpdate');
