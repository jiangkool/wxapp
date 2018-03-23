<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Account;

class AccountController extends Controller
{   

    /**
     * Defined middleware auth. 
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts=Account::paginate(10);
        $app_url=\Config::get('app.url', '');
        return view('admin.accounts',compact('accounts','app_url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_account');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'account_type' => 'required',
            'wechat_name'=>'required',
            'app_id' => 'required|unique:accounts',
            'app_secret' => 'required'
        ];
        $messages=[
             'account_type.required'=>'帐号类型 为必填项！',
             'wechat_name.required'=>'公众号名称 为必填项！',
             'app_id.required' => 'APP ID 为必填项！',
             'app_id.unique' => '此 APP ID 已存在！',
             'app_secret.required' => 'APP SECRET 为必填项！'
        ];
        $validator=Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();

        }else{

            //Create wechat token
            $token=md5($request->app_id.time());
            $data=array_merge($request->all(),['wechat_token'=>$token]);

            if (Account::create($data)) {
                
                return redirect()->back()->with('message','添加成功！');

            }else{

                return redirect()->back()->withErrors('添加失败！');
            }
            
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account=Account::where('id',$id)->first();

        return view('admin.account_edit',compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'account_type' => 'required',
            'wechat_name'=>'required',
            'app_id' => 'required',
            'app_secret' => 'required'
        ];
        $messages=[
             'account_type.required'=>'帐号类型 为必填项！',
             'wechat_name.required'=>'公众号名称 为必填项！',
             'app_id.required' => 'APP ID 为必填项！',
             'app_secret.required' => 'APP SECRET 为必填项！'
        ];
        $validator=Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator);

        }else if($account=Account::where('id',$id)->first()){

            $account->account_type!=$request->account_type && $account->account_type=$request->account_type;
            $account->wechat_name!=$request->wechat_name && $account->wechat_name=$request->wechat_name;
            $account->app_id!=$request->app_id && $account->app_id=$request->app_id;
            $account->app_secret!=$request->app_secret && $account->app_secret=$request->app_secret;

            if ($account->save()) {

                return redirect()->back()->with('message','修改成功！');

            }else{

                return redirect()->back()->withErrors('保存失败！');
            }

        }else{
            return redirect()->back()->withErrors('保存失败！');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Account::where('id',$id)->first()) {

            Account::destroy($id);

            return redirect()->back()->with('message','删除成功！');
        }else{

            abort('404');
        }
    }


    /**
     * Change account status.
     * 
     * @param  int $id
     * @return bool
     */
    public function active(Request $request,$id)
    {
        if ($account=Account::where('id',$id)->first()) {
            
            $account->status=$request->active;
            if($account->save()){

                 return redirect()->back()->with('message','更新成功！');
            }

        }else{

            abort('404');
        }


    }
}
