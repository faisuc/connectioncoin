@extends('layouts.app')

@section('content')
<form method="POST" action="" enctype="multipart/form-data" class="row">
    @csrf
    @method('PATCH')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @include('users.partials.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Stories</div>

                    <div class="card-body">
                        @sharedAlerts

                        <div class="row">
                            @foreach ($stories as $story)
                                <div class="col-md-4 mb-2">
                                    <div class="card border-secondary">
                                        <div class="card-header text-center">{{ $story->title }}</div>
                                        <div class="card-body text-secondary">
                                            <h5 class="card-title text-center">{!! $story->theDescription !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
