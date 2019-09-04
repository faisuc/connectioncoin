@extends('layouts.app')

@section('content')
    @csrf
    @method('PATCH')
    <div class="container-fluid py-4 container-profile100">
        <div class="row justify-content-center">
            <div class="col-md-5 col-sm-5 col-lg-5">
                @include('users.partials.sidebar')
            </div>
        </div>
        <!--
        <div class="row justify-content-center mt-5">
            <div class="col-md-5 col-sm-5 col-lg-5">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        @sharedAlerts

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <h3>{{ $user->first_name }}</h3>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <h3>{{ $user->last_name }}</h3>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <h3>{{ $user->email }}</h3>
                        </div>
                        @can('update', $user)
                            <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary btn-lg">Edit Profile</a>
                        @endcan
                        @auth
                            @can('message-user', $user)
                                <a href="{{ route('messages.index', ['user' => $user]) }}" class="btn btn-secondary btn-lg"><i class="fas fa-paper-plane"></i> Message</a>
                            @endcan
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    -->
    </div>
@endsection
