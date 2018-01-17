<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use SimpleXMLElement as Xml;
use pQuery;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Verify that an XML string contains a valid feed
     *
     * @todo   Move this function somewhere more appropriate
     *
     * @param  string $feedBody
     * @return string|null Title of the feed, if valid
     */
    protected function verifyFeed(string $feedBody)
    {
        try {
            $xml = new Xml($feedBody);
        } catch (Exception $e) {
            return null;
        }
        if ($xml->getName() == 'feed') {
            return (string)$xml->title;
        }
        if (
            $xml->getName() == 'rss' &&
            $xml->attributes()['version'] == '2.0'
        ) {
            return (string)$xml->channel[0]->title;
        }
        return null;
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
        $client = new Client();
        $response = $client->request('GET', $url);
        $feeds = [];
        $type = explode(';', $response->getHeader('Content-Type')[0])[0];
        switch ($type) {
            case 'application/rss+xml':
            case 'application/xml':
            case 'text/xml':
                // Might be Atom/RSS! Try parsing it to be sure.
                $title = $this->verifyFeed((string)$response->getBody());
                if ($title) {
                    $feeds[] = [
                        'title' => $title,
                        'url' => $url,
                    ];
                }
                break;
            case 'text/html':
                // Loosely parsing HTML is difficult but we'll try.
                // Might have a <link rel="alternate"> we can use...
                // Try to find them in the first 64 KB
                $dom = pQuery::parseStr((string)$response->getBody());
                $hrefs = [];
                foreach ($dom->query('link[rel="alternate"]') as $el) {
                    if ($el->type == 'application/rss+xml') {
                        $href = $el->href;
                        if (!preg_match('@^https?://@', $href)) {
                            if (substr($href, 0, 2) == '//') {
                                $href = 'http:' . $href;
                            } else {
                                $href = rtrim($url, '/') . '/' . ltrim($href, '/');
                            }
                        }

                        // Request the detected feed and try to parse it
                        $client = new Client();
                        $response = $client->request('GET', $href);
                        $title = $this->verifyFeed((string)$response->getBody());
                        if ($title) {
                            $feeds[] = [
                                'title' => $title,
                                'url' => $href,
                            ];
                        }
                    }
                }
                break;
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
        // TODO: add subscription
    }
}
