@extends('layouts.app')

@section('content')
<div class="container">
    @sharedAlerts
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-3">
                <img class="card-img-top" src="{{ $story->theImage }}" alt="Card image cap">
                <div class="card-body">
                    @include('shared.user-connection-lists')
                    <h3 class="card-title">{{ $story->title }}</h3>
                    <p class="card-text">{!! nl2br($story->description) !!}</p>
                    @can('update', $story)
                        <a href="{{ route('stories.edit', ['story' => $story]) }}" class="btn btn-secondary">Edit</a>
                    @endcan
                    @can('delete', $story)
                        <a href="#" class="btn btn-danger" onclick="event.preventDefault(); var r = confirm('Are you sure?');  if (r) { document.getElementById('delete-story-form-{{ $story->id }}').submit(); }">Delete</a>
                        <form id="delete-story-form-{{ $story->id }}" action="{{ route('stories.destroy', ['story' => $story]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>
                <div class="card-footer">
                    <small class="text-muted">Posted 3 days ago</small>
                    <small class="text-muted float-right">Posted by:
                        <a href="{{ route('users.show', ['user' => $story->user]) }}"><img src="{{ $story->user->thePhoto }}" title="{{ $story->user->name }}" class="img-thumbnail rounded-circle" style="width: 30px; height: 30px;"></a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
