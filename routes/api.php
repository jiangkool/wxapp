<?php

//use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
	'namespace' => 'App\Http\Controllers\Api'
	],function ($api) {

		$api->post('register',['uses'=>'UserController@signUp','as'=>'api.user_register']);

		$api->post('login',['uses'=>'UserController@signIn','as'=>'api.user_login']);

		$api->get('user',['uses'=>'UserController@me','as'=>'api.user_info']);
});
