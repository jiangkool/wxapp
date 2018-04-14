<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Account;

class MenuController extends Controller
{
	private $menu;
	private $server;

	public function __construct(Request $request)
	{
		$account=Account::where('id',$id)->where('status',1)->first();

    	$options = [
		    'debug'  => true,
		    'app_id' => $account->app_id,
		    'secret' => $account->app_secret,
		    'token'  => $account->wechat_token,
		    'aes_key'=>	$account->encoding_aes_key
		];

		$app = new Application($options);
		$this->menu = $app->menu;
		$this->server = $app->server;
	}

	/**
	 * Wechat menus form.
	 * 
	 * @return view
	 */
    public function index()
    {
    	
		$menus=$this->menu->all();

		return view('admin.menus',compact('menus'));
    }

    /**
     * Updated wechat menus.
     * 
     * @param  Request $request
     * @return \EasyWeChat\Support\Collection
     */
    public function push(Request $request)
    {
    	$buttons=[
				    [
				        "type" => "click",
				        "name" => "今日歌曲",
				        "key"  => "V1001_TODAY_MUSIC"
				    ],
				    [
				        "name"       => "菜单",
				        "sub_button" => [
				            [
				                "type" => "view",
				                "name" => "搜索",
				                "url"  => "http://www.fzskyy.com/zt/smr/banner/640-300.jpg"
				            ],
				            [
				                "type" => "view",
				                "name" => "视频",
				                "url"  => "http://v.qq.com/"
				            ],
				            [
				                "type" => "click",
				                "name" => "赞一下我们",
				                "key" => "V1001_GOOD"
				            ],
				        ],
				    ],
				];

		$this->menu->add($buttons);

		return $this->server->serve();

    }


}
