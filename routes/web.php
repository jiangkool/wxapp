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

	//Wechat Accounts routes
	Route::resource('account','AccountController');

	Route::get('account/{id}/active',['as'=>'account.active','uses'=>'AccountController@active']);
	Route::get('account/{id}/delete',['as'=>'account.delete','uses'=>'AccountController@destroy']);

	//wechat menu
	//Route::get('menu/{id}',['as'=>'menu.index','uses'=>'MenuController@index']);

	//Customer route register
	Route::get('customer',['as'=>'customer.index','uses'=>'CustomerController@index']);

	Route::resource('category','CategoryController');
	Route::get('category/{category}/delete',['as'=>'category.delete','uses'=>'CategoryController@destroy']);

	Route::resource('article','ArticleController');
	Route::get('article/{article}/delete',['as'=>'article.delete','uses'=>'ArticleController@destroy']);
	Route::get('article/{id}/active',['as'=>'article.active','uses'=>'ArticleController@active']);

	Route::get('yygh',['as'=>'yygh.index','uses'=>'YyghController@index']);
	Route::get('yygh/{id}/active',['as'=>'yygh.active','uses'=>'YyghController@active']);
	Route::get('yygh/{id}/delete',['as'=>'yygh.delete','uses'=>'YyghController@destroy']);

	//upload files
	Route::post('/upload/post','UploadController@uploadFiles')->name('uploadfile');

});


/*
|--------------------------------------------------------------------------
| Web Routes For Wechat
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your Wechat application. 
|
*/

Route::group(['prefix' => 'wechat','middleware'=>['web'],'namespace'=>'Wechat'], function() {
    
	Route::get('/miniapp/{code}','MiniappController@guest');

	Route::post('/miniapp','MiniappController@getUserInfo');

	Route::get('/category','MiniappController@dataList');

	Route::get('/search','MiniappController@search');

	Route::get('/getXm','MiniappController@getXmInfo');

	Route::get('/yygh','MiniappController@yygh');

	Route::get('/getContent','MiniappController@getContent');

	//Wechat callback url
	Route::any('callback/{id}','WechatController@callBack');

});

/*
|--------------------------------------------------------------------------
| Web Routes For Voice
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your Voice application. 
|
*/

Route::group(['namespace'=>'Wechat'], function() {

	Route::get('/ymform','VoiceController@index');

	Route::post('/ymform','VoiceController@YminfoStore')->name('storeYm');

	Route::get('/voice','VoiceController@showVoicePage')->name('showVoicePage');

	Route::post('/storeVoice','VoiceController@YminfoStore')->name('storeVoice');

});