<?php

namespace App\Http\Middleware;

use App\UserModel as userModel;
use Closure;

class CheckAuthLoginPage
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Working
        if(isset($_COOKIE['token']) && isset($_COOKIE['login']))
        {
            $login = $_COOKIE['login'];
            $token = $_COOKIE['token'];
            $user = userModel::where('name', $login)->first();
            if($user)
                if(strcmp($user->remember_token,$token) == 0)
                    return redirect('/links');
                else
                    return redirect('/');
        }
        return $next($request);
    }
    
}
