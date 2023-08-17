@extends('layouts.app')
@section('css')
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('import/login/assets/css/login.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="{{ asset('image/login.jpg') }}" alt="login" class="login-card-img">
                </div>

                <div class="col-md-7">
                    <div class="card-body">
                        <div class="brand-wrapper">
                            <img src="{{ asset('image/logo.png') }}" alt="logo" class="logo"
                                style="width:200px; height:auto; position:absolute; top: -20px; left:50px">
                        </div>
                        <p class="login-card-description">Sign into your account</p>
                        <form action="{{ route('login') }}"" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="sr-only ">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email address" value="{{old('email')}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control  @error('password') is-invalid @enderror" placeholder="***********">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button name="login" id="login" class="btn btn-block login-btn mb-4" type="submit"
                                value="Login">Login</button>
                        </form>
                        <a href="#!" class="forgot-password-link">Forgot password?</a>
                        <p class="login-card-footer-text">Don't have an account? <a href="#!"
                                class="text-reset">Register here</a></p>
                        <nav class="login-card-footer-nav">
                            <a href="#!">Terms of use.</a>
                            <a href="#!">Privacy policy</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card login-card">
              <img src="assets/images/login.jpg" alt="login" class="login-card-img">
              <div class="card-body">
                <h2 class="login-card-title">Login</h2>
                <p class="login-card-description">Sign in to your account to continue.</p>
                <form action="#!">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-prompt-wrapper">
                    <div class="custom-control custom-checkbox login-card-check-box">
                      <input type="checkbox" class="custom-control-input" id="customCheck1">
                      <label class="custom-control-label" for="customCheck1">Remember me</label>
                    </div>
                    <a href="#!" class="text-reset">Forgot password?</a>
                  </div>
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="button" value="Login">
                </form>
                <p class="login-card-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p>
              </div>
            </div> -->
    </div>
@endsection
