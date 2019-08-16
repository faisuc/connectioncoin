@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @sharedAlerts
    <div class="row">
        @foreach ($stories as $story)
            <div class="col-sm-3 py-2">
                <a href="{{ route('stories.show', ['story' => $story->id]) }}" class="custom-card">
                    <div class="card h-100 shadow">
                        <img src="{{ $story->theResizedImage }}" class="card-img-top" alt="{{ $story->title }}">
                        <div class="card-body">
                            <ul class="list-inline">
                                @foreach ($story->getTheLastUsersWhoPostedUsingThisCoin(10)->reverse() as $user)
                                    <li class="list-inline-item py-2">
                                        <a href="{{ route('users.show', ['user' => $user]) }}">
                                            <img src="{{ $user->thePhoto }}" title="{{ $user->name }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle" style="width: 30px; height: 30px;">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <h5 class="card-title">{{ $story->title }}</h5>
                            <p class="card-text">{!! $story->theDescription !!}</p>
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
                            <small class="text-muted">{{ $story->theFormattedTimeAgo }}</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        {{ $stories->links() }}
    </div>
</div>
@endsection
