@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data" class="row">
    @csrf
    @method('PATCH')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="card-img-top" src="{{ $user->thePhoto }}" alt="Card image cap">
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Profile</div>

                    <div class="card-body">
                        @sharedAlerts

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control form-control-lg" name="email" id="email" placeholder="Enter email" value="{{ $user->email }}">
                            <small id="passwordHelp" class="form-text text-muted">You need to verify your email address again if you updated your email.</small>
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Picture</label>
                            <input type="file" class="form-control form-control-lg" name="photo" accept="image/x-png,image/gif,image/jpeg" />
                            <small id="passwordHelp" class="form-text text-muted">Leave this blank if you don't want to update your profile picture.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter password">
                            <small id="passwordHelp" class="form-text text-muted">Leave this blank if you don't want to update your password.</small>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control form-control-lg" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
