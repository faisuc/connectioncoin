<img class="card-img-top pb-4" src="{{ $user->thePhoto }}" alt="Card image cap">
<div class="list-group">
    <a href="{{ route('users.show', ['users' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.edit' || \Route::current()->getName() == 'users.show' ? 'active' : '' }}">
        My Profile
    </a>
    <a href="{{ route('users.coins.index', ['user' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.coins.index' ? 'active' : '' }}">Coins</a>
    <a href="{{ route('users.stories.index', ['user' => $user]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'users.stories.index' ? 'active' : '' }}">Stories</a>
</div>