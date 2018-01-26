<div class="list-group pb-3">
@forelse ($posts as $post)
    <a class="list-group-item list-group-item-action post is-unread" href="{{ $post->url }}"
            data-id="{{ $post->id }}" data-toggle="reader" target="reader">
        {{ $post->feed->name }}<br>
        <span class="post-title">{{ $post->title }}</span><br>
        <span class="post-date">{{ $post->created_at->diffForHumans() }}</span>
    </a>
@empty
    <div class="list-group-item disabled text-center">
        <svg class="octicon octicon-check" viewBox="0 0 12 16" version="1.1" aria-hidden="true">
            <path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"></path>
        </svg>
        <p>No unread posts.</p>
    </div>
@endforelse
</div>
