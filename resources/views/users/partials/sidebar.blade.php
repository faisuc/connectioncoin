{{-- <img class="card-img-top pb-4" src="{{ $user->thePhoto }}" alt="Card image cap">
<div class="list-group">
    <a href="{{ route('users.show', ['users' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.edit' || \Route::current()->getName() == 'users.show' ? 'active' : '' }}">
        My Profile
    </a>
    <a href="{{ route('users.coins.index', ['user' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.coins.index' ? 'active' : '' }}">Coins</a>
    <a href="{{ route('users.stories.index', ['user' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.stories.index' ? 'active' : '' }}">Stories</a>
</div> --}}
<div class="card bg-dark text-white">
    <img class="card-img" src="{{ $user->thePhoto }}" alt="Card image">
    <div class="card-img-overlay text-dark">
        <div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: 100%; width: 100%;">
            <div class="mt-auto p-2 bd-highlight w-100">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-8 col-md-6">
                                {{-- <p class="lead">Web / UI Designer</p>
                                <p>
                                    I love to read, hang out with friends, watch football, listen to music, and learn new things.
                                </p>
                                <p> <span class="badge badge-info tags">html5</span> 
                                    <span class="badge badge-info tags">css3</span>
                                    <span class="badge badge-info tags">nodejs</span>
                                </p> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-4 text-center">
                                <h3 class="mb-0">{{ $user->stories()->withTrashed()->select('coin_id')->where('user_id', $user->id)->groupBy('coin_id')->count() }}</h3>
                                <small>Coins</small>
                                {{-- <button class="btn btn-block btn-outline-success"><span class="fa fa-plus-circle"></span> Follow</button> --}}
                            </div>
                            <div class="col-12 col-lg-4 text-center">
                                <h3 class="mb-0">{{ $user->stories()->withTrashed()->count() }}</h3>
                                <small>Stories</small>
                                {{-- <button class="btn btn-outline-info btn-block"><span class="fa fa-user"></span> View Profile</button> --}}
                            </div>
                            <div class="col-12 col-lg-4 text-center">
                                <h3 class="mb-0">{{ $user->likes()->count() }}</h3>
                                <small>Likes</small>
                                {{-- <button type="button" class="btn btn-outline-primary btn-block"><span class="fa fa-gear"></span> Options</button> --}}
                            </div>
                            <!--/col-->
                        </div>
                        <!--/row-->
                    </div>
                    <!--/card-block-->
                </div>
            </div>
        </div>
    </div>
</div>
