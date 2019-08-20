<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feed;
use App\Models\FeedPost;
use App\Models\FeedSubscription;

class SubscriptionController extends Controller
{
    /**
     * Get a user's subscriptions
     *
     * @return array
     */
    public function index()
    {
        return Auth::user()->subscriptions()
            ->with('feed:id,name,url')
            ->latest()
            ->paginate(15);
    }

    /**
     * Subscribe to a feed
     *
     * @return FeedSubscription
     */
    public function create(Request $request)
    {
        // TODO: validate request
        $url = $request->input('url');
        $feed = Feed::createFromUrl($url);
        $subscription = FeedSubscription::where([
            'feed_id' => $feed->id,
            'user_id' => Auth::id(),
        ])->first();
        if (!$subscription) {
            $subscription = FeedSubscription::create([
                'feed_id' => $feed->id,
                'user_id' => Auth::id(),
            ]);
        }
        return $feed;
    }

    /**
     * Show a feed subscription detail and post list
     *
     * @param FeedSubscription $subscription
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(FeedSubscription $subscription, Request $request)
    {
        // TODO: use policies to enfore this
        if ($subscription->user_id != Auth::id()) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException;
        }
        $posts = FeedPost::with('feed')
            ->where([
                ['user_id', '=', Auth::id()],
                ['feed_id', '=', $subscription->feed_id],
            ])
            ->get();
        return view('ajax.feed-subscription', [
            'subscription' => $subscription,
            'posts' => $posts
        ]);
    }

    /**
     * Unsubscribe the user from a feed
     *
     * @param FeedSubscription $feed
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(FeedSubscription $subscription, Request $request)
    {
        // TODO: use policies to enfore this
        if ($subscription->user_id != Auth::id()) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException;
        }
        $subscription->delete();
        return [
            'success' => true,
        ];
    }
}
