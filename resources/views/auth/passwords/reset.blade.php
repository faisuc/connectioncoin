@extends('layouts.auth')

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('/images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <div class="text-center">
                <img src="{{ asset('images/logo.png') }}" class="img-responsive w-50">
            </div>
            <form class="login100-form validate-form" method="POST" action="{{ route('password.update') }}">
                @csrf
                <span class="login100-form-title p-b-49">
                    Reset Password
                </span>

                @sharedAlerts

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Email</span>
                    <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Type your email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Type your password" required autocomplete="current-password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Confirm Password</span>
                    <input class="input100" type="password" name="password_confirmation" placeholder="Confirm password" required autocomplete="current-password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="container-login100-form-btn p-t-31 p-b-31">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Sign Up
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
