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

Route::get('/','tstController@index');
Route::get('/search', ['as' =>'word.search', 'uses' => 'tstController@search']);
Route::get('/autoSearch', ['as' => 'ajax.search', 'uses' => 'tstController@ajaxSearch']);
Route::get('/searchExample', ['as' =>'word.searchExample', 'uses' => 'tstController@searchExample']);