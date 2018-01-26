<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Feed;
use App\FeedPost;
use App\FeedSubscription;

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
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        $posts = FeedPost::with('feed')
            ->where([
                ['user_id', '=', Auth::id()],
                ['is_read', '=', '0'],
            ])
            ->latest()
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
     * Update a feed post
     *
     * Typically used to mark a feed as read
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function feedPostUpdate(Request $request)
    {
        $post = FeedPost::findOrFail($request->input('id'));
        if ($post->user_id != Auth::id()) {
            throw new ModelNotFoundException;
        }
        $post->fill($request->input());
        return $post;
    }
}
