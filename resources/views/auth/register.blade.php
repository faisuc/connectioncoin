@extends('layouts.auth')

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf
                <span class="login100-form-title p-b-49">
                    Register
                </span>

                @sharedAlerts

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Name</span>
                    <input class="input100 @error('name') is-invalid @enderror" type="text" name="name" placeholder="Type your name" value="{{ old('name') }}" required autocomplete="false" autofocus>
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
