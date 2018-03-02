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

// Admin module
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

	//Geetest route register
	Route::get('geetest','HomeController@getGeetest');

	//Admin login view
	Route::get('login',['as'=>'login','uses'=>'HomeController@index']);

	//Admin login post
	Route::post('login',['as'=>'checklogin','uses'=>'HomeController@login']);

	//Admin login out
	Route::post('logout',['as'=>'logout','uses'=>'HomeController@loginOut']);

	//System form
	Route::get('setting',['as'=>'system','uses'=>'SystemController@index']);

	//System update
	Route::post('setting/update',['as'=>'system_update','uses'=>'SystemController@update']);

	//System clear cache
	Route::get('setting/clear-cache',['as'=>'system.clear-cache','uses'=>'SystemController@clearCache']);

	//User resource
	Route::resource('users','UserController');
	Route::get('users/{user}/delete',['as'=>'user.delete','uses'=>'UserController@destroy']);
	Route::get('users/{user}/active',['as'=>'users.active','uses'=>'UserController@active']);
	Route::post('user/add',['as'=>'user.add','uses'=>'UserController@add']);
	Route::get('users-list',['as'=>'users.list','uses'=>'UserController@lists']);
	Route::delete('user/{id}',['as'=>'user.del','uses'=>'UserController@delete']);

	//user action logs
	Route::get('system/log',['as'=>'user.log','uses'=>'UserController@log']);
	Route::get('system/clear-log',['as'=>'user.logdel','uses'=>'UserController@logdel']);

	//roles
	Route::resource('roles','RoleController');
	Route::get('roles/{role}/delete',['as'=>'roles.delete','uses'=>'RoleController@destroy']);

	//permissions
	Route::resource('permission','PermissionController');
	Route::get('permission/{permission}/delete',['as'=>'permission.delete','uses'=>'PermissionController@destroy']);


});