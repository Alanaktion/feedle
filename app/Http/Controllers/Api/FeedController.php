<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedController extends Controller
{
    /**
     * Search for feeds to add
     *
     * @return array
     */
    public function search(Request $request)
    {
        Validator::make($request->all(), [
            // it may make more sense to validate this differently, via e.g.
            // a regex matching URLs or hostnames + frontend pattern match.
            'url' => 'required|string',
        ])->validate();
        // TODO: ignore strings that are not either valid URLs or hostnames
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
