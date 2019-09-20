@extends('layouts.app')

@section('content')
<div class="container py-4 container-profile100">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Create Connection</div>

                <div class="card-body">
                    @sharedAlerts

                    <form method="POST" action="{{ route('connections.store') }}">
                        @csrf
                        @guest
                            <div class="form-group">
                                <label for="nickname">Nickname</label>
                                <input type="text" class="form-control form-control-lg" name="nickname" id="nickname" placeholder="Enter nickname" value="{{ old('nickname') }}">
                            </div>
                        @endguest
                        <div class="form-group">
                            <label for="number">Coin Number</label>
                            <input type="text" class="form-control form-control-lg" name="number" id="number" placeholder="Enter number" value="{{ old('number') }}">
                        </div>
                        <div class="form-group">
                            <label for="phrase">Coin Phrase</label>
                            <input type="text" class="form-control form-control-lg" name="phrase" id="phrase" placeholder="Enter phrase" value="{{ old('phrase') }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
