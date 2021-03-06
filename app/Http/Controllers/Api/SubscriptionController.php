<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feed;
use App\Models\FeedPost;
use App\Models\FeedSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            ->with('feed:id,title,site_url,url')
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
     *
     * @param FeedSubscription $feed
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(FeedSubscription $subscription)
    {
        return [
            'success' => $subscription->delete(),
        ];
    }
}
