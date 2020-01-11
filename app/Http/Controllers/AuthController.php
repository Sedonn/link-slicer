<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authUser()
    {
        return view('login');
    }
    public function exitUser()
    {
        
    }
}
