<div class="list-group">
@forelse ($subscriptions as $subscription)
    <a class="list-group-item list-group-item-action" href="#"
        data-id="{{ $subscription->id }}" data-toggle="post-list">
        {{ $subscription->feed->name }}
    </a>
@empty
    <div class="list-group-item disabled text-center">
        You are not subscribed to any feeds yet.
    </div>
@endforelse
</div>
