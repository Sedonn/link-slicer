<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;

/**
 * Controller for operations with the User model.
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
            return redirect()->route('user.login.view')->withErrors('Login or password are incorrect.');
        }

        // Write token to cookie files for further authentication
        Cookie::queue('token', $token, $ttl);

        return redirect()->route('links.view');
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

        return redirect()->route('user.login.view');
    }

    /**
     * Logout the user.
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('user.login.view');
    }
}
