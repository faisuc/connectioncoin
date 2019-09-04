{{-- <img class="card-img-top pb-4" src="{{ $user->thePhoto }}" alt="Card image cap">
<div class="list-group">
    <a href="{{ route('users.show', ['users' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.edit' || \Route::current()->getName() == 'users.show' ? 'active' : '' }}">
        My Profile
    </a>
    <a href="{{ route('users.coins.index', ['user' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.coins.index' ? 'active' : '' }}">Coins</a>
    <a href="{{ route('users.stories.index', ['user' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.stories.index' ? 'active' : '' }}">Stories</a>
</div> --}}
<div class="card bg-dark text-white border-0" style="border-radius: 2%;">
    <div class="opacity-me" style="
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 100%;
        opacity: 0.3;
        background: rgb(9,0,162);
        background: -moz-linear-gradient(0deg, rgba(9,0,162,1) 29%, rgba(0,0,255,1) 52%, rgba(0,212,255,0) 90%);
        background: -webkit-linear-gradient(0deg, rgba(9,0,162,1) 29%, rgba(0,0,255,1) 52%, rgba(0,212,255,0) 90%);
        background: linear-gradient(0deg, rgba(9,0,162,1) 29%, rgba(0,0,255,1) 52%, rgba(0,212,255,0) 90%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0900a2',endColorstr='#00d4ff',GradientType=1);
        border: none;
        border-radius: 2%;
    "></div>
    <img class="card-img" src="{{ $user->thePhoto }}" alt="Card image" style="border-radius: 2%;">
    <div class="card-img-overlay text-dark">
        <div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: 100%; width: 100%;">
            <div class="mt-auto p-2 bd-highlight w-100">
                <h1 class="text-white">{{ $user->first_name }}<br />{{ $user->last_name }}</h1>
                @if ( ! is_null($user->bio))
                    <h3 class="mb-3 text-white">{{ $user->bio }}</h3>
                @endif
                @can('update', $user)
                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary btn-lg mb-2">Edit Profile</a>
                @endcan
                @auth
                    @can('message-user', $user)
                        <a href="{{ route('messages.index', ['user' => $user]) }}" class="btn btn-secondary btn-lg mb-2 btn-block"><i class="fas fa-paper-plane"></i> Message</a>
                    @endcan
                @endauth
                <div class="card d-none d-sm-block" style="border-radius: 1.25rem;">
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-12 col-lg-8 col-md-6">
                                <p class="lead">Web / UI Designer</p>
                                <p>
                                    I love to read, hang out with friends, watch football, listen to music, and learn new things.
                                </p>
                                <p> <span class="badge badge-info tags">html5</span> 
                                    <span class="badge badge-info tags">css3</span>
                                    <span class="badge badge-info tags">nodejs</span>
                                </p>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-12 col-lg-4 text-center">
                                <h3 class="mb-0">{{ $user->stories()->withTrashed()->select('coin_id')->where('user_id', $user->id)->groupBy('coin_id')->count() }}</h3>
                                <small>Coins Given</small>
                                <a href="{{ route('users.show', ['users' => auth()->user()]) }}" class="btn btn-block btn-outline-success mt-3" style="border-radius: 50px;"><i class="fas fa-user-circle"></i> My Profile</a>
                            </div>
                            <div class="col-12 col-lg-4 text-center">
                                <h3 class="mb-0">{{ $user->stories()->withTrashed()->count() }}</h3>
                                <small>Connections Made</small>
                                <a href="{{ route('users.coins.index', ['user' => $user]) }}" class="btn btn-block btn-outline-secondary mt-3" style="border-radius: 50px;"><i class="fas fa-coins"></i> Coins</a>
                            </div>
                            <div class="col-12 col-lg-4 text-center">
                                <h3 class="mb-0">{{ $user->likes()->count() }}</h3>
                                <small>Likes</small>
                                <a href="{{ route('users.stories.index', ['user' => $user]) }}" class="btn btn-block btn-outline-primary mt-3" style="border-radius: 50px;"><i class="fas fa-book"></i> Stories</a>
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

<div class="card d-block d-sm-none mt-5" style="border-radius: 1.25rem;">
    <div class="card-body">
        {{-- <div class="row">
            <div class="col-12 col-lg-8 col-md-6">
                <p class="lead">Web / UI Designer</p>
                <p>
                    I love to read, hang out with friends, watch football, listen to music, and learn new things.
                </p>
                <p> <span class="badge badge-info tags">html5</span> 
                    <span class="badge badge-info tags">css3</span>
                    <span class="badge badge-info tags">nodejs</span>
                </p>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-12 col-lg-4 text-center">
                <h3 class="mb-0">{{ $user->stories()->withTrashed()->select('coin_id')->where('user_id', $user->id)->groupBy('coin_id')->count() }}</h3>
                <small>Coins</small>
                <a href="{{ route('users.show', ['users' => $user]) }}" class="btn btn-block btn-outline-success mt-3" style="border-radius: 50px;"><i class="fas fa-user-circle"></i> My Profile</a>
            </div>
            <div class="col-12 col-lg-4 text-center">
                <h3 class="mb-0">{{ $user->stories()->withTrashed()->count() }}</h3>
                <small>Stories</small>
                <a href="{{ route('users.coins.index', ['user' => $user]) }}" class="btn btn-block btn-outline-secondary mt-3" style="border-radius: 50px;"><i class="fas fa-coins"></i> Coins</a>
            </div>
            <div class="col-12 col-lg-4 text-center">
                <h3 class="mb-0">{{ $user->likes()->count() }}</h3>
                <small>Likes</small>
                <a href="{{ route('users.stories.index', ['user' => $user]) }}" class="btn btn-block btn-outline-primary mt-3" style="border-radius: 50px;"><i class="fas fa-book"></i> Stories</a>
            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
    <!--/card-block-->
</div>
