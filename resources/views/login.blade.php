@extends('layouts.layouts')
@section('title', 'Profile')
@section('content')

    @if(Session::has('error'))
        @php
            $errorLogin = Session::get('error');
        @endphp
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $errorLogin }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
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
                    <div class="login-form">
                        <h2>Login</h2>
                        <form id="form-login" action="/login" method="post" id="login-form">
                            @csrf    
                            <div class="group-input">
                                <label for="username">Username or email address *</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>                                            
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" id="save-pass">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="/forgetPassword" class="forget-pass">Forget your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="/register" class="or-login">Or Create An Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection