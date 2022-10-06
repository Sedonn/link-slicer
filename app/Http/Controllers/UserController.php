<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class UserController extends Controller
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);
        $credentials = $request->only('login', 'password');

        if (!$token = \auth()->attempt($credentials)) {
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

        $this->user->query()->create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return \redirect()->route('login');
    }

    public function logout()
    {
        \auth()->logout();
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
