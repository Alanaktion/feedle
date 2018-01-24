<div class="list-group">
@forelse ($posts as $post)
    <a class="list-group-item list-group-item-action post is-unread" href="{{ $post->url }}"
            data-id="{{ $post->id }}" data-toggle="reader" target="reader">
        {{ $post->feed->name }}<br>
        <span class="post-title">{{ $post->title }}</span><br>
        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
    </a>
@empty
    <div class="list-group-item disabled text-center">
        No unread posts.
    </div>
@endforelse
</div>
