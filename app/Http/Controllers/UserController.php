<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);
        $credentials = $request->only('login', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return \redirect()->route('login');
        }

        Cookie::queue('token', $token, 60);

        return \redirect()->route('links');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        (new User([
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]))->save();

        return \redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return \redirect()->route('login');
    }

    public function showLoginPage()
    {
        return \view('pages.login');
    }

    public function showRegisterPage()
    {
        return \view('pages.register');
    }
}
