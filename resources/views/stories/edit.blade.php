@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Story</div>

                <div class="card-body">
                    @sharedAlerts

                    <form method="POST" action="{{ route('stories.update', ['story' => $story]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="Enter title" value="{{ $story->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="10" class="form-control form-control-lg" name="description" id="description" placeholder="Enter description">{{ $story->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control form-control-lg" name="image" accept="image/x-png,image/gif,image/jpeg" />
                            <small id="imageHelp" class="form-text text-muted">Leave this blank if you don't want to update the image.</small>
                            <img src="{{ $story->theImage }}" class="img-fluid" alt="Responsive image">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control form-control-lg" name="city" id="city" placeholder="Enter city" value="{{ $story->city }}">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control form-control-lg" name="state" id="state" placeholder="Enter state" value="{{ $story->state }}">
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control form-control-lg" name="province" id="province" placeholder="Enter province" value="{{ $story->province }}">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control form-control-lg" name="country" id="country" placeholder="Enter country" value="{{ $story->country }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                        <button type="submit" class="btn btn-danger btn-lg" onclick="event.preventDefault(); var r = confirm('Are you sure?');  if (r) { document.getElementById('delete-story-form-{{ $story->id }}').submit(); }">Delete</button>
                    </form>
                    <form id="delete-story-form-{{ $story->id }}" action="{{ route('stories.destroy', ['story' => $story]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
