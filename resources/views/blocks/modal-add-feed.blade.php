<div class="modal" tabindex="-1" role="dialog" id="mdl-add-feed">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Feed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('feedSearch') }}" method="post" data-submit="find-feed">
                    <label for="feedUrl" class="sr-only">Feed URL</label>
                    <input type="text" name="url" class="form-control" id="feedUrl"
                        placeholder="Enter a feed or website URL" data-autofocus>
                </form>
                <div data-content="result"></div>
            </div>
        </div>
    </div>
</div>
