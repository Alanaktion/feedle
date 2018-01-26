<div class="list-group pb-3">
@forelse ($posts as $post)
    <a class="list-group-item list-group-item-action" href="{{ $post->url }}"
            data-id="{{ $post->id }}" data-toggle="reader" target="reader">
        {{ $post->feed->name }}<br>
        <strong>{{ $post->title }}</strong><br>
        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
    </a>
@empty
    <div class="list-group-item disabled text-center">
        No posts yet.
    </div>
@endforelse
</div>
