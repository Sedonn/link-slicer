<?php

namespace App\Http\Middleware;

use App\UserModel as userModel;
use Closure;

class CheckAuthLoginPage
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
        if(isset($_COOKIE['token']) && isset($_COOKIE['login']))
        {
            $login = $_COOKIE['login'];
            $token = $_COOKIE['token'];
            $user = userModel::where('login', $login)->first();
            if($user)
                if(!strcmp($user->token,$token))
                    return redirect('/');
        }
        return $next($request);
    }
}
