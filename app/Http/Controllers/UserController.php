<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
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
        
        $ttl = $request->remember ? config('jwt.ttl_remember') : config('jwt.ttl');
        if (!$token = auth()->setTTL($ttl)->attempt($request->validated())) {
            return redirect()->route('login')->withErrors('Login or password are incorrect.');
        }

        Cookie::queue('token', $token, $ttl);

        return redirect()->route('links');
    }

    public function register(RegisterUserRequest $request)
    {
        $this->user->query()->create($request->validated());

        return redirect()->route('login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function showLoginPage()
    {
        return view('pages.login');
    }

    public function showRegisterPage()
    {
        return view('pages.register');
    }
}
