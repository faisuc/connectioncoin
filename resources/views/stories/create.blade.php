@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Story</div>

                <div class="card-body">
                    @sharedAlerts

                    <form method="POST" action="{{ route('stories.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="Enter title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="10" class="form-control form-control-lg" name="description" id="description" placeholder="Enter description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control form-control-lg" name="image[]" multiple accept="image/x-png,image/gif,image/jpeg" />
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control form-control-lg" name="city" id="city" placeholder="Enter city" value="{{ old('city') }}">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control form-control-lg" name="state" id="state" placeholder="Enter state" value="{{ old('state') }}">
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control form-control-lg" name="province" id="province" placeholder="Enter province" value="{{ old('province') }}">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control form-control-lg" name="country" id="country" placeholder="Enter country" value="{{ old('country') }}">
                        </div>
                        @guest
                            <div class="form-group nickname-container">
                                <label for="nickname">Nickname</label>
                                <input type="text" class="form-control form-control-lg" name="nickname" id="nickname" placeholder="Enter nickname" value="{{ old('nickname') }}">
                            </div>
                            <div class="form-group">
                                <label for="create_account">Create Account</label>
                                <input type="checkbox" name="create_account" id="create_account" {{ old('create_account') ? 'checked' : '' }}>
                            </div>
                            <div class="form-group create-account-container {{ old('create_account') ? '' : 'd-none' }}">
                                <div class="card">
                                    <div class="card-header">{{ __('Register') }}</div>

                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endguest
                        <input type="hidden" name="number" value="{{ Request::input('number') }}" />
                        <input type="hidden" name="phrase" value="{{ Request::input('phrase') }}" />
                        <button type="submit" class="btn btn-primary btn-lg">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
