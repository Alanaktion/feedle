<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feed;

class FeedController extends Controller
{
    /**
     * Get feed list
     *
     * @return array
     */
    public function index()
    {
        return Auth::user()->subscriptions()
            ->with('feed')
            ->latest()
            ->get();
    }

    /**
     * Search for feeds to add
     *
     * @return array
     */
    public function search(Request $request)
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

        return $feeds;
    }

    /**
     * Mark all of the user's posts read in the feed
     *
     * @param Feed $feed
     * @return \Illuminate\Http\Response
     */
    public function readAll(Feed $feed)
    {
        $feed->posts()
            ->where('user_id', Auth::id())
            ->update(['is_read' => true]);
        return [
            'success' => true,
        ];
    }
}
