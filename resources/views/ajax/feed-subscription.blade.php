<div class="sub-topbar">
    <button type="button" class="btn btn-secondary" data-toggle="feed-list">
        <svg class="octicon octicon-chevron-left" viewBox="0 0 8 16" version="1.1" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.5 3L7 4.5 3.25 8 7 11.5 5.5 13l-5-5z"></path>
        </svg>
    </button>
    <div class="sub-topbar-title">
        {{ $subscription->feed->name }}
    </div>
    <div class="dropdown ml-auto">
        <button class="btn btn-secondary" type="button" id="subEditBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Edit subscription">
            <svg class="octicon octicon-gear" viewBox="0 0 14 16" version="1.1" aria-hidden="true">
                <path fill-rule="evenodd" d="M14 8.77v-1.6l-1.94-.64-.45-1.09.88-1.84-1.13-1.13-1.81.91-1.09-.45-.69-1.92h-1.6l-.63 1.94-1.11.45-1.84-.88-1.13 1.13.91 1.81-.45 1.09L0 7.23v1.59l1.94.64.45 1.09-.88 1.84 1.13 1.13 1.81-.91 1.09.45.69 1.92h1.59l.63-1.94 1.11-.45 1.84.88 1.13-1.13-.92-1.81.47-1.09L14 8.75v.02zM7 11c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
            </svg>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="subEditBtn">
            <a class="dropdown-item" href="#" data-id="{{ $subscription->feed->id }}" data-action="mark-read" data-target="#sub-{{ $subscription->id }}-posts">
                Mark all read
            </a>
            {{--  <a class="dropdown-item" href="#" data-action="refresh">
                Refresh feed
            </a>  --}}
            <a class="dropdown-item" href="#" data-id="{{ $subscription->id }}" data-action="unsubscribe">
                Unsubscribe
            </a>
        </div>
    </div>
</div>

<div class="list-group pb-3" id="sub-{{ $subscription->id }}-posts">
@forelse ($posts as $post)
    <a class="list-group-item list-group-item-action post {{ $post->is_read ? 'is-read' : 'is-unread' }}"
        href="{{ $post->url }}" data-id="{{ $post->id }}" data-toggle="reader" target="reader">
        <span class="post-title">{{ $post->title }}</span><br>
        <span class="post-date">{{ $post->created_at->diffForHumans() }}</span>
    </a>
@empty
    <div class="list-group-item disabled text-center">
        No posts have been added for this feed yet.
    </div>
@endforelse
</div>
