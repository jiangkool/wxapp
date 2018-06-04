<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Log;
use App\Models\Customer;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin'])->except(['show']);
    }

    /**
     * Display a listing of the users.
     * 
     * @param  if this user is a admin $is_admin 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $is_admin=isset($request->is_admin) && is_numeric($request->is_admin)?$request->is_admin:0;
        //users list view
        $users=User::where('isadmin',$is_admin)->simplePaginate(10);
        
        return view('admin.users',compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $perms=Role::all();
        //show create user view
        return view('admin.create_user',compact('perms'));

    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=$this->validate($request,[
            'name'=>'required|unique:users|min:5',
            'email'=>'required|email|unique:users',
            'password'=>'required|Confirmed'
            ]);
   
        if($user = User::create(['name'=>$request->name,'email'=>$request->email,'password'=>bcrypt($request->password),'active'=>1,'roles' => $request->roles])){

            //add to belongToMany table
            if (isset($request->roles)) {
                $user->role()->attach($request->roles);
            }

            return Redirect::route('users.create')->with('message','新增用户成功！')->withInput();
        }else{
            return Redirect::route('users.create')->withErrors($validator);
        }
    }


    /**
     * Add a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        if (User::where('name',$request->name)->first()) {

            $data['status']='error';$data['msg']='添加失败！用户名称已存在！';
        }else{

        $validator=$this->validate($request,[
            'name'=>'required|unique:users|min:2',
            'roles'=>'required',
            'password'=>'required'
            ]);
            

         if($user = User::create(['name'=>$request->name,'email'=>$request->email,'password'=>bcrypt($request->password),'active'=>1,'roles' => $request->roles])){

            //add to belongToMany table
            if (isset($request->roles)) {
                $user->role()->attach($request->roles);
            }

           $data['status']='success';$data['msg']='添加成功！';
         }else{
            $data['status']='error';$data['msg']='添加失败！';
            }
        }

        return response()->json($data);
    }


    /**
     * Show user info edit view.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $user=User::find($id);
        $perms=Role::all();
        $roles=$user->role()->get()->pluck('pivot')->pluck('role_id')->toArray();
      // dd($roles);
        return view('admin.user_edit',compact('user','perms','roles'));
    }

    /**
     * Update user's info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        if (!empty($request->password)) {
                $this->validate($request,['password'=>'Confirmed']);
               $user->password=bcrypt($request->password);
        }
        if ($user->name!==$request->name) {
                 $this->validate($request,['name'=>'unique:users']);
                 $user->name=$request->name;
        }
        
        if ($user->email!==$request->email) {
                 $this->validate($request,['email'=>'email|unique:users']);
                 $user->email=$request->email;
        }
         $user->role()->detach();
         $user->role()->attach($request->roles);
         $user->save();
         return Redirect::back()->with('message','管理员修改成功！');
    
    }

    /**
     * Update user's status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request,$id)
    {
        $user=User::find($id);

        if ($request->active==-1 && $user->id==1) {
            return Redirect::back()->withErrors('此帐号无法被禁用！');
        }

        if($request->active==-1 && $user->active==-1){
            return Redirect::back()->withErrors('此会员已禁用！');

        }elseif($request->active!=$user->active){

            $user->active=$request->active;

            if($user->save()){
                return Redirect::back()->with('message','状态更新成功！');
            }else{
                return Redirect::back()->withErrors('状态更新失败！');
            }
        }
    
    }

    /**
     * Remove users.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if ($id==1) {
            return Redirect::back()->withErrors('此管理员无法删除！');
            }else{
            $user=User::find($id);
            
            //删除所有身份
            $user->role()->detach();
            //销毁
            User::destroy($id);
            return Redirect::back()->with('message','删除成功！');
            }
        
    }

    /**
     * System logs
     * 
     * @return \Illuminate\Http\Response
     */
    public function log()
    {

        $logs=Log::orderBy('created_at','desc')->paginate(10);
        
        return view('admin.logs',compact('logs'));
    }

    /**
     * System logs clear
     * 
     * @return \Illuminate\Http\Response
     */
    public function logdel()
    {
        if (DB::table('logs')->delete()) {
            
            return Redirect::back()->with('message','删除成功！');
        }
        
    }
 


}
