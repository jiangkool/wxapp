<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

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
                 throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('Unauthorized');
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
                 throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException('JWT refreshed failed');
            }
        }
        catch (JWTException $e)
        {
            throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('Unauthorized');
        }

        // Log a user into the application.
        Auth::login($user, false);

        return  $next($request);
    }

}
