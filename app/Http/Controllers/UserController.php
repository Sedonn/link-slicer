<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;

class UserController extends Controller
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(LoginUserRequest $request)
    {
        if (!$token = \auth()->attempt($request->validated())) {
            return \redirect()->route('login');
        }

        Cookie::queue('token', $token, 60);

        return \redirect()->route('links');
    }

    public function register(RegisterUserRequest $request)
    {
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
