@extends('layouts.site.master')

@section('title', 'Regiter')

@section('content')
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form class="user" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input required type="login" name="login" class="form-control form-control-user"
                            aria-describedby="loginHelp" placeholder="Enter Login">
                    </div>
                    <div class="form-group">
                        <input required type="email" name="email" class="form-control form-control-user"
                            aria-describedby="EmailHelp" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <input required type="password" name="password" class="form-control form-control-user"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input required type="password" name="password_confirmation" class="form-control form-control-user"
                            aria-describedby="loginHelp" placeholder="Confirm password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
