@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 container-profile100">
    @sharedAlerts
    @foreach ($stories as $story)
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-6 py-2 col-sm-12">
            <a href="{{ route('stories.show', ['story' => $story->id]) }}" class="custom-card">
                <div class="card h-100 shadow">
                    <img src="{{ $story->theImage }}" class="card-img-top" alt="{{ $story->title }}">
                    <div class="card-body">
                        @include('shared.user-connection-lists')
                        <h5 class="card-title">{{ $story->title }}</h5>
                        <p class="card-text">{!! $story->theDescription !!}</p>
                        {{-- <input type="hidden" value="amo" class="facemocion"/> --}}
                        @include('layouts._emotions', ['story' => $story])
                        <div>
                            @include('stories.partials.report', ['story' => $story])
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
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ $story->theFormattedTimeAgo }}</small>
                        <small class="text-muted float-right">Posted by:
                            <a href="{{ route('users.show', ['user' => $story->user]) }}">
                                <img src="{{ $story->user->thePhoto }}" title="{{ $story->user->getFullName() }}" alt="{{ $story->user->getFullName() }}" class="img-thumbnail rounded-circle" style="width: 30px; height: 30px;">
                            </a>
                        </small>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    <div class="row justify-content-center">
        {{ $stories->links() }}
    </div>
</div>
@endsection
