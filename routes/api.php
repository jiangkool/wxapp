<?php

//use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
	'namespace' => 'App\Http\Controllers\Api'
	],function ($api) {

		$api->post('register',['uses'=>'UserController@store','as'=>'api.user_register']);

		$api->post('login',['uses'=>'UserController@login','as'=>'api.user_login']);
});
