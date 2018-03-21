<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Account;

class WechatController extends Controller
{
   

	/**
	 * Wechat callback function.
	 * 
	 * @param  Request $request
	 * @param  int  $id
	 * @return \EasyWeChat\Support\Collection
	 */
   public function callBack(Request $request,$id)
    {

      $token=$request->token;
      $id=intval($id);
      $account=Account::where('id',$id)->where('wechat_token',$token)->where('status',1)->first();
      $options = [
		    'debug'  => true,
		    'app_id' => $account->app_id,
		    'secret' => $account->app_secret,
		    'token'  => $account->wechat_token,
		    'aes_key'=>	$account->encoding_aes_key,
		    'log' => [
		        'level' => 'debug',
		        'file'  => '/tmp/wechat.log', 
		    ],
		];

		$app = new Application($options);
		$server = $app->server;
		$server->setMessageHandler(function ($message) {
		    switch ($message->MsgType) {
		        case 'event':
		            return '收到事件消息';
		            break;
		        case 'text':
		            return '收到文字消息';
		            break;
		        case 'image':
		            return '收到图片消息';
		            break;
		        case 'voice':
		            return '收到语音消息';
		            break;
		        case 'video':
		            return '收到视频消息';
		            break;
		        case 'location':
		            return '收到坐标消息';
		            break;
		        case 'link':
		            return '收到链接消息';
		            break;
		        // ... 其它消息
		        default:
		            return '收到其它消息';
		            break;
		    }

		    // ...
		});

		$response = $server->serve();


		return $response;
    }

    


}
