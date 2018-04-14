<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
use EasyWeChat\Message\Image;
use EasyWeChat\Message\Video;
use EasyWeChat\Message\Voice;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Article;
use App\Models\Account;

class WechatController extends Controller
{
	private $app,$account;
   	
   	/**
   	 * Init app & account class.
   	 * 
   	 * @param string $token
   	 * @param int $id 
   	 */
   	public function __construct(Request $request)
   	{
   	  $token=$request->token;
      $id=intval($request->id);
      $account=Account::where('id',$id)->where('wechat_token',$token)->where('status',1)->first();
      $options = [
		    'debug'  => true,
		    'app_id' => $account->app_id,
		    'secret' => $account->app_secret,
		    'token'  => $account->wechat_token,
		    'aes_key'=>	$account->encoding_aes_key
		];

		$this->app = new Application($options);
		$this->account = $account;

   	}


  /**
   * Wechat callback function.
   * 
   * @param  Request $request
   * @param  int  $id
   * @return \EasyWeChat\Support\Collection
   */
   public function callBack(Request $request)
    {

		$server = $this->app->server;
		$server->setMessageHandler(function ($message) {
		    switch ($message->MsgType) {
		        case 'event':
		            return $this->eventHandler($message);
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

    /**
     * Event Handler.
     * 
     * @param  obj $message Event [e.g.：subscribe,unsubscribe,CLICK ]
     * @param  int $id app_id
     * @return \EasyWeChat\Support\Collection
     */
    private function eventHandler($message)
    {

    	switch ($message->event) {
    			case 'subscribe':
    				return 'Subscribe success!!';
    				break;
    			case 'unsubscribe':
    				return 'Unsubscribe success!!';
    				break;
    			default:
    				// code...
    				break;
    		}	
    }

    


}
