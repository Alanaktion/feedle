<div class="list-group">
@forelse ($subscriptions as $subscription)
    <div class="list-group-item">
        {{ $subscription->feed->name }}
    </div>
@empty
    <div class="list-group-item disabled text-center">
        No feeds yet.
    </div>
@endforelse
</div>
