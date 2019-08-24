<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\FeedPost;
use GuzzleHttp\Client;
use SimpleXMLElement as Xml;
use pQuery;
use Exception;

class Feed extends Model
{
    /**
     * Number of seconds to allow for post dates to be behind last_check or
     * subscription creation time
     *
     * This allows for some leniency with inaccurate timestamps.
     */
    const POST_TIME_THRESHOLD = 3600;

    protected $fillable = ['name', 'url', 'site_url'];

    /**
     * Create a feed from an RSS/Atom URL
     *
     * If a feed already exists with this URL, it will be returned instead
     *
     * @param string $url
     * @return Feed
     */
    public static function createFromUrl(string $url)
    {
        $feed = self::where('url', $url)->first();
        if ($feed) {
            return $feed;
        }
        $meta = self::getNormalizedFeed($url);
        if (!$meta) {
            throw new Exception('Invalid feed URL.');
        }
        return self::create([
            'name' => $meta['title'],
            'url' => $meta['url'],
            'site_url' => $meta['site_url'],
        ]);
    }

    /**
     * Fetch a feed and normalize its contents
     *
     * @param string $url
     * @param mixed $response
     * @return array
     */
    public static function getNormalizedFeed(string $url, &$response = null)
    {
        $client = new Client();
        $response = $client->request('GET', $url);
        $body = (string)$response->getBody();

        try {
            $xml = new Xml($body);
        } catch (Exception $e) {
            return null;
        }

        $siteUrl = $url;

        // Atom
        if ($xml->getName() == 'feed') {
            $posts = [];
            foreach ($xml->entry as $entry) {
                $posts[] = [
                    'title' => (string)$entry->title,
                    'guid' => (string)$entry->id,
                    'url' => (string)$entry->link->attributes()['href'],
                    'ts' => strtotime((string)$entry->updated),
                ];
            }
            foreach ($xml->link as $link) {
                if (!array_key_exists('rel', $link->attributes())) {
                    $siteUrl = (string)$link->attributes()['href'];
                    break;
                }
            }
            return [
                'title' => (string)$xml->title,
                'url' => $url,
                'site_url' => $siteUrl,
                'posts' => $posts
            ];
        }

        // RSS 2.0
        if ($xml->getName() == 'rss' && $xml->attributes()['version'] == '2.0') {
            $channel = $xml->channel[0];
            $posts = [];
            foreach ($channel->item as $item) {
                $posts[] = [
                    'title' => (string)$item->title,
                    'guid' => (string)$item->guid ?? (string)$item->link,
                    'url' => (string)$item->link,
                    'ts' => isset($item->pubDate) ? strtotime((string)$item->pubDate) : null,
                ];
            }
            if ($channel->link) {
                $siteUrl = (string)$channel->link;
            }
            return [
                'title' => (string)$channel->title,
                'url' => $url,
                'site_url' => $siteUrl,
                'posts' => $posts
            ];
        }

        return null;
    }

    /**
     * Find feeds on a webpage
     *
     * @param string $url
     * @return array
     */
    public static function findOnPage(string $url)
    {
        $client = new Client();
        $response = $client->request('GET', $url);
        $dom = pQuery::parseStr((string)$response->getBody());
        $feeds = [];
        foreach ($dom->query('link[rel="alternate"]') as $el) {
            if (preg_match('@application/(atom|rss)\\+xml@', $el->type)) {
                $href = $el->href;
                if (!preg_match('@^https?://@', $href)) {
                    if (substr($href, 0, 2) == '//') {
                        $href = 'http:' . $href;
                    } else {
                        $href = rtrim($url, '/') . '/' . ltrim($href, '/');
                    }
                }

                $feed = self::getNormalizedFeed($href, $response);
                if ($feed) {
                    $feeds[] = $feed;
                }
            }
        }
        return $feeds;
    }

    /**
     * Record new feed posts, if any subscriptions exist
     */
    public function updateFeed()
    {
        $subscriptions = $this->subscriptions()->get();
        if (!$subscriptions->count()) {
            return;
        }
        $feed = $this->getNormalizedFeed($this->url);

        foreach ($feed['posts'] as $post) {
            if (
                $post['ts'] &&
                $this->last_check &&
                $post['ts'] < strtotime($this->last_check) - self::POST_TIME_THRESHOLD
            ) {
                // Post is older than last feed update
                continue;
            }

            $existingFeedPost = FeedPost::where([
                'feed_id' => $this->id,
                'guid' => $post['guid'],
            ])->first();
            if ($existingFeedPost) {
                // Post has been seen before
                continue;
            }

            foreach ($subscriptions as $sub) {
                if ($post['ts'] &&
                    $sub->created_at &&
                    $post['ts'] < strtotime($sub->created_at) - self::POST_TIME_THRESHOLD) {
                    // Post is older than subscription
                    continue;
                }

                Log::debug('Creating feed post', [
                    'feed_id' => $this->id,
                    'sub_id' => $sub->id,
                    'post_title' => $post['title'],
                    'post_ts' => $post['ts'],
                ]);
                FeedPost::create([
                    'title' => $post['title'],
                    'feed_id' => $this->id,
                    'user_id' => $sub->user_id,
                    'url' => $post['url'],
                    'guid' => $post['guid'],
                    'created_at' => date('Y-m-d H:i:s', $post['ts']),
                ]);
            }
        }

        $this->last_check = now();
        $this->save();
    }

    /**
     * Get the subscriptions for the feed
     */
    public function subscriptions()
    {
        return $this->hasMany(FeedSubscription::class);
    }

    /**
     * Get the Posts from the subscription
     */
    public function posts()
    {
        return $this->hasMany(FeedPost::class);
    }
}
