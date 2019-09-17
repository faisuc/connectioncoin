<ul class="list-inline emotions">
    @foreach (getEmotions() as $reaction_id => $emotion)
        <li class="list-inline-item">
            <a
                href="#"
                title="{{ $emotion['title'] }}"
                data-reaction="{{ $reaction_id }}"
                data-story-id="{{ $story->id }}"
                @auth
                    @if ($liked = auth()->user()->likedTheStory($story->id))
                        @if ($liked->reaction_id == $reaction_id)
                            style = 'color: blue;'
                        @endif
                    @endif
                @endauth
            >
                <i class="far {{ $emotion['icon'] }}"></i>
            </a>
        </li>
    @endforeach
</ul>