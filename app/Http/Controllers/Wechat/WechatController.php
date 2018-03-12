<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Cache;
use EasyWeChat\Foundation\Application;

class WechatController extends Controller
{
    private $app; 

    public function __construct(){

      $options = ['mini_program' => Config::get('wechat.mini_program')];

      $app = new Application($options);

      $this->app = $app->mini_program;

    }

    /**
     * Code to SessionKey & openid.
     * 
     * @param  str $code 
     * @return json $data
     */
    public function guest($code)
    {

      $data=$this->app->sns->getSessionKey($code);

      Cache::has('session_key') && Cache::forget('session_key');
      Cache::add('session_key', $data->session_key, 7000);
      return response()->json($data);

    }

    /**
     * Decrypt user info by encryptData.
     * 
     * @param  str $encryptData
     * @return json $data
     */
    public function getUserInfo(Request $request)
    {
        $encryptedData=$request->encryptedData;
        $iv=$request->iv;
        $session_key=Cache::get('session_key');

        $data=$this->app->encryptor->decryptData($session_key,$iv,$encryptedData);
        
        return response()->json($data);
    }


}
