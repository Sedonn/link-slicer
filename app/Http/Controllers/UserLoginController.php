<?php

namespace App\Http\Controllers;

use App\linkModel as lnikModel;
use App\UserModel as userModel;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method() == 'POST')
        {
            $login = $request->input('inputLogin');
            $password = $request->input('inputPassword');
            $user = userModel::where([
                ['name', '=', $login],
                ['password', '=', $password]
            ])->first();
            $userToken = password_hash($password,PASSWORD_BCRYPT);
            setcookie('token', $userToken);
            userModel::where('name', $login)->update(['remember_token' => $userToken]);
            setcookie('login', $login);
            if ($user) return redirect('/links');
            else return back();
        }
        else
            return view('login');

    }
    public function logout(Request $request)
    {
        unset($_COOKIE['token']);
        setcookie('token', null, -1, '/');
        unset($_COOKIE['login']);
        setcookie('login', null, -1, '/');
        return redirect('/');
    }
}
