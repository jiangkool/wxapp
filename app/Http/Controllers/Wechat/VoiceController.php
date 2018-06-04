<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Validator;
use App\Models\Yminfo;
use App\Models\Voice;

class VoiceController extends Controller{

	private $app;

	private $temporary;

	public function __construct()
	{
		is_weixin();
		$options = [
		    'debug'  => false,
		    'app_id' => \Config::get('app.wechat_appid'),
		    'secret' => \Config::get('app.wechat_appsecret')
		];

		
		$this->app = new Application($options);

	}

	/**
	 * Display Yminfo Form.
	 * 
	 * @return view
	 */
	public function index()
	{
		return view('yminfo');
		
	}

	/**
	 * Store Yminfo.
	 * 
	 * @param Request $request ['name','phone','yz']
	 * @return Redirect to Voice view.
 	 */
	public function YminfoStore(Request $request)
	{
		$rules=[
			'name'=>'required',
			'phone'=>'required'
		];	

		$messages=[
			'name.required'=>'姓名不能为空！',
			'phone.required'=>'手机号码不能为空！'
		];

		$validator=Validator::make($request->all(),$rules,$messages);

		if ($validator->fails()) {

           return redirect()->back()->withErrors($validator)->withInput();

        }else{

        	 if (Yminfo::updateOrCreate(['phone'=>$request->phone],$request->all())) {
                
                $yminfo=Yminfo::where('phone',$request->phone)->first();

                session(['is_submited'=>1,'uid'=>$yminfo->id]);

                return redirect()->route('showVoicePage');

            }else{

                return redirect()->back()->withErrors('您的信息提交失败！请稍候再试！');
            }
        }

	}

	/**
	 * Show Voice Page.
	 * 
	 * @return view
	 */
	public function showVoicePage()
	{	
		if (session('is_submited')===1 && session('uid') ) {

			$uid=session('uid');
			$js = $this->app->js;
			return view('voice',compact('js','uid'));

		}else{
			return redirect()->route('ymform');
		}
		
	}

	/**
	 * Store Voice.
	 * 
	 * @param Request $request [mediaId]
	 */
	public function storeYmVoice(Request $request)
	{
		$mediaId=$request->serverId;
		$uid=$request->id;

		$path = $this->download_media($mediaId,$uid);

		if(Voice::updateOrCreate(['yminfo_id'=>$uid],['yminfo_id'=>$uid,'server_id'=>$mediaId,'local_path'=>$path])){

			return response()->json(['result'=>1]);
		}else{
			return response()->json(['message'=>'上传失败！']);
		}
	}


    /**
     * 下载微信素材资源到本地
     * @param  url $url  素材地址
     * @return json       
     */
    public function download_media($media_id,$uid)
    {
        if ($media_id) {

        	$accessToken = $this->app->access_token;
			//$token = $accessToken->getToken();

            // 获取access_token
            $access_tokens = $accessToken->getToken(true);
            
            // 下载素材接口
            $down_media_url   = 'https://api.weixin.qq.com/cgi-bin/media/get';

            $get_media_url = $down_media_url . '?access_token=' . $access_tokens . '&media_id=' . $media_id;

            // 获取文件流
            $file_flow = file_get_contents($get_media_url);

            // 本地保存目录
            $save_path = "voices";

            if( !is_dir($save_path) ) {
                mkdir(iconv('UTF-8', 'GBK', $save_path), 0777, TRUE);
            }

            // 生成文件名
            $filename = $uid.'.amr';

            // 写入文件流到本地
            $flag     = file_put_contents($save_path . '/' . $filename, $file_flow);

            unset($file_flow);
            if($flag !== FALSE) {

                return $save_path . '/' . $uid.'.mp3';
            }else {
                return FALSE;
            }
        }
    }

}