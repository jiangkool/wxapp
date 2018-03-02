<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JtokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            if (! $user = JWTAuth::parseToken()->authenticate() )
            {
                 return response()->json([
                   'code'   => 101,
                   'response' => null
                 ]);
            }
        }
        catch (TokenExpiredException $e)
        {
            // If the token is expired, then it will be refreshed and added to the headers
            try
            {
                $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                $user = JWTAuth::setToken($refreshed)->toUser();
                header('Authorization: Bearer ' . $refreshed);
            }
            catch (JWTException $e)
            {
                 return response()->json([
                   'code'   => 103,
                   'response' => null 
                 ]);
            }
        }
        catch (JWTException $e)
        {
            return response()->json([
                   'code'   => 101,
                   'response' => null
            ]);
        }

        // Login the user instance for global usage
        Auth::login($user, false);

        return  $next($request);
    }

}
