<ul class="list-group mt-3">
@forelse ($feeds as $feed)
    <li class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $feed['title'] }}</h5>
            <form action="{{ route('feedAdd') }}" method="post" data-submit="add-feed">
                <input type="hidden" name="url" value="{{ $feed['url'] }}">
                <button type="submit" class="btn btn-primary btn-sm">
                    Add Feed
                </button>
            </form>
        </div>
        <small>{{ $feed['url'] }}</small>
    </li>
@empty
    <li class="list-group-item disabled">No feeds were found at this URL.</li>
@endforelse
</ul>
