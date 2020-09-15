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
     */
    public function search(Request $request)
    {
        $vUrl = Validator::make($request->all(), [
            'url' => ['required', 'string'],
        ]);
        $vHost = Validator::make($request->all(), [
            'url' => [
                'required',
                'regex' => '/^(([a-z0-9]|[a-z0-9][a-z0-9\-]*[a-z0-9])\\.)*([a-z0-9]|[a-z0-9][a-z0-9\-]*[a-z0-9])$/i',
            ],
        ]);

        if ($vUrl->fails()) {
            $vHost->validate();
        }

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
     * Mark all of the user's posts read in a feed
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
