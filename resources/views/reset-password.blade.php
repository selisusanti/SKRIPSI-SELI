@extends('layouts.layouts')
@section('title', 'Reset Password')
@section('content')

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ implode('', $errors->all(':message')) }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if(Session::has('success'))
        @php
            $success = Session::get('success');
        @endphp
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $success }}</strong>
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
                        <span>Reset Password</span>
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
                        <h2>Reset Password</h2>
                        <form id="form-login" action="/reset-password" method="post" id="login-form">
                            @csrf    
                            <input type="hidden" value="{{ $data->id }}" id="id_token" name="id_token">
                            <input type="hidden" value="{{ $data->id_user }}" id="id_user" name="id_user">
                            <div class="group-input">
                                <label for="username">Password</label>
                                <input class="form-control" value="{{ old('password') }}" type="password" id="password" name="password">
                            </div>
                            <div class="group-input">
                                <label for="username">Confirm Password</label>
                                <input class="form-control" value="{{ old('confirm_password') }}" type="password" id="confirm_password" name="confirm_password">
                            </div>
                            <button type="submit" class="site-btn register-btn">RESET PASSWORD</button>
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