@extends('layouts.layouts')
@section('title', 'Profile')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Register</h2>
                        <form id="form-login" action="/register" method="post" id="login-form">
                            @csrf    
                            <div class="group-input">
                                <label for="username">Username *</label>
                                <input class="form-control" value="{{ old('name') }}" type="text" id="name" name="name">
                            </div>
                            <div class="group-input">
                                <label for="username">Email address *</label>
                                <input class="form-control" value="{{ old('email') }}" type="email" id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input class="form-control" value="{{ old('password') }}" type="password" id="password" name="password">
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Confirm Password *</label>
                                <input class="form-control" value="{{ old('password_confirm') }}" type="password" id="password_confirm" name="password_confirm">
                            </div>
                            <button type="submit" class="site-btn register-btn">REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="/login" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection