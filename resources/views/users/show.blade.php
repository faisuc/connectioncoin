@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data" class="row">
    @csrf
    @method('PATCH')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @include('users.partials.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Profile</div>

                    <div class="card-body">
                        @sharedAlerts

                        <div class="form-group">
                            <label for="name">Name</label>
                            <h3>{{ $user->name }}</h3>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <h3>{{ $user->email }}</h3>
                        </div>
                        @can('update', $user)
                            <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary btn-lg">Edit Profile</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
