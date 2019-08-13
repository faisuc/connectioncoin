@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @sharedAlerts
    <div class="card-columns">
        @foreach ($stories as $story)
            <a href="{{ route('stories.show', ['story' => $story->id]) }}" class="custom-card">
                <div class="card shadow">
                    <img src="{{ $story->theImage }}" class="card-img-top" alt="...">
                    <div class="card-body">
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
        @endforeach
    </div>
    <div class="row justify-content-center">
        {{ $stories->links() }}
    </div>
</div>
@endsection
