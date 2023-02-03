@extends('layouts.app')
@section('title','Login')

@section('login_content')
    <main class="bg-main">
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center py-4"> 
                                        <a href="#" class="logo d-flex align-items-center w-auto"> 
                                            <img src="assets/img/logo1.png" alt=""> 
                                            <span class="d-lg-block">FLSys</span> 
                                        </a>
                                    </div>
                                    <h5 class="card-title2 card-title text-center pb-0 fs-4">Welcome Back!</h5>
                                    <p class="text-center small">Enter your username & password to login.</p>
                                    <br>
                                    <!-- Login Form -->
                                    <!-- <form class="row g-3 needs-validation"> -->
                                    <form id="formAuthentication" class="row g-3 " action="{{ route('login') }}" method="POST" novalidate>
                                    @csrf
                                        <!-- Username Input -->
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email or Username</label>
                                            <input 
                                                type="text" 
                                                name="email" 
                                                class="form-control form-control-user @error('email') is-invalid @enderror" 
                                                id="email" 
                                                value="{{ old('email') }}" 
                                                autofocusaria-describedby="emailHelp"
                                                required autocomplete="email" 
                                                autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Password Input -->
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label> 
                                            <input 
                                                type="password" 
                                                name="password" 
                                                class="form-control form-control-user @error('password') is-invalid @enderror" 
                                                id="password" 
                                                required autocomplete="current-password"
                                                aria-describedby="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="col-12">
                                            <div class="form-check"> 
                                                <input 
                                                    class="form-check-input" 
                                                    type="checkbox" 
                                                    name="remember" 
                                                    id="rememberMe"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="rememberMe">{{ __('Remember Me') }}</label>
                                            </div>
                                        </div>

                                        <!-- Sign-in / Submit Button -->
                                        <div class="col-12"> 
                                            <button class="btn btn-primary w-100" type="submit">{{ __('Login') }}</button>
                                        </div>

                                        <!-- Forgot Password -->
                                        <div class="col-12">
                                            <p class="small mb-0">Forgot Password?
                                                <a href="#">Click here</a>
                                            </p>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
