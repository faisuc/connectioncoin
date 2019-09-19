@cannot('update', $story)
    <a href="#" data-toggle="modal" data-target="#story-report-modal-{{ $story->id }}"><i class="far fa-flag"></i></a>
    <div class="modal fade" id="story-report-modal-{{ $story->id }}" tabindex="-1" role="dialog" aria-labelledby="story-report-modal-{{ $story->id }}" aria-hidden="true">
        <form action="" method="POST" id="story-report-modal-form-{{ $story->id }}">
            <input type="hidden" name="story_id" value="{{ $story->id }}" />
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report Story</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" name="report_message" placeholder="Report Message"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary send-report-story" data-story-id="{{ $story->id }}">Send Report</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endcannot