<ul class="list-inline list-connection-users">
    @foreach ($story->getTheLastUsersWhoPostedUsingThisCoin(10)->reverse() as $user)
        <li class="list-inline-item py-2">
            <a href="{{ route('users.show', ['user' => $user]) }}">
                <img src="{{ $user->thePhoto }}" title="{{ $user->name }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle" style="width: 30px; height: 30px;">
            </a>
        </li>
    @endforeach
</ul>