<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Feed;
use App\FeedPost;
use App\FeedSubscription;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = FeedSubscription::with('feed')
            ->where('user_id', '=', Auth::id())
            ->get();
        $posts = FeedPost::with('feed')
            ->where([
                ['user_id', '=', Auth::id()],
                ['is_read', '=', false],
            ])
            ->get();
        return view('home', [
            'subscriptions' => $subscriptions,
            'posts' => $posts
        ]);
    }

    /**
     * Search for feeds to add
     *
     * @return \Illuminate\Http\Response
     */
    public function feedSearch(Request $request)
    {
        $url = $request->input('url');
        if (substr($url, 0, 4) != 'http') {
            $url = 'http://' . $url;
        }
        $feed = Feed::getNormalizedFeed($url, $response);
        $feeds = [];
        if (!$feed) {
            $type = explode(';', $response->getHeader('Content-Type')[0])[0];
            if ($type == 'text/html') {
                $feeds = Feed::findOnPage($url);
            }
        } else {
            $feeds[] = $feed;
        }

        return view('ajax.feeds', ['feeds' => $feeds]);
    }

    /**
     * Add a new feed
     *
     * @return \Illuminate\Http\Response
     */
    public function feedAdd(Request $request)
    {
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
     * Update a feed post's is_read status
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function feedPostUpdate(Request $request)
    {
        $feedPost = FeedPost::findOrFail($request->input('id'));
        if ($feedPost->user_id != Auth::id()) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException;
        }
        $feedPost->is_read = $request->input('is_read');
        $feedPost->save();
        return $feedPost;
    }

    /**
     * Show a feed subscription detail and post list
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function feedSubscription(Request $request)
    {
        $subscription = FeedSubscription::findOrFail($request->input('id'));
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
     * Show the list of feed subscriptions
     *
     * @return \Illuminate\Http\Response
     */
    public function feedList()
    {
        $subscriptions = FeedSubscription::with('feed')
            ->where('user_id', '=', Auth::id())
            ->get();
        return view('blocks.feed-list', ['subscriptions' => $subscriptions]);
    }
}
