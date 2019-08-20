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
                <form action="/api/feeds/search" method="post" data-submit="find-feed">
                    <label for="feedUrl" class="sr-only">Feed URL</label>
                    <div class="d-flex">
                        <input type="text" name="url" class="input" id="feedUrl"
                            placeholder="Enter a feed or website URL" required data-autofocus>
                        <button type="submit" class="btn btn-primary d-none d-sm-block ml-2" aria-label="Search">
                            <svg class="octicon octicon-search" viewBox="0 0 16 16" version="1.1" aria-hidden="true">
                                <path fill-rule="evenodd" d="M15.7 13.3l-3.81-3.83A5.93 5.93 0 0 0 13 6c0-3.31-2.69-6-6-6S1 2.69 1 6s2.69 6 6 6c1.3 0 2.48-.41 3.47-1.11l3.83 3.81c.19.2.45.3.7.3.25 0 .52-.09.7-.3a.996.996 0 0 0 0-1.41v.01zM7 10.7c-2.59 0-4.7-2.11-4.7-4.7 0-2.59 2.11-4.7 4.7-4.7 2.59 0 4.7 2.11 4.7 4.7 0 2.59-2.11 4.7-4.7 4.7z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
                <div data-content="result" data-empty="modal-close"></div>
            </div>
        </div>
    </div>
</div>
