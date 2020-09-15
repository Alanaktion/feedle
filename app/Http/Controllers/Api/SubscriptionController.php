<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feed;
use App\Models\FeedSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(FeedSubscription::class, 'subscription');
    }

    /**
     * Get a user's subscriptions
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return $user->subscriptions()
            ->with('feed:id,title,site_url,url')
            ->latest()
            ->paginate(30);
    }

    /**
     * Subscribe to a feed
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'url' => 'required|url',
        ])->validate();
        $feed = Feed::createFromUrl($request->input('url'));
        $subscription = FeedSubscription::firstOrCreate([
            'feed_id' => $feed->id,
            'user_id' => Auth::id(),
        ]);
        return response()->json(array_merge(
            $feed->toArray(),
            ['subscription_id' => $subscription->id]
        ), 201);
    }

    /**
     * Unsubscribe the user from a feed
     */
    public function destroy(FeedSubscription $subscription)
    {
        return [
            'success' => $subscription->delete(),
        ];
    }
}
