@extends('layouts.app')

@section('content')
    @csrf
    @method('PATCH')
    <div class="container-fluid py-4 container-profile100">
        <div class="row justify-content-center">
            <div class="col-md-5">
                @include('users.partials.sidebar')
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
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
@endsection
