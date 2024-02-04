@extends('layouts.base.master')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form class="user" method="POST" action="{{ route('user.login.action') }}">
                    @csrf
                    <div class="form-group">
                        <input required type="login" name="login" class="form-control form-control-user"
                            aria-describedby="loginHelp" placeholder="Enter Login...">
                    </div>
                    <div class="form-group">
                        <input required type="password" name="password" class="form-control form-control-user"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" id="remember" name="remember" class="custom-control-input">
                            <label class="custom-control-label" for="remember">Remember Me</label>
                        </div>
                        <span class="register"><a href="{{ route('user.register.view') }}">Register</a></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
