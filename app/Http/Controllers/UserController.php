<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;

/**
 * Contoller for operations with the User model.
 */
class UserController extends Controller
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Login the user.
     *
     * @param LoginUserRequest $request
     * @return void
     */
    public function login(LoginUserRequest $request)
    {
        $ttl = $request->remember ? config('jwt.ttl_remember') : config('jwt.ttl');
        if (!$token = auth()->setTTL($ttl)->attempt($request->validated())) {
            return redirect()->route('login')->withErrors('Login or password are incorrect.');
        }

        // Write token to cookie files for further authentication
        Cookie::queue('token', $token, $ttl);

        return redirect()->route('links');
    }

    /**
     * Register the user.
     *
     * @param RegisterUserRequest $request
     * @return void
     */
    public function register(RegisterUserRequest $request)
    {
        $this->user->query()->create($request->validated());

        return redirect()->route('login');
    }

    /**
     * Logout the user.
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    /**
     * Render the login page.
     *
     * @return void
     */
    public function showLoginPage()
    {
        // if ($this->user) {
        //     return redirect()->route('links');
        // }
        
        return view('pages.login');
    }

    /**
     * Render the register page.
     *
     * @return void
     */
    public function showRegisterPage()
    {
        return view('pages.register');
    }
}
