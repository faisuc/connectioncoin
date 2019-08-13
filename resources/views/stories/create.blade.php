@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Story</div>

                <div class="card-body">
                    @sharedAlerts

                    <form method="POST" action="{{ route('stories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="Enter title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="10" class="form-control form-control-lg" name="description" id="description" placeholder="Enter description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control form-control-lg" name="image" accept="image/x-png,image/gif,image/jpeg" />
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control form-control-lg" name="city" id="city" placeholder="Enter city" value="{{ old('city') }}">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control form-control-lg" name="state" id="state" placeholder="Enter state" value="{{ old('state') }}">
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control form-control-lg" name="province" id="province" placeholder="Enter province" value="{{ old('province') }}">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control form-control-lg" name="country" id="country" placeholder="Enter country" value="{{ old('country') }}">
                        </div>
                        <input type="hidden" name="number" value="{{ Request::input('number') }}" />
                        <input type="hidden" name="phrase" value="{{ Request::input('phrase') }}" />
                        <button type="submit" class="btn btn-primary btn-lg">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
