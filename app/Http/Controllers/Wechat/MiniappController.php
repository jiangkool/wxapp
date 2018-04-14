<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Cache;
use EasyWeChat\Foundation\Application;
use App\Models\Customer;
use App\Models\Article;
use App\Models\Yygh;

class MiniappController extends Controller
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

      if (Customer::updateOrCreate(['open_id'=>$data->openid],['open_id'=>$data->openid,'access_token'=>$data->session_key])) {
          
          //Home sliders
          $sliders=Article::where('category_id',1)->where('status',1)->select('id','thumb')->get();

          //Hot products
          $products=Article::where('category_id','>',1)->where('category_id','<',9)->where('status',1)->where('attr',1)->select('id','title','thumb','new_price','old_price')->get();

          //Hot cases
          $cases=Article::where('category_id',10)->where('status',1)->where('attr',1)->select('id','title','thumb')->get();

          Cache::has('session_key') && Cache::forget('session_key');
          Cache::add('session_key', $data->session_key, 7000);

          return response()->json(['session_key'=>$data->session_key,'sliders'=>$sliders,'products'=>$products,'cases'=>$cases]);

      }


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

    /**
     * Document list.
     * 
     * @param  integer $cat_id 
     * @param  integer $page  
     * @param  str  $token 
     * @return json
     */
    public function dataList(Request $request)
    {

      $page=$request->page;
      $token=$request->token;
      $page_size=6;
      $page_num=($page-1)*6;

      if ($this->checkToken($token)) {

        if ($request->cat_id==0) {

          $category_id=[2,3,4,5,6,7,8];
          $list=Article::whereIn('category_id',$category_id)->where('status',1)->skip($page_num)->take($page_size)->select('id','title','thumb','new_price','old_price')->get();

        }elseif ($request->cat_id==999) {

            $category_id=[2,3,4,5,6,7,8];
            $list=Article::where('attr',1)->whereIn('category_id',$category_id)->where('status',1)->skip($page_num)->take($page_size)->select('id','title','thumb','new_price','old_price')->get();
          
        }elseif ($request->cat_id!=0 && $request->cat_id!=999) {

          $category_id=$request->cat_id;
          $list=Article::where('category_id',$category_id)->where('status',1)->skip($page_num)->take($page_size)->select('id','title','thumb','new_price','old_price','zj_sc','zj_zc','cz_time')->get();

        }
        
        return response()->json(['list'=>$list]);

      }else{

        return response()->json(['error'=>'Validation failed!']);
      }
    }

    /**
     * Search model.
     * 
     * @param  Request $request
     * @return Json
     */
    public function search(Request $request)
    {
       $keywords=$request->keywords;
       $token=$request->token;
       $page=$request->page;
       $page_size=6;
       $page_num=($page-1)*6;

       if ($this->checkToken($token)) {

         $list=Article::whereIn('category_id',[2,3,4,5,6,7,8])->where('status',1)->where('title','like','%'.$keywords.'%')->skip($page_num)->take($page_size)->select('id','title','thumb','new_price','old_price')->get();

         return response()->json(['list'=>$list]);

       }

    }

    /**
     * Check token.
     * 
     * @param  str $token 
     * @return bool
     */
    private function checkToken($token)
    {
        if (!empty($token) && $token==Cache::get('session_key', '')) {
          return true;
        }else{
          return false;
        }
    }

    /**
     * Get article info by id.
     * 
     * @param  Request $request 
     * @return Json
     */
    public function getXmInfo(Request $request)
    {
          $id=intval($request->id);
          $token=$request->token;

           if ($this->checkToken($token)) {

            $article=Article::where('id',$id)->select('id','title','thumb')->first();

             return response()->json(['data'=>$article]);
           }
    }

    /**
     * [yygh description].
     * 
     * @param  Request $request
     * @return Json
     */
    public function yygh(Request $request)
    {
      $token=$request->token;
      if ($this->checkToken($token)) {
            
          //get openid
          $customer=Customer::where('access_token',$token)->first();

          $data['open_id']=$customer->open_id;
          $data['name']=$request->name;
          $data['phone']=$request->phone;
          $data['xmid']=isset($request->hid)?$request->hid:'';
          $data['keshi']=isset($request->keshi)?$request->keshi:'';
          $data['dytime']=isset($request->dytime)?$request->dytime:'';
          $data['bark']=isset($request->bark)?$request->bark:'';

          if ($gh=Yygh::where('phone',$data['phone'])->where('xmid',$data['xmid'])->first()) {
              return response()->json(['status'=>'fail','msg'=>'请不要重复报名！']);
          }elseif(Yygh::create($data)){
             return response()->json(['status'=>'ok','msg'=>'报名成功！']);
          }else{
            return response()->json(['status'=>'fail','msg'=>'未知错误！']);
          }


      }

    }

    /**
     * Get article content by id.
     * 
     * @param  Request $request
     * @return Json
     */
    public function getContent(Request $request)
    {
          $id=intval($request->id);
          $token=$request->token;

           if ($this->checkToken($token)) {

            $article=Article::where('id',$id)->select('title','body','created_at','click')->first();

            $article->body=str_replace("/upload/", Config::get('app.url', '')."/upload/", $article->body);

            $article_model=Article::find($id);
            $article_model->click=$article_model->click+1;
            $article_model->save();

             return response()->json(['data'=>$article]);
           }
    }

}
