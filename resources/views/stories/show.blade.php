@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        <a href="{{ route('users.show', ['user' => $story->user]) }}"><img src="{{ $story->user->thePhoto }}" title="{{ $story->user->getFullName() }}" class="img-thumbnail rounded-circle" style="width: 30px; height: 30px;"></a></small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Comments</h3>
            @sharedAlerts
            <div class="comments-container">
                @foreach ($comments as $comment)
                    <div class="card border-primary mb-3">
                        <div class="card-body text-primary">
                            <p class="card-text">{!! $comment->text !!}</p>
                            <small>{{ $comment->user->getFullName() }} - {{ $comment->theCreatedAt }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea class="form-control form-control-lg" required name="text" id="text" placeholder="Comment..."></textarea>
                </div>
                <input type="hidden" name="story_id" value="{{ $story->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
