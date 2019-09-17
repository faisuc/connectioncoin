@extends('layouts.auth')

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-color: #0085ad !important;">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <div class="text-center">
                <img src="{{ asset('images/app_icon.png') }}" class="img-responsive w-50">
            </div>
            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf
                <span class="login100-form-title p-b-49">
                    Register
                </span>

                @sharedAlerts

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">First Name</span>
                    <input class="input100 @error('first_name') is-invalid @enderror" type="text" name="first_name" placeholder="Type your first name" value="{{ old('first_name') }}" required autocomplete="false" autofocus>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Last Name</span>
                    <input class="input100 @error('last_name') is-invalid @enderror" type="text" name="last_name" placeholder="Type your last name" value="{{ old('last_name') }}" required autocomplete="false" autofocus>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Email</span>
                    <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Type your email" value="{{ old('email') }}" required autocomplete="email">
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

                <div class="flex-col-c">

                    <a href="{{ route('login') }}" class="txt2 p-t-17">
                        Already have an account?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
