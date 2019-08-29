@extends('layouts.auth')

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('../images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <div class="text-center">
                <img src="{{ asset('images/logo.png') }}" class="img-responsive w-50">
            </div>
            <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <span class="login100-form-title p-b-49">
                    Reset Password
                </span>

                @sharedAlerts

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">E-Mail Address</span>
                    <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Type your email" value="{{ old('email') }}" required autocomplete="email">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Send Password Reset Link
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
