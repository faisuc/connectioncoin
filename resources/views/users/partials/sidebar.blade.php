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
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item"><a href="{{ route('users.show', ['users' => $user]) }}" class="font-weight-bold" style="padding: 47px;">My Profile</a></li>
                    <li class="list-group-item"><a href="{{ route('users.coins.index', ['user' => $user]) }}" class="font-weight-bold" style="padding: 47px;">Coins</a></li>
                    <li class="list-group-item"><a href="{{ route('users.stories.index', ['user' => $user]) }}" class="font-weight-bold" style="padding: 47px;">Story</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
