@foreach ($relatedStories as $story)
    <h3 class="text-white">Related Stories</h3>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('stories.show', ['story' => $story->id]) }}" class="custom-card">
                <div class="card h-100 shadow">
                    <img src="{{ $story->theImage }}" class="card-img-top" alt="{{ $story->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $story->title }}</h5>
                        <p class="card-text">{{ $story->theDescription }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endforeach
