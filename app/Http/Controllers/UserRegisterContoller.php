<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel as userModel;

class UserRegisterContoller extends Controller
{
    public function register(Request $request)
    {
        if ($request->method() == 'POST')
        {
            $userLogin = userModel::where('name', $request->input('inputLogin'))->first();
            $userEmail = userModel::where('email', $request->input('inputEmail'))->first();
            if (!$userLogin && !$userEmail)
                if ($request->input('inputPassword') == $request->input('confirmPassword'))
                {
                    userModel::insert([
                        'name' => $request->input('inputLogin'),
                        'email' => $request->input('inputEmail'),
                        'password' => $request->input('inputPassword')
                    ]);
                    return redirect('/');
                }
                else
                    return back();
            else 
                return back();
        }
        else
            return view('register');
    }
}
