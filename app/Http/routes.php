<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//商城
Route::get('/','GoodsController@index');
Route::get('insert','GoodsController@insert');
Route::get('goods/{gid}','GoodsController@goods');
Route::any('buy/{gid}','GoodsController@buy');
Route::any('cart','GoodsController@cart');
Route::any('cart_clear','GoodsController@cart_clear');
Route::any('update/{gid}/{quantity}','GoodsController@update');
Route::any('remove/{gid}','GoodsController@remove');


Route::any('/wx','WxController@index');
Route::any('demo','DemoController@index');
//微信授权登录路由
Route::any('center','UserController@center');
Route::any('login','UserController@login');
Route::any('logout','UserController@logout');


