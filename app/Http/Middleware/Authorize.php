<?php

namespace App\Http\Middleware;

use App\UserModel as userModel;
use Closure;

class Authorize
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
            $user = userModel::where('name', $login)->first();
            if($user)
                if(strcmp($user->remember_token,$token) == 0)
                    return $next($request); 
        } 
        return redirect('/');
            
    }
}
