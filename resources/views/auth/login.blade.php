@extends('layouts.auth')

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-color: #0085ad !important;">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <div class="text-center">
                <img src="{{ asset('images/app_icon.png') }}" class="img-responsive w-50">
            </div>
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                <span class="login100-form-title p-b-49">
                    Login
                </span>

                @sharedAlerts
                <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                    <span class="label-input100">Email</span>
                    <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Type your email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Type your password" required autocomplete="current-password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-right p-t-8 p-b-31">
                        <a href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    </div>
                @endif

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </div>

                <div class="flex-col-c">

                    <a href="{{ route('register') }}" class="txt2 p-t-17">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
