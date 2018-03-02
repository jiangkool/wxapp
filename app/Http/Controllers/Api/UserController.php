<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created user.
     *
     * @param str  $email
     * @param str $password 
     * @param str $comfiredPassword
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        if (User::create(['name'=>$request->name,'email'=>$request->email,'password'=>bcrypt($request->password),'active'=>1,'isadmin'=>0])) {
            return 'Register ok!!';
        }
        return response()->withErrors('Register Fail!');
    }


    public function login(Request $request)
    {
        $userData=$request->only(['email','password']);
        $rules=[
            'email'=>'required|email',
            'password'=>'required'
        ];

        $validator=Validator::make($userData,$rules);

        if($validator->fails()){
            throw new ValidationHttpException($validator->errors()->all());
        }

         if (!$user=Auth::attempt(['email'=>$request->email,'password'=>$request->password,'active'=>1])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
